<?php
include 'Connect.php';

$Select="SELECT * FROM Bus";
$retSelect=mysqli_query($connection,$Select);
$Select_Count=mysqli_num_rows($retSelect);
if ($Select_Count>0) 
		{
			echo "success";
		}
        else {
            echo "fail";
        }

?>
