<?php
 include 'Connect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Home Page</title>
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
<div class="row h-100 justify-content-center align-items-center" style="background-color: rgba(194, 201, 157, 0.38);">
<form  style = "margin-top:10%; margin-bottom:10%;" >
<div class="form-row">
    <div class="form-group col-md-6">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Destination</h5>
				<p class="card-text">To Add New Destinations/BusStops</p>
				<a href="Destination.php" class="card-link">Add Destination</a>
			</div>
		</div>
    </div>
    <div class="form-group col-md-6">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">BusType</h5>
				<p class="card-text">To Add New BusNo/Route of the Unique Bus No</p>
				<a href="BusType.php" class="card-link">Add BusType</a>
			</div>
		</div>
    </div>
	<div class="form-group col-md-6">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Assign BusStop</h5>
				<p class="card-text">To Add the BusStop for each BusRoute</p>
				<a href="BR.php" class="card-link">Assign BusStop</a>
			</div>
		</div>
    </div>
	<div class="form-group col-md-6">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Bus</h5>
				<p class="card-text">To Add the Bus Detail including bus driver</p>
				<a href="Bus.php" class="card-link">Add Bus</a>
			</div>
		</div>
    </div>
	<div class="form-group col-md-6">
		<div class="card" style="width: 18rem;">
			<div class="card-body">
				<h5 class="card-title">Route</h5>
				<p class="card-text">To Add the Route for each startdestination and finaldestination</p>
				<a href="Route.php" class="card-link">Add Route</a>
			</div>
		</div>
    </div>
</div>

</form> 
</div>
</body>
</html>
<?php
include 'Footing.php';
?>