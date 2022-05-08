<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class bustype{
    private $conn;
    private $table = 'bustype';

    // Post Properties
    public $position;
    public $id;
    public $positionholderID;
    public $BusTypeID;
    public $StartDestination;
    public $FinalDestination;
    public $StartTime;
    public $StopTime;
    public $NoofGates;
    public $BusNo;
    public $Price;
    public $BusRouteUrl;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {

        $firstquery = 'SELECT BusTypeID FROM bustype';

        $firststmt = $this->conn->prepare($firstquery);

        $firststmt->execute();

        // $arrayfirst = array();

        // while ($row = $firststmt->fetch(PDO::FETCH_ASSOC)) {
        //     extract($row);
        //     $arrayfirst = array(
        //         'BusTypeID' => $this->id
        //     );
        // }

        for ($i=0; $i < $this->position+1; $i++) { 
            $row = $firststmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $this->id = $row['BusTypeID'];
        }

        // $this->positionholderID = $arrayfirst();

        // Create query
        $query = 'Select bt.BusTypeID, bt.StartTime, bt.StopTime, sd.StartDestination, fd.FinalDestination, bt.NoofGates, bt.BusNo, bt.Price, bt.BusRouteUrl
                    FROM '.$this->table.' bt, startdestination sd, finaldestination fd
                    WHERE bt.StartDestinationID = sd.StartDestinationID
                    AND bt.FinalDestinationID = fd.FinalDestinationID
                    AND bt.BusTypeID = '.$this->id.'';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->BusTypeID = $row['BusTypeID'];
        $this->StartTime = $row['StartTime'];
        $this->StopTime = $row['StopTime'];
        $this->StartDestination = $row['StartDestination'];
        $this->FinalDestination = $row['FinalDestination'];
        $this->NoofGates = $row['NoofGates'];
        $this->BusNo = $row['BusNo'];
        $this->Price = $row['Price'];
        $this->BusRouteUrl = $row['BusRouteUrl'];
  }
}

$database = new Database();
$db = $database->connect();
$bustype = new bustype($db);

$bustype->position = isset($_GET['position']) ? $_GET['position']: die();

$bustype->read_single();

$array = array();

$bustype_array = array(
    'BusTypeID' => $bustype->BusTypeID,
    'StartTime' => $bustype->StartTime,
    'StopTime' => $bustype->StopTime,
    'StartDestination' => $bustype->StartDestination,
    'FinalDestination' => $bustype->FinalDestination,
    'NoofGates' => $bustype->NoofGates,
    'BusNo' => $bustype->BusNo,
    'Price' => $bustype->Price,
    'BusRouteUrl' => $bustype->BusRouteUrl
  );

array_push($array,$bustype_array);
echo json_encode($array);
?>
