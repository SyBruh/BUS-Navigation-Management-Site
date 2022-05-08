<?php
	include('Connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
</head>
<body>

<script>
	$(document).ready( function () {
		$('#tableid').DataTable();
	} );
</script>
    <form action="destinationlist.php" method='post'></form>
    <fieldset style = "margin-top:10%;">
<legend>Destination List :</legend>
<?php  
$Destination_List="SELECT * FROM destination";
$Destination_ret=mysqli_query($connection,$Destination_List);
$Destination_count=mysqli_num_rows($Destination_ret);

if ($Destination_count < 1) 
{
	echo "<p>No Destination Record Found.</p>";
}
else
{
?>
	<table id="tableid" class="display">
	<thead>
	<tr>
		<th>#</th>
		<th>Destination ID</th>
		<th>Destination</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	for($i=0;$i<$Destination_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Destination_ret);
		//print_r($rows);

		$DestinationID=$rows['DestinationID'];
		$Destination=$rows['Destination'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$DestinationID</td>";
		echo "<td>$Destination</td>";
		echo "<td>
			  <a href='carupdate.php?DestinationID=$DestinationID'>Update</a> 
			  <a href='cardelete.php?DestinationID=$DestinationID'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
<?php
}
?>
</fieldset>
</body>
</html>