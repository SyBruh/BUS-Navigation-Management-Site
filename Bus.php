<?php 
include 'Connect.php';

if(isset($_POST['btnSave'])) 
{
    $txtDriver=$_POST['txtDriver'];
    $cmdBusNo=$_POST['cmdBusNo'];

		$Insert="INSERT INTO `bus`
				(`DriverName`,`BusTypeID`)
				VALUES 
				('$txtDriver','$cmdBusNo')
				";
		$ret=mysqli_query($connection,$Insert);

		if($ret) //True
		{
			echo "<script>window.alert('SUCCESS : BR Created')</script>";
			echo "<script>window.location='BR.php'</script>";
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
	<title>Bus Entry</title>
</head>
<body>
<form action="Bus.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Bus Information :</legend>

<table>
<tr>
	<td>Driver</td>
	<td>
		<input type="text" name="txtDriver" placeholder="name" required />
	</td>
</tr>
<tr>
	<td>BusNo</td>
	<td>
		<select name="cmdBusNo" id="" required>
			<option>Choose BusNo</option>
			<?php  
			$BusNo_query="SELECT * FROM BusTye";
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