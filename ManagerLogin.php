<?php 
include 'Connect.php';
$passwordGiven = "Manager666";

if (isset($_POST['btnLogin'])) 
{
	$passwordInsert = $_POST['txtpassword'];

	if ($passwordInsert == $passwordGiven) 
	{
		echo "<script>window.alert('Success : Customer Login Success')</script>";
		echo "<script>window.location='ManagerHome.php'</script>";
	}
	else
	{
		echo "<script>window.alert('Fail : Incorrect Password')</script>";
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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