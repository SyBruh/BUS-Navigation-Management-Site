<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class bus{
    private $conn;
    private $table = 'bus';

    // Post Properties
    public $Price;
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
                FROM users
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

        $query2 = 'SELECT bt.Price
                FROM bustype bt, ' .$this->table. ' b
                WHERE
                bt.BusTypeID = b.BusTypeID AND b.BusID = :BusID';

        $stmt2 = $this->conn->prepare($query2);

        $stmt2->bindParam(':BusID' ,$this->BusID);

        $stmt2->execute();

        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->Price = $row2['Price'];

        if ($this->Balance < $this->Price) {
            $this->Response = "Please Fill Up The Balance First";
        }else {
            $this->newBalance = $this->Balance - $this->Price;
            $query3 = 'UPDATE users 
                        SET 
                        Balance = ' .$this->newBalance. '
                        WHERE
                        UserID = :UserID';

            $stmt3 = $this->conn->prepare($query3);
            $stmt3->bindParam( ':UserID' ,$this->UserID);
            $stmt3->execute();

            $query4 = 'INSERT INTO ride 
                        SET 
                        UserID = :UserID,
                        BusID = :BusID';
            $stmt4 = $this->conn->prepare($query4);
            $stmt4->bindParam( ':UserID' ,$this->UserID);
            $stmt4->bindParam(':BusID' ,$this->BusID);
            $stmt4->execute();
            $String = "$this->newBalance";
            $this->Response = "Payment Success, Your New Balance is $String";
        }
  }
}

$database = new Database();
$db = $database->connect();
$bus = new bus($db);

$bus->UserID = isset($_GET['UserID']) ? $_GET['UserID']: die();
$bus->BusID = isset($_GET['BusID']) ? $_GET['BusID']: die();

$bus->payment();

$array = array();

$bus_array = array(
    'message' => $bus->Response,
  );

array_push($array,$bus_array);
echo json_encode($array);
?>
