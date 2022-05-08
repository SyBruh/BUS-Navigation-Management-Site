<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'Database.php';
class busstop{
    private $conn;
    private $table = 'busstop';

    // Post Properties
    public $checkBusNo;
    public $check;
    public $id;
    public $btarrayposition;
    public $bsarrayposition;
    public $positionholderID;
    public $btarrayitem;
    public $soarrayitem;
    public $BusStop;
    public $BusNo;
    public $FRouteID;
    public $count;
    public $bsarray;
    public $btarray;
    public $soarray;
    public $finalarray;
    public $arrayresult;
    public $countsecondstmt;
  

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function read_single() {

        $this->btarray = array();
        $this->bsarray = array();
        $this->soarray = array();
        $this->id = array();
        $this->check = array();
        $this->arrayresult = array();

        $firstquery = 'SELECT bt.BusNo, bs.BusStopID, b.StopOrder
                        FROM bustype bt, br b, '.$this->table.' bs, froute r, interroute ir
                        WHERE bt.BusTypeID=b.BusTypeID
                        AND b.BusStopID=bs.BusStopID
                        AND ir.BRID=b.BRID
                        AND ir.FRouteID=r.FRouteID
                        AND r.FRouteID= :RouteID';

        $firststmt = $this->conn->prepare($firstquery);

        $firststmt->bindParam(':RouteID', $this->FRouteID);

        $firststmt->execute();

        $countfirststmt=$firststmt->rowCount();

        // $arrayfirst = array();

        // while ($row = $firststmt->fetch(PDO::FETCH_ASSOC)) {
        //     extract($row);
        //     $arrayfirst = array(
        //         'BusTypeID' => $this->id
        //     );
        // }

        for ($i=0; $i < $countfirststmt; $i++) { 
            $row = $firststmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $this->bsarray[$i] = $row['BusStopID'];
            $this->count = null;
            $this->checkBusNo = $row['BusNo'];
            for ($k=0; $k < sizeof($this->btarray) ; $k++) { 
              if ($this->btarray[$k] ==  $this->checkBusNo) {
                $this->count = "exist";
              }
            }
            if ($this->count == null) {
               $this->btarrayitem = $this->checkBusNo;
               array_push($this->btarray,$this->btarrayitem);
            }
        }

        for ($i=0; $i < sizeof($this->bsarray) ; $i++) { 
            for ($j=0; $j < sizeof($this->btarray) ; $j++) { 
              $this->btarrayposition = $this->btarray[$j];
              $this->bsarrayposition = $this->bsarray[$i];
              $secondquery='SELECT b.StopOrder, b.BusTypeID
                          FROM bustype bt, br b, busstop bs
                          WHERE bt.BusTypeID=b.BusTypeID
                          AND b.BusStopID=bs.BusStopID
                          AND bs.BusStopID='.$this->bsarrayposition.'
                          AND bt.BusNo='.$this->btarrayposition.'
                          ORDER BY b.BusTypeID';
              $secondstmt = $this->conn->prepare($secondquery);
              $secondstmt->execute();
              $this->countsecondstmt=$secondstmt->rowCount();
              if ($this->countsecondstmt != null) {
                $rowsecond =  $secondstmt->fetch(PDO::FETCH_ASSOC);
                extract($rowsecond);
                $this->soarrayitem=$rowsecond['StopOrder'];
                array_push($this->soarray, $this->soarrayitem);
              }
              array_push($this->id,$this->countsecondstmt);
             
            }
        }


        for ($i=0; $i < sizeof($this->btarray) ; $i++) { 
          array_push($this->check, "work");
            if ($this->soarray[$i + $i] > $this->soarray[$i + $i +1]) {
                $thirdquery = 'SELECT bt.BusNo, bs.BusStop, b.StopOrder
                                FROM bustype bt, br b, '.$this->table.' bs
                                WHERE bt.BusTypeID=b.BusTypeID
                                AND b.BusStopID=bs.BusStopID
                                AND bt.BusTypeID='.$this->btarray[$i].'
                                ORDER BY StopOrder DESC';
                $thirdstmt = $this->conn->prepare($thirdquery);
                $thirdstmt->execute();
                $countthirdstmt=$thirdstmt->rowCount();
                for ($j=0; $j < $countthirdstmt ; $j++) { 
                    $rowthird = $thirdstmt->fetch(PDO::FETCH_ASSOC);
                    extract($rowthird);
                    if ($rowthird['StopOrder']<=$this->soarray[$i + $i] and $rowthird['StopOrder']>=$this->soarray[$i + $i + 1]) 
                        {
                          $this->BusNo = $rowthird['BusNo'];
                          $this->BusStop = $rowthird['BusStop'];
                            $this->finalarray = array(
                                'BusStop' => $this->BusStop,
                                'BusNo' => $this->BusNo
                            );

                            array_push($this->arrayresult, $this->finalarray);
                        }
                }
            }
            else {
              $thirdquery = 'SELECT bt.BusNo, bs.BusStop, b.StopOrder
                                FROM bustype bt, br b, '.$this->table.' bs
                                WHERE bt.BusTypeID=b.BusTypeID
                                AND b.BusStopID=bs.BusStopID
                                AND bt.BusTypeID='.$this->btarray[$i].'
                                ORDER BY StopOrder';
                $thirdstmt = $this->conn->prepare($thirdquery);
                $thirdstmt->execute();
                $countthirdstmt=$thirdstmt->rowCount();
                for ($j=0; $j < $countthirdstmt ; $j++) { 
                    $rowthird = $thirdstmt->fetch(PDO::FETCH_ASSOC);
                    extract($rowthird);
                    if ($rowthird['StopOrder']>=$this->soarray[$i + $i] and $rowthird['StopOrder']<=$this->soarray[$i + $i + 1]) 
                        {
                          $this->BusNo = $rowthird['BusNo'];
                          $this->BusStop = $rowthird['BusStop'];
                            $this->finalarray = array(
                                'BusStop' => $this->BusStop,
                                'BusNo' => $this->BusNo
                            );

                            array_push($this->arrayresult, $this->finalarray);
                        }
                }
            }
        }

        // // $this->positionholderID = $arrayfirst();

        // // Create query
        // $query = 'SELECT bs.BusStop
        //             FROM bustype bt, br b,'.$this->table.' bs
        //             WHERE bt.BusTypeID=b.BusTypeID
        //             AND b.BusStopID=bs.BusStopID
        //             AND bt.BusTypeID='.$this->id.'
        //             ORDER BY b.StopOrder';

        // // Prepare statement
        // $stmt = $this->conn->prepare($query);

        // // Execute query
        // $stmt->execute();
        return $this->arrayresult;
  }
}

$database = new Database();
$db = $database->connect();
$busstop = new busstop($db);

$busstop->FRouteID = isset($_GET['FRouteID']) ? $_GET['FRouteID']: die();

$result=$busstop->read_single();

echo json_encode($result);
// echo json_encode($busstop->soarray);
// echo json_encode($busstop->bsarray);
// echo json_encode($busstop->btarray);
// echo json_encode($busstop->btarrayposition);
// echo json_encode($busstop->bsarrayposition);
// echo json_encode($busstop->id);
// echo json_encode($busstop->finalarray);
// echo json_encode($busstop->check);
?>