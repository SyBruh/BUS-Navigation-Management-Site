<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
    {
	$txtDestination=$_POST['txtDestination'];
	$Select="SELECT * FROM destination
			WHERE Destination='$txtDestination'";
	$retSelect=mysqli_query($connection,$Select);
	$Select_Count=mysqli_num_rows($retSelect);
		if ($Select_Count>0) 
		{
			echo "<script>window.alert('Error :Destination Already Exist')</script>";
			echo "<script>window.location='Destination.php'</script>";
		}
		else 
		{
			$Insert="INSERT INTO `destination`
				(`Destination`) 
				VALUES 
				('$txtDestination')
				";
			$ret=mysqli_query($connection,$Insert);

			if($ret) //True
			{
				echo "<script>window.alert('SUCCESS :New Destination Created')</script>";
				echo "<script>window.location='Destination.php'</script>";
			}
			else
			{
				echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
			}

			$Insert2="INSERT INTO `busstop`
					(`BusStop`) 
					VALUES 
					('$txtDestination')
					";
			$ret2=mysqli_query($connection,$Insert2);

			if($ret2) //True
			{
				echo "<script>window.alert('SUCCESS :New BusStop Created')</script>";
				echo "<script>window.location='Destination.php'</script>";
			}
			else
			{
				echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
			}

			$Destination_query="SELECT * FROM Destination";
			$Destination_ret=mysqli_query($connection,$Destination_query);
			$Destination_count=mysqli_num_rows($Destination_ret);

			for($i=0;$i<$Destination_count;$i++) 
			{ 
				$row=mysqli_fetch_array($Destination_ret);
				$DestinationID=$row['DestinationID'];
				$Destination=$row['Destination'];

				if ($Destination == $txtDestination) 
				{
					$Insert3="INSERT INTO startdestination
					(StartDestination, DestinationID)
					VALUES
					('$txtDestination', '$DestinationID')
					";
					$ret3=mysqli_query($connection,$Insert3);

					if($ret3) //True
					{
						echo "<script>window.alert('SUCCESS :New StartDestination Created')</script>";
						echo "<script>window.location='Destination.php'</script>";
					}
					else
					{
						echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
					}

					$Insert4="INSERT INTO finaldestination
							(FinalDestination, DestinationID)
							VALUES
							('$txtDestination', '$DestinationID')
							";
					$ret4=mysqli_query($connection,$Insert4);

					if($ret4) //True
					{
						echo "<script>window.alert('SUCCESS :New FinalDestination Created')</script>";
						echo "<script>window.location='Destination.php'</script>";
					}
					else
					{
						echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
					}
				}
			}
		}
  	}  
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
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
<body class="h-100" style="background-color: rgba(194, 201, 157, 0.38);">
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
			<form action="Destination.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

			<fieldset>
			<legend>Enter Destination Information :</legend>
			<div class="form-group">
				<label for="Destination">Destination</label>
				<input type="text" class="form-control" id="Destination" name="txtDestination" maxlength="25" size="25" placeholder="Place" required/>
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