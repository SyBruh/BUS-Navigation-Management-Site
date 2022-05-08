<?php
	include('Connect.php');
    if (isset($_GET['BusTypeID'])) 
    {
        $BusTypeID=$_GET['BusTypeID'];

        $BusType_List="SELECT bt.*, sd.StartDestination, fd.FinalDestination
                        FROM bustype bt, startdestination sd, finaldestination fd
                        WHERE bt.StartDestinationID = sd.StartDestinationID
                        AND bt.FinalDestinationID = fd.FinalDestinationID
                        AND bt.BusTypeID = $BusTypeID";
        $BusType_ret=mysqli_query($connection,$BusType_List);
        $BusType_count=mysqli_num_rows($BusType_ret);
        $BusType_rows=mysqli_fetch_array($BusType_ret);

        $BusStop_List="SELECT bs.BusStop
                        FROM bustype bt, br b, busstop bs
                        WHERE bt.BusTypeID=b.BusTypeID
                        AND b.BusStopID=bs.BusStopID
                        AND bt.BusTypeID=$BusTypeID
                        ORDER BY b.StopOrder";
        $BusStop_ret=mysqli_query($connection,$BusStop_List);
        $BusStop_count=mysqli_num_rows($BusStop_ret);

        if($BusType_count < 1) 
        {
            echo "<script>window.alert('ERROR : BusType Info Not Found')</script>";
            echo "<script>window.location='BusTypeList.php'</script>";
        }
    }
else
{
	$BusTypeID="";
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
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
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
<form action="BusTypeDetail.php" method='post'>
<fieldset style = "margin-top:10%;">
<legend>BusRoute Detail</legend>
<input type="hidden" name="txtBusTypeID" value="<?php echo $BusTypeID ?>">
<div class="form-group row">
    <label for="BusNo" class="col-sm-2 col-form-label">BusNo</label>
    <div class="col-sm-10">
      <input type="text" readonly name="txtBusNo" class="form-control" id="BusNo" value="<?php echo $BusType_rows['BusNo'] ?>"/>
    </div>
</div>
<div class="form-group row">
    <label for="Price" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
      <input type="text" name="txtPrice" class="form-control" id="Price" value="<?php echo $BusType_rows['Price'] ?>" readonly/>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="StartTime">StartTime</label>
      <input type="time" class="form-control" id="StartTime" value="<?php echo $BusType_rows['StartTime'] ?>" readonly/>
    </div>
    <div class="form-group col-md-6">
      <label for="StopTime">StopTime</label>
      <input type="time" class="form-control" id="StopTime" value="<?php echo $BusType_rows['StopTime'] ?>" readonly/>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="StartDestination">StartDestination</label>
      <input type="text" class="form-control" id="StartDestination" value="<?php echo $BusType_rows['StartDestination'] ?>" readonly/>
    </div>
    <div class="form-group col-md-6">
      <label for="FinalDestination">FinalDestination</label>
      <input type="text" class="form-control" id="FinalDestination" value="<?php echo $BusType_rows['FinalDestination'] ?>" readonly/>
    </div>
</div>
<div class="form-group row">
    <label for="NoofGates" class="col-sm-2 col-form-label">No_of_Gates</label>
    <div class="col-sm-10">
      <input type="text" readonly name="txtNoofGates" class="form-control" id="NoofGates" value="<?php echo $BusType_rows['NoofGates'] ?>"/>
    </div>
</div>
<?php  

if ($BusStop_count < 1) 
{
	echo "<p>No BusType Record Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-bordered table-striped">
	<thead class="thead-dark">
	<tr>
		<th scope="col">#</th>
		<th scope="col">BusStop</th>
	</tr>
	</thead>
	<tbody class="table">
	<?php 
	for($i=0;$i<$BusStop_count;$i++) 
	{ 
        $BusStop_rows=mysqli_fetch_array($BusStop_ret);
		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$BusStop_rows[BusStop]</td>";
	}
	 ?>
	 </tbody>
	</table>
<?php
}
?>
</fieldset>
</form>
</body>
</html>
<?php
include 'Footing.php';
?>