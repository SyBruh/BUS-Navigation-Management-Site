<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class users{
    private $conn;
    private $table = 'users';

    // Post Properties
    public $Amount;
    public $Balance;
    public $BusID;
    public $UserID;
    public $Response;
    public $newBalance;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    } 

    public function payment() {
        // Create query
        $query = 'SELECT Balance
                FROM ' .$this->table. '
                WHERE
                UserID = :UserID';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam( ':UserID' ,$this->UserID);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->Balance = $row['Balance'];

        $this->newBalance = $this->Balance + $this->Amount;
        $query3 = 'UPDATE ' .$this->table. ' 
                    SET 
                    Balance = ' .$this->newBalance. '
                    WHERE
                    UserID = :UserID';

        $stmt3 = $this->conn->prepare($query3);
        $stmt3->bindParam( ':UserID' ,$this->UserID);
        $stmt3->execute();
        $String = "$this->newBalance";
        $this->Response = "Add Balance Success, Your New Balance is $String";
        
  }
}

$database = new Database();
$db = $database->connect();
$users = new users($db);

$users->UserID = isset($_GET['UserID']) ? $_GET['UserID']: die();
$users->Amount = isset($_GET['Amount']) ? $_GET['Amount']: die();

$users->payment();

$array = array();

$users_array = array(
    'message' => $users->Response,
  );

array_push($array,$users_array);
echo json_encode($array);
?>
