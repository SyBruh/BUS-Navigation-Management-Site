<?php  
include('connect.php');


$FRouteID=$_GET['RouteID'];

$Delete1="DELETE FROM Interroute WHERE FRouteID='$FRouteID' ";
$ret1=mysqli_query($connection,$Delete1);

$Delete="DELETE FROM Froute WHERE FRouteID='$FRouteID' ";
$ret=mysqli_query($connection,$Delete);

if($ret and $ret1) //True
{
	echo "<script>window.alert('SUCCESS : Route Info Deleted')</script>";
	echo "<script>window.location='RouteList.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Route Delete Process" . mysqli_error($connection) . "</p>";
}

?>