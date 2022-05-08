<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
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

    public function create() {
        // Create query
        $query = 'INSERT INTO ' .$this->table. ' 
                    SET 
                    UserName = :UserName,
                    Email = :Email,
                    PhoneNumber = :PhoneNumber,
                    Password = :Password';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean Data
        $this->UserName = htmlspecialchars(strip_tags($this->UserName));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->PhoneNumber = htmlspecialchars(strip_tags($this->PhoneNumber));
        $this->Password = htmlspecialchars(strip_tags($this->Password));

        // Bind ID
        $stmt->bindParam(':UserName' ,$this->UserName);
        $stmt->bindParam(':Email' ,$this->Email);
        $stmt->bindParam(':PhoneNumber' ,$this->PhoneNumber);
        $stmt->bindParam(':Password' ,$this->Password);

        // Execute query

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s\n",$stmt->error);
  }
}

$database = new Database();
$db = $database->connect();
$users = new users($db);

$data = json_decode(file_get_contents("php://input"));

$users->UserName = $data->UserName;
$users->Email = $data->Email;
$users->PhoneNumber = $data->PhoneNumber;
$users->Password = $data->Password;

if ($users->create()) {
    echo json_encode(
        array('message' => 'Users Created')
    );
}else {
    echo json_encode(
        array('message' => 'Users Not Created')
    );
}
?>
