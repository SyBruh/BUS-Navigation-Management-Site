<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
{
    $cmdStartDestination=$_POST['cmdStartDestination'];
    $cmdFinalDestination=$_POST['cmdFinalDestination'];
	$txtRouteUrl=$_POST['txtRouteUrl'];
    $sbt = [];
    $fbt = [];
	$check = "";
	
	$StartDestination_query = "SELECT BusStop FROM busstop
							WHERE BusStopID = $cmdStartDestination";
	$StartDestination_ret = mysqli_query($connection,$StartDestination_query);
	$StartDestination_row = mysqli_fetch_array($StartDestination_ret);
	$StartDestination = $StartDestination_row['BusStop'];
	
	$FInalDestination_query = "SELECT BusStop FROM busstop
							WHERE BusStopID = $cmdFinalDestination";
	$FinalDestination_ret = mysqli_query($connection,$FInalDestination_query);
	$FinalDestination_row = mysqli_fetch_array($FinalDestination_ret);
	$FinalDestination = $FinalDestination_row['BusStop'];
	//print($StartDestination);
	//print($FinalDestination);

	$BusStop_query="SELECT * FROM BusStop";
	$BusStop_ret=mysqli_query($connection,$BusStop_query);
	$BusStop2_ret=mysqli_query($connection,$BusStop_query);
	$BusStop_count=mysqli_num_rows($BusStop_ret);

	$BR_query="SELECT * FROM BR";
	$BR_ret=mysqli_query($connection,$BR_query);
	$BR2_ret=mysqli_query($connection,$BR_query);
	$BR_count=mysqli_num_rows($BR_ret);

	$BusType_query="SELECT * FROM BusType";
	$BusType_ret=mysqli_query($connection,$BusType_query);
	$BusType_count=mysqli_num_rows($BusType_ret);


	// print_r($BusStop_count);
	$Select="SELECT * FROM FRoute
			WHERE StartDestination='$cmdStartDestination'
			AND FinalDestination='$cmdFinalDestination'";
	$retSelect=mysqli_query($connection,$Select);
	$Select_Count=mysqli_num_rows($retSelect);
		if ($Select_Count>0) 
		{
			echo "<script>window.alert('Error :Route Already Assigned')</script>";
			echo "<script>window.location='Route.php'</script>";
		}
		elseif ($cmdStartDestination==$cmdFinalDestination) 
		{
			echo "<script>window.alert('Error :Same Start and Final Destination!!')</script>";
			echo "<script>window.location='Route.php'</script>";
		}
		else 
		{
			for($i=0;$i<$BusStop_count;$i++) 
			{ 
				$row=mysqli_fetch_array($BusStop2_ret);
				$BusStopID=$row['BusStopID'];
				// print_r($BusStopID);

				if ($BusStopID == $cmdStartDestination) 
				{
					for ($j=0; $j <$BR_count ; $j++) 
					{ 
						$row2=mysqli_fetch_array($BR_ret);
						$BRBusTypeID = $row2['BusTypeID'];
						$BRBusStopID = $row2['BusStopID'];
						if ($BRBusStopID == $BusStopID) 
						{
							$sbt[] = $BRBusTypeID;
						}
					}
				}

				if ($BusStopID == $cmdFinalDestination) 
				{
					for ($k=0; $k <$BR_count ; $k++) 
					{ 
						$row2=mysqli_fetch_array($BR2_ret);
						$BRBusTypeID = $row2['BusTypeID'];
						$BRBusStopID = $row2['BusStopID'];
						if ($BRBusStopID == $BusStopID) 
						{
							$fbt[] = $BRBusTypeID;
						}
					}
				}
			}
			// print_r($sbt);
			// print_r($fbt);
			for ($i=0; $i <	sizeof($sbt) ; $i++) 
			{ 
				for ($j=0; $j < sizeof($fbt) ; $j++) 
				{ 
					if ($sbt[$i] == $fbt[$j]) 
					{
						$check = "1";
						// print_r($check);
						for ($k=0; $k < $BusType_count ; $k++) 
						{ 
							$row2=mysqli_fetch_array($BusType_ret);
							$BusTypeID = $row2['BusTypeID'];
							$BusNo = $row2['BusNo'];
							if ($sbt[$i] == $BusTypeID) 
							{
								$froute = "Ride BusNo ".strval($BusNo)." from ".strval($StartDestination)." to ".strval($FinalDestination);
								print($froute);
								$Insert = "INSERT INTO `froute`
									(`StartDestination`,`FinalDestination`,`FRoute`,`FRouteUrl`)
									VALUES 
									('$StartDestination','$FinalDestination','$froute','$txtRouteUrl')
									";
								$ret=mysqli_query($connection,$Insert);

								if($ret) //True
								{
									echo "<script>window.alert('SUCCESS :New Route Created')</script>";
									echo "<script>window.location='Route.php'</script>";
								}
								else
								{
									echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
								}

								$FRoute_query = "SELECT FRouteID FROM froute
												WHERE StartDestination = '$StartDestination'
												AND FinalDestination = '$FinalDestination'";
								$FRoute_ret = mysqli_query($connection,$FRoute_query);
								$FRoute_row = mysqli_fetch_array($FRoute_ret);
								$FRouteID = $FRoute_row['FRouteID'];
								print_r($FRouteID);
								// print_r($FRoute_row);

								$Destinationloop = [$cmdStartDestination,$cmdFinalDestination];
								for ($l=0; $l < 2 ; $l++) 
								{ 
									$BRID_query="SELECT b.BRID FROM br b, busstop bs, bustype bt 
												WHERE b.BusStopID = bs.BusStopID
												AND b.BusTypeID = bt.BusTypeID
												AND bs.BusStopID = $Destinationloop[$l]
												AND bt.BusTypeID = $sbt[$i]";
									$BRID_ret=mysqli_query($connection,$BRID_query);
									$BRID_row=mysqli_fetch_array($BRID_ret);
									$BRID = $BRID_row['BRID'];
									print($BRID);
									
									$Insert2 = "INSERT INTO `interroute`
										(`FRouteID`,`BRID`)
										VALUES 
										('$FRouteID','$BRID')
										";
									$ret2=mysqli_query($connection,$Insert2);

									if($ret2) //True
									{
										echo "<script>window.alert('SUCCESS :New IR Created')</script>";
										echo "<script>window.location='Route.php'</script>";
									}
									else
									{
										echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
									}
								}
							}
						}
						
					}
				}
			}

			if ($check == "") 
			{
				for ($i=0; $i <	sizeof($sbt) ; $i++) 
				{ 
					for ($j=0; $j < sizeof($fbt) ; $j++) 
					{ 
						$sbsarray = [];
						$fbsarray = [];
						$BR3_ret=mysqli_query($connection,$BR_query);
						
						for ($k=0; $k < $BR_count ; $k++) 
						{ 
							$row2=mysqli_fetch_array($BR3_ret);
							$BRBusTypeID = $row2['BusTypeID'];
							$BRBusStopID = $row2['BusStopID'];

							if ($sbt[$i] == $BRBusTypeID) 
							{
								$sbsarray[] = $BRBusStopID;
							}

							if ($fbt[$j] == $BRBusTypeID) 
							{
								$fbsarray[] = $BRBusStopID;
							}
						}

						for ($l=0; $l < sizeof($sbsarray) ; $l++) 
						{ 
							for ($m=0; $m < sizeof($fbsarray); $m++) 
							{ 
								if ($sbsarray[$l] == $fbsarray[$m]) 
								{
									$check = "2";
									// print_r($check);
									$BusNo1_query = "SELECT BusNo FROM bustype
													WHERE BusTypeID = $sbt[$i]";
									$BusNo1_ret = mysqli_query($connection,$BusNo1_query);
									$BusNo1_row = mysqli_fetch_array($BusNo1_ret);
									$BusNo1 = $BusNo1_row['BusNo'];
									print($BusNo1);

									$BusNo2_query = "SELECT BusNo FROM bustype
													WHERE BusTypeID = $fbt[$j]";
									$BusNo2_ret = mysqli_query($connection,$BusNo2_query);
									$BusNo2_row = mysqli_fetch_array($BusNo2_ret);
									$BusNo2 = $BusNo2_row['BusNo'];
									print($BusNo2);

									$MidBusStop_query = "SELECT BusStop FROM busstop
													WHERE BusStopID = $sbsarray[$l]";
									$MidBusStop_ret = mysqli_query($connection,$MidBusStop_query);
									$MidBusStop_row = mysqli_fetch_array($MidBusStop_ret);
									$MidBusStop = $MidBusStop_row['BusStop'];
									print($MidBusStop);

									$froute = "Ride BusNo ".$BusNo1." From ".$StartDestination." To ".$MidBusStop." And Then Change Into BusNo ".$BusNo2." To Reach ".$FinalDestination;
									print($froute);

									$Insert = "INSERT INTO `froute`
											(`StartDestination`,`FinalDestination`,`FRoute`,`FRouteUrl`)
											VALUES 
											('$StartDestination','$FinalDestination','$froute','$txtRouteUrl')
											";
									$ret=mysqli_query($connection,$Insert);

									if($ret) //True
									{
										echo "<script>window.alert('SUCCESS :New Route Created')</script>";
										echo "<script>window.location='Route.php'</script>";
									}
									else
									{
										echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
									}

									$FRoute_query = "SELECT FRouteID FROM froute
													WHERE StartDestination = '$StartDestination'
													AND FinalDestination = '$FinalDestination'";
									$FRoute_ret = mysqli_query($connection,$FRoute_query);
									$FRoute_row = mysqli_fetch_array($FRoute_ret);
									$FRouteID = $FRoute_row['FRouteID'];
									print_r($FRouteID);

									$Destinationloop = [$cmdStartDestination,$sbsarray[$l],$cmdFinalDestination];
									for ($n=0; $n < 3 ; $n++) 
									{ 
										$BRID_query="SELECT b.BRID FROM br b, busstop bs, bustype bt 
													WHERE b.BusStopID = bs.BusStopID
													AND b.BusTypeID = bt.BusTypeID
													AND bs.BusStopID = $Destinationloop[$n]
													AND (bt.BusTypeID = $sbt[$i] OR bt.BusTypeID = $fbt[$j])";
										$BRID_ret=mysqli_query($connection,$BRID_query);
										$BRID_row=mysqli_fetch_array($BRID_ret);
										$BRID = $BRID_row['BRID'];
										print($BRID);
										
										$Insert2 = "INSERT INTO `interroute`
											(`FRouteID`,`BRID`)
											VALUES 
											('$FRouteID','$BRID')
											";
										$ret2=mysqli_query($connection,$Insert2);

										if($ret2) //True
										{
											echo "<script>window.alert('SUCCESS :New IR Created')</script>";
											echo "<script>window.location='Route.php'</script>";
										}
										else
										{
											echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
										}
									}

								}
							}
						}
					}
				}
			}

			if ($check == "") 
			{
				for ($i=0; $i <	sizeof($sbt) ; $i++) 
				{ 
					for ($j=0; $j < sizeof($fbt) ; $j++) 
					{ 
						$sbsarray = [];
						$fbsarray = [];
						$BR4_ret=mysqli_query($connection,$BR_query);
						
						
						for ($k=0; $k < $BR_count ; $k++) 
						{ 
							$row2=mysqli_fetch_array($BR4_ret);
							$BRBusTypeID = $row2['BusTypeID'];
							$BRBusStopID = $row2['BusStopID'];

							if ($sbt[$i] == $BRBusTypeID) 
							{
								$sbsarray[] = $BRBusStopID;
							}

							if ($fbt[$j] == $BRBusTypeID) 
							{
								$fbsarray[] = $BRBusStopID;
							}
						}

						for ($l=0; $l < sizeof($sbsarray) ; $l++) 
						{ 
							for ($m=0; $m < sizeof($fbsarray); $m++) 
							{ 
								$sbtarray = [];
								$fbtarray = [];
								$BR5_ret=mysqli_query($connection,$BR_query);
								
								for ($n=0; $n < $BR_count ; $n++) 
								{ 
									$row2=mysqli_fetch_array($BR5_ret);
									$BRBusTypeID = $row2['BusTypeID'];
									$BRBusStopID = $row2['BusStopID'];
									// print($n);
									// print($sbsarray[$l]);
									// print($BRBusStopID);

									if ($sbsarray[$l] == $BRBusStopID) 
									{
										// $check = "3";
										// 	print_r($check);
										// print_r($sbsarray[$l]);
										// print("sbsarray");
										// print_r($sbsarray);
										$sbtarray[] = $BRBusTypeID;
										// print("sbtarray");
										// print_r($sbtarray);
									}

									if ($fbsarray[$m] == $BRBusStopID) 
									{
										// print("fbsarray");
										// print_r($fbsarray);
										$fbtarray[] = $BRBusTypeID;
										// print("fbtarray");
										// print_r($fbtarray);
									}
								}

								for ($o=0; $o < sizeof($sbtarray) ; $o++) 
								{ 
									for ($p=0; $p < sizeof($fbtarray); $p++) 
									{ 
										if ($sbtarray[$o] == $fbtarray[$p]) 
										{
											$check = "3";
											print_r($check);
											$BusNo1_query = "SELECT BusNo FROM bustype
													WHERE BusTypeID = $sbt[$i]";
											$BusNo1_ret = mysqli_query($connection,$BusNo1_query);
											$BusNo1_row = mysqli_fetch_array($BusNo1_ret);
											$BusNo1 = $BusNo1_row['BusNo'];
											print($BusNo1);

											$BusNo2_query = "SELECT BusNo FROM bustype
															WHERE BusTypeID = $fbt[$j]";
											$BusNo2_ret = mysqli_query($connection,$BusNo2_query);
											$BusNo2_row = mysqli_fetch_array($BusNo2_ret);
											$BusNo2 = $BusNo2_row['BusNo'];
											print($BusNo2);

											$MidBus_query = "SELECT BusNo FROM bustype
															WHERE BusTypeID = $sbtarray[$o]";
											$MidBus_ret = mysqli_query($connection,$MidBus_query);
											$MidBus_row = mysqli_fetch_array($MidBus_ret);
											$MidBus = $MidBus_row['BusNo'];
											print($MidBus);

											$MidBusStop1_query = "SELECT BusStop FROM busstop
													WHERE BusStopID = $sbsarray[$l]";
											$MidBusStop1_ret = mysqli_query($connection,$MidBusStop1_query);
											$MidBusStop1_row = mysqli_fetch_array($MidBusStop1_ret);
											$MidBusStop1 = $MidBusStop1_row['BusStop'];
											print($MidBusStop1);

											$MidBusStop2_query = "SELECT BusStop FROM busstop
													WHERE BusStopID = $fbsarray[$m]";
											$MidBusStop2_ret = mysqli_query($connection,$MidBusStop2_query);
											$MidBusStop2_row = mysqli_fetch_array($MidBusStop2_ret);
											$MidBusStop2 = $MidBusStop2_row['BusStop'];
											print($MidBusStop2);

											$froute = "Ride BusNo ".$BusNo1." From ".$StartDestination." To ".$MidBusStop1." And Then Change Into BusNo ".$MidBus." And Stop at ".$MidBusStop2.". Then Ride BusNo ".$BusNo2." From ".$MidBusStop2." To ".$FinalDestination;
											print($froute);
											$Insert = "INSERT INTO `froute`
													(`StartDestination`,`FinalDestination`,`FRoute`,`FRouteUrl`)
													VALUES 
													('$StartDestination','$FinalDestination','$froute','$txtRouteUrl')
													";
											$ret=mysqli_query($connection,$Insert);

											if($ret) //True
											{
												echo "<script>window.alert('SUCCESS :New Route Created')</script>";
												echo "<script>window.location='Route.php'</script>";
											}
											else
											{
												echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
											}

											$FRoute_query = "SELECT FRouteID FROM froute
															WHERE StartDestination = '$StartDestination'
															AND FinalDestination = '$FinalDestination'";
											$FRoute_ret = mysqli_query($connection,$FRoute_query);
											$FRoute_row = mysqli_fetch_array($FRoute_ret);
											$FRouteID = $FRoute_row['FRouteID'];
											print_r($FRouteID);

											$Destinationloop = [$cmdStartDestination,$sbsarray[$l],$fbsarray[$m],$cmdFinalDestination];
											for ($n=0; $n < 4 ; $n++) 
											{ 
												$BRID_query="SELECT b.BRID FROM br b, busstop bs, bustype bt 
															WHERE b.BusStopID = bs.BusStopID
															AND b.BusTypeID = bt.BusTypeID
															AND bs.BusStopID = $Destinationloop[$n]
															AND (bt.BusTypeID = $sbt[$i] OR bt.BusTypeID = $fbt[$j] OR bt.BusTypeID = $sbtarray[$o])";
												$BRID_ret=mysqli_query($connection,$BRID_query);
												$BRID_row=mysqli_fetch_array($BRID_ret);
												$BRID = $BRID_row['BRID'];
												print($BRID);
												
												$Insert2 = "INSERT INTO `interroute`
													(`FRouteID`,`BRID`)
													VALUES 
													('$FRouteID','$BRID')
													";
												$ret2=mysqli_query($connection,$Insert2);

												if($ret2) //True
												{
													echo "<script>window.alert('SUCCESS :New IR Created')</script>";
													echo "<script>window.location='Route.php'</script>";
												}
												else
												{
													echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
												}
											}
										}	
									}
								}
							}
						}
					}
				}
			}
		}
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
<form action="Route.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Route Information :</legend>
<div class="form-group">
	<label for="StartDestination">StartDestination</label>
    <select class="form-control" id="StartDestination" name="cmdStartDestination" required>
    <option>Choose StartDestination</option>
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
	<label for="FinalDestination">FinalDestination</label>
    <select class="form-control" id="FinalDestination" name="cmdFinalDestination" required>
    <option>Choose FinalDestination</option>
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
	<label for="RouteUrl">RouteUrl</label>
	<input type="url" class="form-control" id="RouteUrl" name="txtRouteUrl" placeholder="Url" required/>
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