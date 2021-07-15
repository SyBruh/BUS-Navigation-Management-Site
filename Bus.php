<?php 
include 'Connect.php';
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
		<input type="number" name="txtBusNo" placeholder="No." required />
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