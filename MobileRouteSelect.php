<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class froute{
    private $conn;
    private $table = 'froute';

    // Post Properties
    public $FRouteID;
    public $StartDestination;
    public $FinalDestination;
    public $FRoute;
    public $FRouteUrl;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {
        // Create query
        $query = 'SELECT FRouteID, StartDestination, FinalDestination, FRoute, FRouteUrl
                                  FROM ' . $this->table . '
                                  WHERE
                                    StartDestination = :StartDestination AND FinalDestination = :FinalDestination';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam( ':StartDestination' ,$this->StartDestination);
        $stmt->bindParam( ':FinalDestination' ,$this->FinalDestination);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->FRouteID = $row['FRouteID'];
        $this->StartDestination = $row['StartDestination'];
        $this->FinalDestination = $row['FinalDestination'];
        $this->FRoute = $row['FRoute'];
        $this->FRouteUrl = $row['FRouteUrl'];
  }
}

$database = new Database();
$db = $database->connect();
$froute = new froute($db);

$froute->StartDestination = isset($_GET['StartDestination']) ? $_GET['StartDestination']: die();
$froute->FinalDestination = isset($_GET['FinalDestination']) ? $_GET['FinalDestination']: die();

$froute->read_single();

$array = array();

$froute_array = array(
    'FRouteID' => $froute->FRouteID,
    'StartDestination' => $froute->StartDestination,
    'FinalDestination' => $froute->FinalDestination,
    'FRoute' => $froute->FRoute,
    'FRouteUrl' => $froute->FRouteUrl
  );

array_push($array,$froute_array);
echo json_encode($array);
?>
