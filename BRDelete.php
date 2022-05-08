<?php  
include('connect.php');


$BRID=$_GET['BRID'];
$Exist = "SELECT i.IRID 
			FROM br b, interroute i, froute fr
			WHERE fr.FRouteID = i.FRouteID
			AND b.BRID = i.BRID
			AND b.BRID = '$BRID'";
$retexist = mysqli_query($connection,$Exist);
$Exist_count=mysqli_num_rows($retexist);
if ($Exist_count > 0) {
	echo "<script>window.alert('Delete Access Denied : BR used in Routes')</script>";
	echo "<script>window.location='BRList.php'</script>";
}
else {
	$Delete="DELETE FROM BR WHERE BRID='$BRID' ";
	$ret=mysqli_query($connection,$Delete);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : BR Info Deleted')</script>";
		echo "<script>window.location='BRList.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in BR Delete Process" . mysqli_error($connection) . "</p>";
	}
}


?>