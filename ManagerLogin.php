<?php 
include 'Connect.php';
$passwordGiven = "Manager666";

if (isset($_POST['btnLogin'])) 
{
	$passwordInsert = $_POST['txtpassword'];

	if ($passwordInsert == $passwordGiven) 
	{
		echo "<script>window.alert('Success : Manager Login Success')</script>";
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body class="h-100" style="background-color: rgba(194, 201, 157, 0.38);">
<nav class="navbar navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="#">
      <img src="Images/B.png" width="30" height="30" alt=""><img src="Images/M2.png" width="30" height="30" alt=""> Bus Management
    </a>
</nav>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
			<form action="ManagerLogin.php" method="post" style = "margin-top:10%; margin-bottom:10%;">

			<fieldset>
			<legend>Enter Manager Login Information :</legend>
			<div class="form-group">
				<label for="Password">Password</label>
				<input type="password" class="form-control" id="Password" name="txtpassword" maxlength="25" size="25" placeholder="XXXXXXXXXXXXXX" required/>
			</div>
			<button type="submit" class="btn btn-primary btn-customized" name="btnLogin">Login</button>
			<button type="reset" class="btn btn-primary btn-customized" name="btnClear">Clear</button>
			</fieldset>
			</form>
		</div>
	</div>
</div>
</form>
</body>
</html>