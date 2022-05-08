<?php 
include 'Connect.php';

if(isset($_POST['btnUpdate'])) 
{
	$FRouteID=$_POST['txtRouteID'];
	$txtRouteUrl=$_POST['txtRouteUrl'];

	$Update="UPDATE FRoute
			 SET
			 FRouteUrl='$txtRouteUrl'
			 WHERE
             FRouteID='$FRouteID'
			 ";

	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Route Info Updated')</script>";
		echo "<script>window.location='RouteList.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_GET['RouteID'])) 
{
	$FRouteID=$_GET['RouteID'];

	$FRoute_List="SELECT *
				 FROM Froute
				 WHERE FRouteID='$FRouteID'";
	$FRoute_ret=mysqli_query($connection,$FRoute_List);
	$FRoute_count=mysqli_num_rows($FRoute_ret);
	$rows=mysqli_fetch_array($FRoute_ret);

	if($FRoute_count < 1) 
	{
		echo "<script>window.alert('ERROR : Route Info Not Found')</script>";
		echo "<script>window.location='RouteUpdate.php'</script>";
	}
}
else
{
	$FRouteID="";
}

 ?>
<!DOCTYPE html>
<html lang="en"  class="h-100">
<head>
	<title>Route Entry</title>
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
<body class="h-100">
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
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-10 col-md-8 col-lg-6">
<form action="RouteUpdate.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Route Information :</legend>
<input type="hidden" name="txtRouteID" value="<?php echo $FRouteID ?>">
<div class="form-group">
	<label for="StartDestination">StartDestination</label>
    <input type="text" class="form-control" id="StartDestination" name="txtStartDestination" value="<?php echo $rows['StartDestination'] ?>" readonly required/>
</div>
<div class="form-group">
	<label for="FinalDestination">FinalDestination</label>
    <input type="text" class="form-control" id="FinalDestination" name="txtFinalDestination" value="<?php echo $rows['FinalDestination'] ?>" readonly required/>
</div>
<div class="form-group">
	<label for="RouteUrl">RouteUrl</label>
	<input type="text" class="form-control" id="RouteUrl" name="txtRouteUrl" value="<?php echo $rows['FRouteUrl'] ?>" required/>
</div>
<button type="submit" class="btn btn-primary btn-customized" name="btnUpdate">Update</button>
<button type="reset" class="btn btn-primary btn-customized" name="btnClear">Clear</button>
</fieldset>
</form>
</div>
</div>
</div>
</body>
</html>
<?php
include 'Footing.php';
?>