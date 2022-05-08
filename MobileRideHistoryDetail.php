<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class ridehistory{
    private $conn;
    private $table = 'ride';

    // Post Properties
    public $UserID;
    public $BusID;
    public $RideID;
    public $FeedBack;
    public $DriverName;
    public $BusNo;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {

        // Create query
        $query = 'Select b.BusID, b.DriverName, r.FeedBack
                    FROM '.$this->table.' r, bus b
                    WHERE b.BusID = r.BusID
                    AND r.RideID = :RideID';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam( ':RideID' ,$this->RideID);
        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->BusID = $row['BusID'];
        $this->DriverName = $row['DriverName'];
        $this->FeedBack = $row['FeedBack'];
  }
}

$database = new Database();
$db = $database->connect();
$ridehistory = new ridehistory($db);

$ridehistory->RideID = isset($_GET['RideID']) ? $_GET['RideID']: die();

$ridehistory->read_single();

$array = array();

$ridehistory_array = array(
    'BusID' => $ridehistory->BusID,
    'DriverName' => $ridehistory->DriverName,
    'FeedBack' => $ridehistory->FeedBack
  );

array_push($array,$ridehistory_array);
echo json_encode($array);
?>
