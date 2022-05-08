<?php  
include('connect.php');


$BusTypeID=$_GET['BusTypeID'];
$Exist = "SELECT b.BRID 
			FROM bustype bt, busstop bs, br b 
			WHERE bt.BusTypeID = b.BusTypeID
			AND b.BusStopID = bs.BusStopID
			AND bt.BusTypeID = '$BusTypeID'";
$rets = mysqli_query($connection,$Exist);
$Exist_count=mysqli_num_rows($rets);
if ($Exist_count > 0) {
	echo "<script>window.alert('Delete Access Denied : Delete the assigned stops firsts')</script>";
	echo "<script>window.location='BusTypeList.php'</script>";
}
else {
	$Delete="DELETE FROM BusType WHERE BusTypeID='$BusTypeID' ";
	$ret=mysqli_query($connection,$Delete);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : BusTYpe Info Deleted')</script>";
		echo "<script>window.location='BusTypeList.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in BusType Delete Process" . mysqli_error($connection) . "</p>";
	}
}


?>