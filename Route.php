<?php 
include 'Connect.php';
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Route Entry</title>
</head>
<body>
<form action="Route.php" method="post" style = "margin-top:10%; margin-bottom:10%;" >

<fieldset>
<legend>Enter Route Information :</legend>

<table>
<tr>
	<td>StartDestination</td>
	<td>
		<select name="cmdStartDestination" id="" required>
			<option value=""></option>
			<option value=""></option>
		</select>
	</td>
</tr>
<tr>
	<td>FinalDestination</td>
	<td>
		<select name="cmdFinalDestination" id="" required>
			<option value=""></option>
			<option value=""></option>
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
		<input type="submit" name="btnSave" value="Save" />
		<input type="reset" name="btnClear" value="Clear" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>