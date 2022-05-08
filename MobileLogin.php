<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class users{
    private $conn;
    private $table = 'users';

    // Post Properties
    public $UserID;
    public $UserName;
    public $Email;
    public $PhoneNumber;
    public $Password;
    public $Balance;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {
        // Create query
        $query = 'SELECT u.UserID, u.UserName, u.Email, PhoneNumber, u.Password, u.Balance
                                  FROM ' . $this->table . ' u 
                                  WHERE
                                    u.Email = :Email AND u.Password = :Password';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam( ':Email' ,$this->Email);
        $stmt->bindParam( ':Password' ,$this->Password);

        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->UserID = $row['UserID'];
        $this->UserName = $row['UserName'];
        $this->Email = $row['Email'];
        $this->PhoneNumber = $row['PhoneNumber'];
        $this->Password = $row['Password'];
        $this->Balance = $row['Balance'];
  }
}

$database = new Database();
$db = $database->connect();
$users = new users($db);

$users->Email = isset($_GET['Email']) ? $_GET['Email']: die();
$users->Password = isset($_GET['Password']) ? $_GET['Password']: die();

$users->read_single();
$array = array();

$user_array = array(
    'UserID' => $users->UserID,
    'UserName' => $users->UserName,
    'Email' => $users->Email,
    'PhoneNumber' => $users->PhoneNumber,
    'Password' => $users->Password,
    'Balance' => $users->Balance
  );

array_push($array,$user_array);
echo json_encode($array);
?>
