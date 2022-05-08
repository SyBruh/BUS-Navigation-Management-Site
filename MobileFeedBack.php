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
    public $Response;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {

        // Create query
        $query = 'UPDATE ' .$this->table. ' 
                    SET 
                    FeedBack = :FeedBack
                    WHERE
                    RideID = :RideID';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam( ':FeedBack' ,$this->FeedBack);
        $stmt->bindParam( ':RideID' ,$this->RideID);
        // Execute query
        $stmt->execute();
        $this->Response = "FeedBack Added";
  }
}

$database = new Database();
$db = $database->connect();
$ridehistory = new ridehistory($db);

$ridehistory->FeedBack = isset($_GET['FeedBack']) ? $_GET['FeedBack']: die();
$ridehistory->RideID = isset($_GET['RideID']) ? $_GET['RideID']: die();

$ridehistory->read_single();

$array = array();

$ridehistory_array = array(
    'message' => $ridehistory->Response
  );

array_push($array,$ridehistory_array);
echo json_encode($array);
?>
