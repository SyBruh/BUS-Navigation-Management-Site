<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
{
    $txtStartTime=$_POST['txtStartTime'];
    $txtStopTime=$_POST['txtStopTime'];
    $cmdStartStop=$_POST['cmdStartStop'];
	$cmdFinalStop=$_POST['cmdFinalStop'];
	$txtNoofGates=$_POST['txtNoofGates'];
    $txtBusNo=$_POST['txtBusNo'];
    $txtPrice=$_POST['txtPrice'];
	$txtBusRouteUrl=$_POST['txtBusRouteUrl'];

	$Select="SELECT * FROM BusType
			WHERE BusNo='$txtBusNo'";
	$retSelect=mysqli_query($connection,$Select);
	$Select_Count=mysqli_num_rows($retSelect);
		if ($Select_Count>0) 
		{
			echo "<script>window.alert('Error :BusType Already Exist')</script>";
			echo "<script>window.location='BusType.php'</script>";
		}
		elseif ($cmdStartStop==$cmdFinalStop) 
		{
			echo "<script>window.alert('Error :Same StartStop and FinalStop')</script>";
			echo "<script>window.location='BusType.php'</script>";
		}
		else 
		{
			$Insert="INSERT INTO `bustype`
				(`StartTime`,`StopTime`,`StartDestinationID`, `FinalDestinationID`, `NoofGates`,`BusNo`,`Price`, `BusRouteUrl`)
				VALUES 
				('$txtStartTime','$txtStopTime','$cmdStartStop','$cmdFinalStop', '$txtNoofGates','$txtBusNo','$txtPrice','$txtBusRouteUrl')
				";
			$ret=mysqli_query($connection,$Insert);

			if($ret) //True
			{
				echo "<script>window.alert('SUCCESS : Bus Type Created')</script>";
				echo "<script>window.location='BusType.php'</script>";
			}
			else
			{
				echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
			}
		}
	
}

?>
<!DOCTYPE html>
<html lang="en"  class="h-100">
<head>
	<title>BusType Entry</title>
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
<body  class="h-100">
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
<form action="BusType.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

<fieldset>
<legend>Enter BusType Information :</legend>
<div class="form-row">
<div class="form-group col-md-6">
	<label for="StartStop">StartStop</label>
    <select class="form-control" id="StartStop" name="cmdStartStop">
    <option>Choose StartStop</option>
		<?php  
		$Start_query="SELECT * FROM startdestination";
		$Start_ret=mysqli_query($connection,$Start_query);
		$Start_count=mysqli_num_rows($Start_ret);

		for($i=0;$i<$Start_count;$i++) 
		{ 
			$row=mysqli_fetch_array($Start_ret);
			$StartDestinationID=$row['StartDestinationID'];
			$StartDestination=$row['StartDestination'];

			echo "<option value='$StartDestinationID'>$StartDestinationID - $StartDestination</option>";
		}
		?>
    </select>
</div>
<div class="form-group col-md-6">
	<label for="FinalStop">FinalStop</label>
    <select class="form-control" id="FinalStop" name="cmdFinalStop">
    <option>Choose FinalStop</option>
		<?php  
		$Final_query="SELECT * FROM finaldestination";
		$Final_ret=mysqli_query($connection,$Final_query);
		$Final_count=mysqli_num_rows($Final_ret);

		for($i=0;$i<$Final_count;$i++) 
		{ 
			$row=mysqli_fetch_array($Final_ret);
			$FinalDestinationID=$row['FinalDestinationID'];
			$FinalDestination=$row['FinalDestination'];

			echo "<option value='$FinalDestinationID'>$FinalDestinationID - $FinalDestination</option>";
		}
		?>
    </select>
</div>
</div>
<div class="form-group">
	<label for="BusNo">BusNo</label>
	<input type="number" class="form-control" id="BusNo" name="txtBusNo" min="1" placeholder="No" required/>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="StartTime">StartTime</label>
      <input type="time" class="form-control" id="StartTime" name="txtStartTime" min="04:00" max="11:00">
    </div>
    <div class="form-group col-md-6">
      <label for="StopTime">StopTime</label>
      <input type="time" class="form-control" id="StopTime" name="txtStopTime" min="13:00" max="22:00">
    </div>
</div>
<div class="form-group">
	<label for="Price">Price</label>
	<input type="number" class="form-control" id="Price" name="txtPrice" min="100" max="300" placeholder="100-300" required/>
</div>
<div class="form-group">
	<label for="NoofGates">No_of_Gates</label>
	<input type="number" class="form-control" id="NoofGates" name="txtNoofGates" min="1" max="30" placeholder="No" required/>
</div>
<div class="form-group">
	<label for="BusRouteUrl">BusRouteUrl</label>
	<input type="url" class="form-control" id="BusRouteUrl" name="txtBusRouteUrl" placeholder="Url" required/>
</div>
<button type="submit" class="btn btn-primary btn-customized" name="btnSave">Save</button>
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