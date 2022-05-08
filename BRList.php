<?php
	include('Connect.php');
    if(isset($_POST['btnSearch'])) 
    {
        $rdoSearchType=$_POST['rdoSearchType'];

        if ($rdoSearchType == 1) 
        {
            $cmdbusno=$_POST['cmdbusno'];
            $BR_List="SELECT * FROM br
                    WHERE BusTypeID=$cmdbusno";
            $BR_ret=mysqli_query($connection,$BR_List);
            print_r($BR_ret);
            print("1");
        }
        elseif ($rdoSearchType == 2) 
        {
            $cmdbusstop=$_POST['cmdbusstop'];
            $BR_List="SELECT * FROM br
                    WHERE BusStopID=$cmdbusstop";
            $BR_ret=mysqli_query($connection,$BR_List);
            print_r($BR_ret);
            print("2");
        }
    }
    elseif (isset($_POST['btnShowAll']))
    {
        $BR_List="SELECT * FROM br";
        $BR_ret=mysqli_query($connection,$BR_List);
        print_r($BR_ret);
        print("3");
    }
    else
    {
        $BR_List="SELECT * FROM br";
        $BR_ret=mysqli_query($connection,$BR_List);
        print_r($BR_ret);
        print("4");
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
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>

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
<form action="BRlist.php" method='post'>
<fieldset style = "margin-top:10%;">
<form>
  <div class="form-group">
    <input type="radio" name="rdoSearchType" value="1"  />Search by BusNo <br/>
    <select class="form-control" id="BusNoSearch" name="cmdbusno">
    <option>Choose BusNo</option>
			<?php  
			$BusNo_query="SELECT * FROM bustype";
			$BusNo_ret=mysqli_query($connection,$BusNo_query);
			$BusNo_count=mysqli_num_rows($BusNo_ret);

			for($i=0;$i<$BusNo_count;$i++) 
			{ 
				$row=mysqli_fetch_array($BusNo_ret);
				$BusTypeID=$row['BusTypeID'];
				$BusNo=$row['BusNo'];

				echo "<option value='$BusTypeID'>$BusTypeID - $BusNo</option>";
			}
			?>
    </select>
  </div>
  <div class="form-group">
    <input type="radio" name="rdoSearchType" value="2"  />Search by BusStop <br/>
    <select class="form-control" id="BusStopSearch" name="cmdbusstop">
    <option>Choose BusStop</option>
			<?php  
			$BusStop_query="SELECT * FROM busstop";
			$BusStop_ret=mysqli_query($connection,$BusStop_query);
			$BusStop_count=mysqli_num_rows($BusStop_ret);

			for($i=0;$i<$BusStop_count;$i++) 
			{ 
				$row=mysqli_fetch_array($BusStop_ret);
				$BusStopID=$row['BusStopID'];
				$BusStop=$row['BusStop'];

				echo "<option value='$BusStopID'>$BusStopID - $BusStop</option>";
			}
			?>
    </select>
  </div>
    <input type="submit" role="button" class="btn btn-primary mb-2" name="btnSearch" value="Search" />
    <input type="submit" role="button" class="btn btn-primary mb-2" name="btnShowAll" value="ShowAll" />
    <input type="reset" role="button" class="btn btn-primary mb-2" name="btnClear" value="Clear" />

<h3>BR List</h3>
<?php  
    $BR_count=mysqli_num_rows($BR_ret);
if ($BR_count < 1) 
{
	echo "<p>No BR Record Found.</p>";
}
else
{
?>
	<table id="tableid" class="table table-bordered table-striped">
	<thead class="thead-dark">
	<tr>
		<th scope="col">#</th>
		<th scope="col">BRID</th>
		<th scope="col">BusStop</th>
        <th scope="col">BusType</th>
        <th scope="col">StopOrder</th>
        <th scope="col"></th>
	</tr>
	</thead>
	<tbody class="table">
	<?php 
	for($i=0;$i<$BR_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($BR_ret);
		//print_r($rows);

		$BRID=$rows['BRID'];
		$BusStopID=$rows['BusStopID'];
        $BusStop_query="SELECT bs.BusStop
                        FROM BusStop bs, br b
                        WHERE bs.BusStopID=b.BusStopID
                        AND bs.BusStopID=$BusStopID";
        $BusStop_ret=mysqli_query($connection,$BusStop_query);
        $BusStop_row = mysqli_fetch_array($BusStop_ret);
        $BusStop=$BusStop_row['BusStop'];
        $BusTypeID=$rows['BusTypeID'];
        $BusType_query="SELECT bt.BusNo
                        FROM bustype bt, br b
                        WHERE bt.BusTypeID=b.BusTypeID
                        AND b.BusTypeID=$BusTypeID";
        $BusType_ret=mysqli_query($connection,$BusType_query);
        $BusType_row = mysqli_fetch_array($BusType_ret);
        $BusType=$BusType_row['BusNo'];
        $StopOrder=$rows['StopOrder'];

		echo "<tr>";
		echo "<td>" . ($i + 1) ."</td>";
		echo "<td>$BRID</td>";
		echo "<td>$BusStop</td>";
        echo "<td>$BusType</td>";
        echo "<td>$StopOrder</td>";
		echo "<td>
			  <a role='button' class='btn btn-light' href='BRUpdate.php?BRID=$BRID'>Update</a> 
			  <a role='button' class='btn btn-dark' href='BRDelete.php?BRID=$BRID'>Delete</a>
			  </td>";
		echo "</tr>";
	}
	 ?>
	 </tbody>
	</table>
<?php
}
?>
</form>
</fieldset>
</form>
</body>
</html>
<?php
include 'Footing.php';
?>