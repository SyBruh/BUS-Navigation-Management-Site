<?php
include 'Connect.php';

//creating a query
$stmt = $connection->prepare("SELECT BusStopID, BusStop FROM busstop;");
 
//executing the query 
$stmt->execute();

//binding results to the query 
$stmt->bind_result($BusStopID, $BusStop);

$routes = array(); 

//traversing through all the result 
while($stmt->fetch()){
$temp = array();
$temp['BusStopID'] = $BusStopID; 
$temp['BusStop'] = $BusStop; 
array_push($routes, $temp);
}

//displaying the result in json format 
echo json_encode($routes);


?>