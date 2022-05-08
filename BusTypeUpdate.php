<?php
include 'Connect.php';

if(isset($_POST['btnUpdate'])) 
{
	$BusTypeID=$_POST['txtBusTypeID'];
	$cmdStartStop=$_POST['cmdStartStop'];
	$cmdFinalStop=$_POST['cmdFinalStop'];
	$txtBusNo=$_POST['txtBusNo'];
	$txtStartTime=$_POST['txtStartTime'];
	$txtStopTime=$_POST['txtStopTime'];
	$txtPrice=$_POST['txtPrice'];
	$txtNoofGates=$_POST['txtNoofGates'];
	$txtBusRouteUrl=$_POST['txtBusRouteUrl'];

	$Update="UPDATE BusType
			 SET
			 StartTime='$txtStartTime',
			 StopTime='$txtStopTime',
			 StartDestinationID='$cmdStartStop',
			 FinalDestinationID='$cmdFinalStop',
			 NoofGates='$txtNoofGates',
			 BusNo='$txtBusNo',
			 Price='$txtPrice',
			 BusRouteUrl='$txtBusRouteUrl'
			 WHERE
			 BusTypeID='$BusTypeID'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : BusType Info Updated')</script>";
		echo "<script>window.location='BusTypeList.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}


if (isset($_GET['BusTypeID'])) 
{
	$BusTypeID=$_GET['BusTypeID'];

	$BusType_List="SELECT bt.*, sd.*, fd.* 
				 FROM BusType bt, StartDestination sd, FinalDestination fd
				 WHERE bt.StartDestinationID=sd.StartDestinationID
                 AND bt.FinalDestinationID=fd.FinalDestinationID
                 AND BusTypeID='$BusTypeID'";
	$BusType_ret=mysqli_query($connection,$BusType_List);
	$BusType_count=mysqli_num_rows($BusType_ret);
	$rows=mysqli_fetch_array($BusType_ret);

	if($BusType_count < 1) 
	{
		echo "<script>window.alert('ERROR : BusType Info Not Found')</script>";
		echo "<script>window.location='BusTypeUpdate.php'</script>";
	}
}
else
{
	$BusTypeID="";
}

?>
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
<form action="BusTypeUpdate.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

<fieldset>
<legend>Enter BusType Information :</legend>
<input type="hidden" name="txtBusTypeID" value="<?php echo $BusTypeID ?>">
<div class="form-row">
<div class="form-group col-md-6">
	<label for="StartStop">StartStop</label>
    <select class="form-control" id="StartStop" name="cmdStartStop">
    <option value="<?php echo $rows['StartDestinationID'] ?>"><?php echo $rows['StartDestination'] ?></option>
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
    <option value="<?php echo $rows['FinalDestinationID'] ?>"><?php echo $rows['FinalDestination'] ?></option>
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
	<input type="number" class="form-control" id="BusNo" name="txtBusNo" value="<?php echo $rows['BusNo'] ?>" required/>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="StartTime">StartTime</label>
      <input type="time" class="form-control" id="StartTime" name="txtStartTime" value="<?php echo $rows['StartTime'] ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="StopTime">StopTime</label>
      <input type="time" class="form-control" id="StopTime" name="txtStopTime" value="<?php echo $rows['StopTime'] ?>">
    </div>
</div>
<div class="form-group">
	<label for="Price">Price</label>
	<input type="number" class="form-control" id="Price" name="txtPrice" value="<?php echo $rows['Price'] ?>" required/>
</div>
<div class="form-group">
	<label for="NoofGates">No_of_Gates</label>
	<input type="number" class="form-control" id="NoofGates" name="txtNoofGates" value="<?php echo $rows['NoofGates'] ?>" required/>
</div>
<div class="form-group">
	<label for="BusRouteUrl">BusRouteUrl</label>
	<input type="text" class="form-control" id="BusRouteUrl" name="txtBusRouteUrl" value="<?php echo $rows['BusRouteUrl'] ?>" required/>
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