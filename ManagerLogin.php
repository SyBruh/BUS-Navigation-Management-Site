<?php 
include 'Connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Login</title>
</head>
<body>

<form action="ManagerLogin.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

<fieldset>
<legend>Enter Manager Login Information :</legend>

<table>
<tr>
	<td>Password </td>
	<td>
		<input type="password" name="txtpassword" placeholder="XXXXXXXXXXXXXX" required />
	</td>
</tr>
<tr>
	<td></td>
	<td>
	<i class="fas fa-sign-in-alt" style = "color:blue;font-size:30px;"></i>
		<input type="submit" name="btnLogin" value="Login" />
		<input type="reset" name="btnClear" value="Clear" />
	</td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>