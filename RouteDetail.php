<?php
	include('Connect.php');
    $btarray[]="";
    $soarray[]="";
    $bsarray[]="";
    if (isset($_GET['RouteID'])) 
    {
        $RouteID=$_GET['RouteID'];

        $Route_List="SELECT * FROM froute
                        WHERE FRouteID = $RouteID";
        $Route_ret=mysqli_query($connection,$Route_List);
        $Route_count=mysqli_num_rows($Route_ret);
        $Route_rows=mysqli_fetch_array($Route_ret);

        $BusStop_List="SELECT bt.BusNo, bs.BusStopID, b.StopOrder
                        FROM bustype bt, br b, busstop bs, froute r, interroute ir
                        WHERE bt.BusTypeID=b.BusTypeID
                        AND b.BusStopID=bs.BusStopID
                        AND ir.BRID=b.BRID
                        AND ir.FRouteID=r.FRouteID
                        AND r.FRouteID=$RouteID";
        $BusStop_ret=mysqli_query($connection,$BusStop_List);
        $BusStop_count=mysqli_num_rows($BusStop_ret);

        for ($i=0; $i < $BusStop_count ; $i++) 
        { 
            $BusStop_rows=mysqli_fetch_array($BusStop_ret);
            $BusStopID=$BusStop_rows["BusStopID"];
            $bsarray[$i]=$BusStopID;
            $BusNo=$BusStop_rows["BusNo"];
            $count = null;
            for ($k=0; $k < sizeof($btarray) ; $k++) { 
              if ($btarray[$k] == $BusNo) {
                $count = "exist";
              }
            }
            if ($count == null) {
                $btarray[]=$BusNo;
            }
            // print_r($btarray);
        }

        for ($i=0; $i < sizeof($bsarray) ; $i++) { 
          for ($j=1; $j < sizeof($btarray) ; $j++) { 
            $StopOrder_List="SELECT b.StopOrder, b.BusTypeID
                        FROM bustype bt, br b, busstop bs
                        WHERE bt.BusTypeID=b.BusTypeID
                        AND b.BusStopID=bs.BusStopID
                        AND bs.BusStopID=$bsarray[$i]
                        AND bt.BusNo=$btarray[$j]
                        ORDER BY b.BusTypeID";
            $StopOrder_ret=mysqli_query($connection,$StopOrder_List);
            $StopOrder_count=mysqli_num_rows($StopOrder_ret);
            $StopOrder_rows=mysqli_fetch_array($StopOrder_ret);
            if ($StopOrder_count == 1) {
              $soarray[]=$StopOrder_rows["StopOrder"];
            }
            
          }
        }

        if($Route_rows < 1) 
        {
            echo "<script>window.alert('ERROR : BusType Info Not Found')</script>";
            echo "<script>window.location='BusTypeList.php'</script>";
        }
    }
else
{
	$RouteID="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
      <img src="Images/B.png" width="30" height="30" alt=""><img src="Images/M2.png" width="30" height="30" alt=""> Bus Management
    </a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="ManagerHome.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DataLists
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="DestinationList(New).php">Destination Lists/BusStop Lists</a>
            <a class="dropdown-item" href="BusTypeList.php">BusType/BusRoute Lists</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="BusList.php">Bus Lists</a>
            <a class="dropdown-item" href="BRList.php">BusStop assign Lists</a>
            <a class="dropdown-item" href="RouteList.php">Route Lists</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="UserInfoList.php">Users Information</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="ManagerLogin.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
<form action="RouteDetail.php" method='post'>
<fieldset style = "margin-top:10%;">
<legend>Route Detail</legend>
<input type="hidden" name="txtRouteID" value="<?php echo $RouteID ?>">
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="StartDestination">StartDestination</label>
      <input type="text" class="form-control" id="StartDestination" value="<?php echo $Route_rows['StartDestination'] ?>" readonly/>
    </div>
    <div class="form-group col-md-6">
      <label for="FinalDestination">FinalDestination</label>
      <input type="text" class="form-control" id="FinalDestination" value="<?php echo $Route_rows['FinalDestination'] ?>" readonly/>
    </div>
</div>
<?php  

if ($BusStop_count < 1) 
{
	echo "<p>No BusType Record Found.</p>";
}
else
{
        for($i=1;$i< sizeof($btarray) ;$i++) 
        { 
                if ($soarray[$i + $i - 1] > $soarray[$i + $i]) 
                {
                    $BusNo_List="SELECT bt.BusNo, bs.BusStop, b.StopOrder
                                    FROM bustype bt, br b, busstop bs
                                    WHERE bt.BusTypeID=b.BusTypeID
                                    AND b.BusStopID=bs.BusStopID
                                    AND bt.BusTypeID=$btarray[$i]
                                    ORDER BY StopOrder DESC";
                    $BusNo_ret=mysqli_query($connection,$BusNo_List);
                    $BusNo_count=mysqli_num_rows($BusNo_ret);
                    // print_r($btarray);
                    // print_r($soarray);
?>
                    <div class="form-group row">
                    <label for="BusNo" class="col-sm-2 col-form-label">BusNo</label>
                    <div class="col-sm-10">
                    <input type="text" readonly name="txtBusNo" class="form-control" id="BusNo" value="<?php echo $btarray[$i] ?>"/>
                    </div>
                    </div>
                    <table id="tableid" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">BusStop</th>
                    </tr>
                    </thead>
                    <tbody class="table">   
<?php  
                    for ($j=0; $j <$BusNo_count ; $j++) 
                    { 
                        $BusNo_rows=mysqli_fetch_array($BusNo_ret);
                        if ($BusNo_rows['StopOrder']<=$soarray[$i + $i - 1] and $BusNo_rows['StopOrder']>=$soarray[$i + $i]) 
                        {
                            echo "<tr>";
                            echo "<td>" . ($j + 1) ."</td>";
                            echo "<td>$BusNo_rows[BusStop]</td>";
                        }
                    }
?>
                    </tbody>
                    </table>
<?php
                }
                else 
                {
                    $BusNo_List="SELECT bt.BusNo, bs.BusStop, b.StopOrder
                                    FROM bustype bt, br b, busstop bs
                                    WHERE bt.BusTypeID=b.BusTypeID
                                    AND b.BusStopID=bs.BusStopID
                                    AND bt.BusTypeID=$btarray[$i]
                                    ORDER BY StopOrder";
                    $BusNo_ret=mysqli_query($connection,$BusNo_List);
                    $BusNo_count=mysqli_num_rows($BusNo_ret);
?>
                    <div class="form-group row">
                    <label for="BusNo" class="col-sm-2 col-form-label">BusNo</label>
                    <div class="col-sm-10">
                    <input type="text" readonly name="txtBusNo" class="form-control" id="BusNo" value="<?php echo $btarray[$i] ?>"/>
                    </div>
                    </div>
                    <table id="tableid" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">BusStop</th>
                    </tr>
                    </thead>
                    <tbody class="table">   
<?php  
                    for ($j=0; $j <$BusNo_count ; $j++) 
                    { 
                        $BusNo_rows=mysqli_fetch_array($BusNo_ret);
                        if ($BusNo_rows['StopOrder']>=$soarray[$i + $i - 1] and $BusNo_rows['StopOrder']<=$soarray[$i + $i]) 
                        {
                            echo "<tr>";
                            echo "<td>" . ($j + 1) ."</td>";
                            echo "<td>$BusNo_rows[BusStop]</td>";
                        }
                    }
?>
                    </tbody>
                    </table>
<?php
                }
    }
}
?>
</fieldset>
</form>
</body>
</html>
<?php
include 'Footing.php';
?>