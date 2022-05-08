<?php
include 'Connect.php';

//creating a query
$stmt = $connection->prepare("SELECT BusTypeID, BusNo FROM bustype;");
 
//executing the query 
$stmt->execute();

//binding results to the query 
$stmt->bind_result($BusTypeID, $BusNo);

$routes = array(); 

//traversing through all the result 
while($stmt->fetch()){
$temp = array();
$temp['BusTypeID'] = $BusTypeID; 
$temp['BusNo'] = $BusNo; 
array_push($routes, $temp);
}

//displaying the result in json format 
echo json_encode($routes);


?>