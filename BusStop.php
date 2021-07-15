<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
    {
	$txtBusStop=$_POST['txtDestination'];
	


		$Insert="INSERT INTO `busstop`
				(`BusStop`) 
				VALUES 
				('$txtBusStop')
				";
		$ret=mysqli_query($connection,$Insert);

		if($ret) //True
		{
			echo "<script>window.alert('SUCCESS :New Customer Created')</script>";
			echo "<script>window.location='Destination.php'</script>";
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
	<title>BusStop Entry</title>
</head>
<body>
<form action="BusStop.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter BusStop Information :</legend>

<table>
<tr>
	<td>BusStop</td>
	<td>
		<input type="text" name="txtBusStop" placeholder="Place" required />
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