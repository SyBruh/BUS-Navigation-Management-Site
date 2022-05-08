<?php
	include('Connect.php');
    if(isset($_POST['btnSearch'])) 
    {
        $cboSearchType=[];
        if(!empty($_POST['cboSearchType']))
        {
            // Loop to store and display values of individual checked checkbox.
            foreach($_POST['cboSearchType'] as $selected)
            {
            $cboSearchType[]=$selected;
            }
        }
        $cmdStartDestination=$_POST['cmdStartDestination'];
        $cmdFinalDestination=$_POST['cmdFinalDestination'];

        if ($cboSearchType[0] == 1 AND $cboSearchType[1] == 2) 
        {
            $Route_List="SELECT * FROM froute
                    WHERE StartDestination='$cmdStartDestination'
                    AND FinalDestination='$cmdFinalDestination'";
            $Route_ret=mysqli_query($connection,$Route_List);
            print_r($Route_ret);
            print("1");
        }
        elseif ($cboSearchType[0] == 1) 
        {
            $Route_List="SELECT * FROM froute
                    WHERE StartDestination='$cmdStartDestination'";
            $Route_ret=mysqli_query($connection,$Route_List);
            print_r($Route_ret);
            print("2");
        }
        elseif ($cboSearchType[0] == 2) 
        {
            $Route_List="SELECT * FROM froute
                    WHERE FinalDestination='$cmdFinalDestination'";
            $Route_ret=mysqli_query($connection,$Route_List);
            print_r($Route_ret);
            print("3");
        }
    }
    elseif (isset($_POST['btnShowAll']))
    {
        $Route_List="SELECT * FROM froute";
        $Route_ret=mysqli_query($connection,$Route_List);
        print_r($Route_ret);
        print("4");
    }
    else
    {
        $Route_List="SELECT * FROM froute";
        $Route_ret=mysqli_query($connection,$Route_List);
        print_r($Route_ret);
        print("5");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
      <img src="Images/B.png" width="30" height="30" alt=""><img src="Images/M2.png" width="30" height="30" alt=""> Bus Management
    </a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="ManagerHome.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DataLists
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="DestinationList(New).php">Destination Lists/BusStop Lists</a>
            <a class="dropdown-item" href="BusTypeList.php">BusType/BusRoute Lists</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="BusList.php">Bus Lists</a>
            <a class="dropdown-item" href="BRList.php">BusStop assign Lists</a>
            <a class="dropdown-item" href="RouteList.php">Route Lists</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="UserInfoList.php">Users Information</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="ManagerLogin.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
<form action="RouteList.php" method='post'>
<fieldset style = "margin-top:10%;">
<div class="form-group">
    <input type="checkbox" name="cboSearchType[]" value="1"  />Search by BusNo <br/>
    <select class="form-control" id="StartDestinationSearch" name="cmdStartDestination">
    <option>Choose StartDestination</option>
			<?php  
			$Start_query="SELECT * FROM startdestination";
            $Start_ret=mysqli_query($connection,$Start_query);
            $Start_count=mysqli_num_rows($Start_ret);

            for($i=0;$i<$Start_count;$i++) 
            { 
                $row=mysqli_fetch_array($Start_ret);
                $StartDestinationID=$row['StartDestinationID'];
                $StartDestination=$row['StartDestination'];

                echo "<option value='$StartDestination'>$StartDestinationID - $StartDestination</option>";
            }
			?>
    </select>
  </div>
  <div class="form-group">
    <input type="checkbox" name="cboSearchType[]" value="2"  />Search by BusStop <br/>
    <select class="form-control" id="FinalDestinationSearch" name="cmdFinalDestination">
    <option>Choose FinalDestination</option>
			<?php  
			$Final_query="SELECT * FROM finaldestination";
            $Final_ret=mysqli_query($connection,$Final_query);
            $Final_count=mysqli_num_rows($Final_ret);

            for($i=0;$i<$Final_count;$i++) 
            { 
                $row=mysqli_fetch_array($Final_ret);
                $FinalDestinationID=$row['FinalDestinationID'];
                $FinalDestination=$row['FinalDestination'];

                echo "<option value='$FinalDestination'>$FinalDestinationID - $FinalDestination</option>";
            }
			?>
    </select>
  </div>
    <input type="submit" role="button" class="btn btn-primary mb-2" name="btnSearch" value="Search" />
    <input type="submit" role="button" class="btn btn-primary mb-2" name="btnShowAll" value="ShowAll" />
    <input type="reset" role="button" class="btn btn-primary mb-2" name="btnClear" value="Clear" />

<h3>Final Route List</h3>
<?php  

$Route_count=mysqli_num_rows($Route_ret);

if ($Route_count < 1) 
{
	echo "<p>No Route Record Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-bordered table-striped">
	<thead class="thead-dark">
	<tr>
		<th scope="col">#</th>
		<th scope="col">Route ID</th>
		<th scope="col">StartDestination</th>
        <th scope="col">FinalDestination</th>
        <th scope="col">Route</th>
        <th scope="col"></th>
        <th scope="col"></th>
	</tr>
	</thead>
	<tbody class="table">
	<?php 
	for($i=0;$i<$Route_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Route_ret);
		//print_r($rows);

		$RouteID=$rows['FRouteID'];
		$StartDestination=$rows['StartDestination'];
        $FinalDestination=$rows['FinalDestination'];
        $Route=$rows['FRoute'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$RouteID</td>";
		echo "<td>$StartDestination</td>";
        echo "<td>$FinalDestination</td>";
        echo "<td>$Route</td>";
		echo "<td>
			  <a role='button' class='btn btn-light' href='RouteUpdate.php?RouteID=$RouteID'>Update</a> 
			  <a role='button' class='btn btn-dark' href='RouteDelete.php?RouteID=$RouteID'>Delete</a>
			  </td>";
        echo "<td>
			  <a role='button' class='btn btn-primary' href='RouteDetail.php?RouteID=$RouteID'>Detail</a> 
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
</form>
</body>
</html>
<?php
include 'Footing.php';
?>