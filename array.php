<?php 
include 'Connect.php';

if(isset($_POST['btnCaculate'])) 
{
    $cmdStartDestination=$_POST['cmdStartDestination'];
    $cmdFinalDestination=$_POST['cmdFinalDestination'];
    $sbt = [];
    $fbt = [];

		$BusStop_query="SELECT * FROM BusStop";
		$BusStop_ret=mysqli_query($connection,$BusStop_query);
		$BusStop_count=mysqli_num_rows($BusStop_ret);

		$BR_query="SELECT * FROM BR";
		$BR_ret=mysqli_query($connection,$BR_query);
		$BR_count=mysqli_num_rows($BR_ret);



		for($i=0;$i<$BusStop_count;$i++) 
		{ 
			$row=mysqli_fetch_array($BusStop_ret);
			$BusStopID=$row['BusStopID'];

			if ($BusStopID == $cmdStartDestination) 
			{
				for ($i=0; $i <$BR_count ; $i++) 
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

		}
		if ($sbt)
		{
			echo "<script>window.alert('SUCCESS : BR Created')</script>";
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Route Entry</title>
</head>
<body>
<form action="array.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Route Information :</legend>

<table>
<tr>
	<td>StartDestination</td>
	<td>
		<select name="cmdStartDestination" id="" required>
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
	</td>
</tr>
<tr>
	<td>FinalDestination</td>
	<td>
		<select name="cmdFinalDestination" id="" required>
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
	</td>
</tr>
<tr>
	<td>Route</td>
	<td>
		<textarea id="" name="txtRoute" rows="4" cols="50" readonly>
		</textarea>
	</td>
</tr>
<tr>
	<td>RouteUrl</td>
	<td>
		<input type="text" name="txtRouteUrl" placeholder="Url" required />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="btnCaculate" value="Caculate" />
		<input type="submit" name="btnSave" value="Save" />
		<input type="reset" name="btnClear" value="Clear" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>