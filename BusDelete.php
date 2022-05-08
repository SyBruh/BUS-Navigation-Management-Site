<?php  
include('connect.php');


$BusID=$_GET['BusID'];

$Delete="DELETE FROM Bus WHERE BusID='$BusID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Bus Info Deleted')</script>";
	echo "<script>window.location='BusList.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Bus Delete Process" . mysqli_error($connection) . "</p>";
}

?>