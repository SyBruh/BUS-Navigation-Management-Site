<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
    {
	$txtDestination=$_POST['txtDestination'];
	


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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Destination Entry</title>
</head>
<body>
<form action="Destination.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Destination Information :</legend>

<table>
<tr>
	<td>Destination</td>
	<td>
		<input type="text" name="txtDestination" placeholder="Place" required />
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