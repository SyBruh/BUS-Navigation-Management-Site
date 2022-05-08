<?php 
include 'Connect.php';

if(isset($_POST['btnUpdate'])) 
{
	$BRID=$_POST['txtBRID'];
	$cmdBuaStop=$_POST['cmdBuaStop'];
	$cmdBusNo=$_POST['cmdBusNo'];

	$Update="UPDATE BR
			 SET
			 BusStopID='$cmdBuaStop',
			 BusTypeID='$cmdBusNo'
			 WHERE
			 BRID='$BRID'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : BR Info Updated')</script>";
		echo "<script>window.location='BRList.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}

if (isset($_GET['BRID'])) 
{
	$BRID=$_GET['BRID'];

	$BR_List="SELECT bt.*, bs.*, b.*
				 FROM BusType bt, BusStop bs, BR b
				 WHERE bt.BusTypeID=b.BusTypeID
                 AND bs.BusStopID=b.BusStopID
                 AND BRID='$BRID'";
	$BR_ret=mysqli_query($connection,$BR_List);
	$BR_count=mysqli_num_rows($BR_ret);
	$rows=mysqli_fetch_array($BR_ret);

	if($BR_count < 1) 
	{
		echo "<script>window.alert('ERROR : BR Info Not Found')</script>";
		echo "<script>window.location='BRUpdate.php'</script>";
	}
}
else
{
	$BRID="";
}

 ?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<title>BR Entry</title>
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
<form action="BRUpdate.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter BusRoute Information :</legend>
<input type="hidden" name="txtBRID" value="<?php echo $BRID ?>">
<div class="form-group">
	<label for="BusStop">BusStop</label>
    <select class="form-control" id="BusStop" name="cmdBuaStop">
    <option value="<?php echo $rows['BusStopID'] ?>"><?php echo $rows['BusStop'] ?></option>
    <option>Choose BusStop</option>
		<?php  
		$BusStop_query="SELECT * FROM BusStop";
		$BusStop_ret=mysqli_query($connection,$BusStop_query);
		$BusStop_count=mysqli_num_rows($BusStop_ret);

		for($i=0;$i<$BusStop_count;$i++) 
		{ 
			$row=mysqli_fetch_array($BusStop_ret);
			$BusStopID=$row['BusStopID'];
			$BusStop=$row['BusStop'];

			echo "<option value='$BusStopID'>$BusStopID - $BusStop</option>";
		}
		?>
    </select>
</div>
<div class="form-group">
	<label for="BusNo">BusNo</label>
    <select class="form-control" id="BusNo" name="cmdBusNo">
    <option value="<?php echo $rows['BusTypeID'] ?>"><?php echo $rows['BusNo'] ?></option>
    <option>Choose BusNo</option>
		<?php  
		$BusNo_query="SELECT * FROM bustype";
		$BusNo_ret=mysqli_query($connection,$BusNo_query);
		$BusNo_count=mysqli_num_rows($BusNo_ret);

		for($i=0;$i<$BusNo_count;$i++) 
		{ 
			$row=mysqli_fetch_array($BusNo_ret);
			$BusTypeID=$row['BusTypeID'];
			$BusNo=$row['BusNo'];

			echo "<option value='$BusTypeID'>$BusTypeID - $BusNo</option>";
		}
		?>
    </select>
</div>
<div class="form-group">
	<label for="Stop_Order">Stop_Order</label>
	<input type="number" class="form-control" id="Stop_Order" name="txtStopOrder" value="<?php echo $rows['StopOrder'] ?>" required/>
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