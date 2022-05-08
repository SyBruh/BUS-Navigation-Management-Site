<?php
	include('Connect.php');
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
<form action="RideHistoryList.php" method='post'>
<fieldset style = "margin-top:10%;">
<legend>Users List :</legend>
<?php
if (isset($_GET['UserID'])) 
{
$UserID = $_GET['UserID'];
$Ride_List="SELECT r.RideID,b.BusID,b.DriverName,r.Feedback 
            FROM ride r,bus b,users u 
            WHERE r.BusID = b.BusID
            AND r.UserID = u.UserID
            AND r.UserID = $UserID";
$Ride_ret=mysqli_query($connection,$Ride_List);
$Ride_count=mysqli_num_rows($Ride_ret);

if ($Ride_count < 1) 
{
	echo "<p>No Bus Record Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-bordered table-striped">
	<thead class="thead-dark">
	<tr>
		<th scope="col">#</th>
		<th scope="col">Ride ID</th>
		<th scope="col">BusID</th>
        <th scope="col">Driver Name</th>
        <th scope="col">Feedback</th>
        <th scope="col"></th>
	</tr>
	</thead>
	<tbody class="table">
	<?php 
	for($i=0;$i<$Ride_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Ride_ret);
		//print_r($rows);

		$RideID=$rows['RideID'];
		$BusID=$rows['BusID'];
        $DriverName=$rows['DriverName'];
        $Feedback=$rows['Feedback'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$RideID</td>";
		echo "<td>$BusID</td>";
        echo "<td>$DriverName</td>";
        echo "<td>$Feedback</td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
<?php
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