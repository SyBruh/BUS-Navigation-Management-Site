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

?>
<!DOCTYPE html>
<html>
<head>
	<title>BusType Entry</title>
</head>
<body>
<form action="BusType.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

<fieldset>
<legend>Enter BusType Information :</legend>

<table>
<tr>
	<td>
		<table>
			<tr>
				<td>
					StatStop
				</td>
				<td>
					FinalStop
				</td>
			</tr>
			<tr>
				<td>
					<select name="cmdStartStop" id="" required>
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
				</td>
				<td>
					<select name="cmdFinalStop" id=""required>
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
				</td>
			</tr>
		</table>
	</td>
	<td></td>
	<td>BusNo</td>
	<td>
		<input type="number" name="txtBusNo" placeholder="No." required />
	</td>
</tr>
<tr>
	<td>
		<table>
			<tr>
				<td>
					StartTime
				</td>
				<td>
					StopTime
				</td>
			</tr>
			<tr>
				<td>
					<input type="time" name="txtStartTime" placeholder="Time" required />
				</td>
				<td>
					<input type="time" name="txtStopTime" placeholder="Time" required />
				</td>
			</tr>
		</table>
	</td>
	<td></td>
	<td>Price</td>
	<td>
		<input type="number" name="txtPrice" placeholder="Price" required />
	</td>	
</tr>
<tr>
	<td>No of Gates</td>
	<td>
		<input type="number" name="txtNoofGates" placeholder="Number" required />
	</td>
	<td>BusRouteUrl</td>
	<td>
		<input type="text" name="txtBusRouteUrl" placeholder="Url" required />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnSave" value="Save" />
		<input type="reset" name="btnClear" value="Clear" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>