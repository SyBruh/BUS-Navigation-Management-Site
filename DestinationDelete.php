<?php  
include('connect.php');



$DestinationID=$_GET['DestinationID'];

$ExistTest = "SELECT Destination FROM destination WHERE DestinationID='$DestinationID'";
$retexist = mysqli_query($connection,$ExistTest);
$rows=mysqli_fetch_array($retexist);
$Destination=$rows['Destination'];
$Exist = "SELECT b.BRID 
			FROM bustype bt, busstop bs, br b 
			WHERE bt.BusTypeID = b.BusTypeID
			AND b.BusStopID = bs.BusStopID
			AND bs.BusStopID = '$DestinationID'";
$rets = mysqli_query($connection,$Exist);
$Exist_count=mysqli_num_rows($rets);
if ($Exist_count > 0) {
	echo "<script>window.alert('Delete Access Denied : Destination used in other Bus Routes')</script>";
	echo "<script>window.location='DestinationList(New).php'</script>";
}
else {
	$Delete1="DELETE FROM StartDestination WHERE DestinationID='$DestinationID'";
	$ret1=mysqli_query($connection,$Delete1);

	$Delete2="DELETE FROM FinalDestination WHERE DestinationID='$DestinationID'";
	$ret2=mysqli_query($connection,$Delete2);

	$Delete="DELETE FROM Destination WHERE DestinationID='$DestinationID' ";
	$ret=mysqli_query($connection,$Delete);
	
	$Delete4="DELETE FROM BusStop WHERE BusStopID='$DestinationID'";
	$ret4=mysqli_query($connection,$Delete4);
	

	if($ret and $ret1 and $ret2 and $ret4) //True
	{
		echo "<script>window.alert('SUCCESS : Destination Info Deleted')</script>";
		echo "<script>window.location='DestinationList(New).php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Staff Delete Process" . mysqli_error($connection) . "</p>";
	}
}

?>