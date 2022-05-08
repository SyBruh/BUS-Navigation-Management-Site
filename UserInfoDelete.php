<?php  
include('connect.php');


$UserID=$_GET['UserID'];

$Delete="DELETE FROM users WHERE UserID='$UserID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : User Info Deleted')</script>";
	echo "<script>window.location='UserInfoList.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in User Delete Process" . mysqli_error($connection) . "</p>";
}

?>