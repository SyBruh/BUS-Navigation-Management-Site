<?php 
include 'Connect.php';

if (isset($_POST['btnUpdate'])) 
{
	$DestinationID=$_POST['txtDestinationID'];
	$txtDestination=$_POST['txtDestination'];

    $Destination_List="SELECT * 
				 FROM destination
				 WHERE DestinationID='$DestinationID'";
	$Destination_ret=mysqli_query($connection,$Destination_List);
	$Destination_count=mysqli_num_rows($Destination_ret);
	$rows=mysqli_fetch_array($Destination_ret);
    $Destination=$rows['Destination'];
    print($Destination);

	$Update1="UPDATE destination
			 SET
			 Destination='$txtDestination'

			 WHERE DestinationID='$DestinationID'";
    
    $Update2="UPDATE startdestination
			 SET
			 StartDestination='$txtDestination'

			 WHERE DestinationID='$DestinationID'";

    $Update3="UPDATE finaldestination
            SET
            FinalDestination='$txtDestination'

            WHERE DestinationID='$DestinationID'";         

    $Update4="UPDATE busstop
            SET
            BusStop='$txtDestination'

            WHERE BusStop='$Destination'";

	$ret1=mysqli_query($connection,$Update1);
    $ret2=mysqli_query($connection,$Update2);
    $ret3=mysqli_query($connection,$Update3);
    $ret4=mysqli_query($connection,$Update4);

	if($ret1 and $ret2 and $ret3 and $ret4) //True
	{
		echo "<script>window.alert('SUCCESS : Destination Info Updated')</script>";
		echo "<script>window.location='DestinationList(New).php'</script>";
	}
    elseif ($ret1) 
    {
       print("up 1 complete");
    }
    elseif ($ret2) 
    {
       print("up 2 complete");
    }
    elseif ($ret3) 
    {
       print("up 3 complete");
    }
    elseif ($ret4) 
    {
       print("up 4 complete");
    }
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}
else
{
	$DestinationID="";
}

if (isset($_GET['DestinationID'])) 
{
	$DestinationID=$_GET['DestinationID'];

	$Destination_List="SELECT * 
				 FROM destination
				 WHERE DestinationID='$DestinationID'";
	$Destination_ret=mysqli_query($connection,$Destination_List);
	$Destination_count=mysqli_num_rows($Destination_ret);
	$rows=mysqli_fetch_array($Destination_ret);

	if($Destination_count < 1) 
	{
		echo "<script>window.alert('ERROR : Destination Info Not Found')</script>";
		echo "<script>window.location='Destinationlist(New).php'</script>";
	}
}
else
{
	$DestinationID="";
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<title>Destination Entry</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Destination</title>
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
			<form action="DestinationUpdate.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

			<fieldset>
			<legend>Enter Destination Information :</legend>
			<input type="hidden" name="txtDestinationID" value="<?php echo $DestinationID ?>">
			<div class="form-group">
				<label for="Destination">Destination</label>
				<input type="text" class="form-control" id="Destination" name="txtDestination" value="<?php echo $rows['Destination'] ?>" required/>
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