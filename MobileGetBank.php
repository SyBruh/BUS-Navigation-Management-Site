<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database(Bank).php';
class user{
    private $conn;
    private $table = 'user';

    // Post Properties
    public $Email;
    public $Balance;
    public $Password;
    public $UserID;
    public $Amount;
    public $Response;
    public $newBalance;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    } 

    public function payment() {
        // Create query
        $query = 'SELECT u.Balance
                FROM ' .$this->table. ' u
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
        $this->Balance = $row['Balance'];

        if ($this->Balance < $this->Amount) {
            $this->Response = "This Account Balance is Low";
        }else {
            $this->newBalance = $this->Balance - $this->Amount;
            $query3 = 'UPDATE ' .$this->table. ' 
                        SET 
                        Balance = ' .$this->newBalance. '
                        WHERE
                        Email = :Email AND Password = :Password';

            $stmt3 = $this->conn->prepare($query3);
            $stmt3->bindParam( ':Email' ,$this->Email);
            $stmt3->bindParam( ':Password' ,$this->Password);
            $stmt3->execute();
            $String = "$this->newBalance";
            $this->Response = "1";
        }
  }
}

$database = new Database();
$db = $database->connect();
$user = new user($db);

$user->Email = isset($_GET['Email']) ? $_GET['Email']: die();
$user->Password = isset($_GET['Password']) ? $_GET['Password']: die();
$user->Amount = isset($_GET['Amount']) ? $_GET['Amount']: die();

$user->payment();

$array = array();

$user_array = array(
    'message' => $user->Response,
  );

array_push($array,$user_array);
echo json_encode($array);
?>
