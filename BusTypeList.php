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
<form action="BusTypeList.php" method='post'>
<fieldset style = "margin-top:10%;">
<legend>BusType List :</legend>
<?php  
$BusType_List="SELECT * FROM bustype";
$BusType_ret=mysqli_query($connection,$BusType_List);
$BusType_count=mysqli_num_rows($BusType_ret);

if ($BusType_count < 1) 
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
		<th scope="col">BusType ID</th>
		<th scope="col">StartTime</th>
        <th scope="col">StopTime</th>
        <th scope="col">StartDestination</th>
        <th scope="col">FinalDestination</th>
        <th scope="col">No_of_Gates</th>
        <th scope="col">BusNo</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
        <th scope="col"></th>
	</tr>
	</thead>
	<tbody class="table">
	<?php 
	for($i=0;$i<$BusType_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($BusType_ret);
		//print_r($rows);

		$BusTypeID=$rows['BusTypeID'];
		$StartTime=$rows['StartTime'];
        $StopTime=$rows['StopTime'];
        $StartDestinationID=$rows['StartDestinationID'];
        $StartDestination_query="SELECT s.StartDestination
                                FROM startdestination s, bustype bt
                                WHERE s.StartDestinationID=bt.StartDestinationID
                                AND bt.StartDestinationID=$StartDestinationID";
        $StartDestination_ret=mysqli_query($connection,$StartDestination_query);
        $StartDestination_row = mysqli_fetch_array($StartDestination_ret);
        $StartDestination=$StartDestination_row['StartDestination'];
        $FinalDestinationID=$rows['FinalDestinationID'];
        $FinalDestination_query="SELECT f.FinalDestination
                                FROM finaldestination f, bustype bt
                                WHERE f.FinalDestinationID=bt.FinalDestinationID
                                AND bt.FinalDestinationID=$FinalDestinationID";
        $FinalDestination_ret=mysqli_query($connection,$FinalDestination_query);
        $FinalDestination_row = mysqli_fetch_array($FinalDestination_ret);
        $FinalDestination=$FinalDestination_row['FinalDestination'];
        $NoofGates=$rows['NoofGates'];
        $BusNo=$rows['BusNo'];
        $Price=$rows['Price'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$BusTypeID</td>";
		echo "<td>$StartTime</td>";
        echo "<td>$StopTime</td>";
        echo "<td>$StartDestination</td>";
        echo "<td>$FinalDestination</td>";
        echo "<td>$NoofGates</td>";
        echo "<td>$BusNo</td>";
        echo "<td>$Price</td>";
		echo "<td>
			  <a role='button' class='btn btn-light' href='BusTypeUpdate.php?BusTypeID=$BusTypeID'>Update</a> 
			  <a role='button' class='btn btn-dark' href='BusTypeDelete.php?BusTypeID=$BusTypeID'>Delete</a>
			  </td>";
        echo "<td>
			  <a role='button' class='btn btn-primary' href='BusTypeDetail.php?BusTypeID=$BusTypeID'>Detail</a> 
			  </td>";
		echo "</tr>";
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