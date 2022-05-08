<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class busstop{
    private $conn;
    private $table = 'busstop';

    // Post Properties
    public $position;
    public $id;
    public $positionholderID;
    public $BusStop;
    public $BusNo;
    
  

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
        $query = 'SELECT bs.BusStop
                    FROM bustype bt, br b,'.$this->table.' bs
                    WHERE bt.BusTypeID=b.BusTypeID
                    AND b.BusStopID=bs.BusStopID
                    AND bt.BusTypeID='.$this->id.'
                    ORDER BY b.StopOrder';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
  }
}

$database = new Database();
$db = $database->connect();
$busstop = new busstop($db);

$busstop->position = isset($_GET['position']) ? $_GET['position']: die();

$result=$busstop->read_single();

$num = $result->rowCount();

if ($num > 0 ) {
    $array = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $busstop_array = array(
          'BusStop' => $BusStop
        );
        array_push($array,$busstop_array);
    }
}

echo json_encode($array);
?>
