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
        $query = 'SELECT bt.BusNo, b.DriverName, r.FeedBack, b.BusID, r.RideID
                    FROM bustype bt, bus b,'.$this->table.' r, users u
                    WHERE bt.BusTypeID=b.BusTypeID
                    AND b.BusID=r.BusID
                    AND r.UserID=u.UserID
                    AND u.UserID='.$this->UserID.'
                    ORDER BY r.RideID DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
  }
}

$database = new Database();
$db = $database->connect();
$ridehistory = new ridehistory($db);

$ridehistory->UserID = isset($_GET['UserID']) ? $_GET['UserID']: die();

$result=$ridehistory->read_single();

$num = $result->rowCount();

if ($num > 0 ) {
    $array = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $ride_array = array(
          'BusNo' => $BusNo,
          'DriverName' => $DriverName,
          'FeedBack' => $FeedBack,
          'BusID' => $BusID,
          'RideID' => $RideID
        );
        array_push($array,$ride_array);
    }
}

echo json_encode($array);
?>
