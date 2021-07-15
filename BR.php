<?php 
include 'Connect.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>BR Entry</title>
</head>
<body>
<form action="BR.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter BusRoute Information :</legend>

<table>
<tr>
	<td>BusStop</td>
	<td>
		<select name="cmdBuaStop" id="" required>
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
	</td>
</tr>
<tr>
	<td>BusNo</td>
	<td>
		<select name="cmdBusNo" id="" required>
			<option value=""></option>
			<option value=""></option>
		</select>
	</td>
</tr>
<tr>
	<td>Stop_Order</td>
	<td>
		<input type="number" name="txtStopOrder" placeholder="No." required />
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
