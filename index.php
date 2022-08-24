<?php
	// Connection
	require_once'connection.php';

	// Add
	if(isset($_POST['add']))
	{
		// Posted Values  
		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$age=$_POST['age'];
		$school=$_POST['school'];
		// Call the store procedure for insertion
		$sql=mysqli_query($con,"call sp_insert('$fname','$lname','$age','$school')");
		if($sql)
		{
			// Message for successfull insertion
			echo "<script>alert('Record inserted successfully');</script>";
			echo "<script>window.location.href='index.php'</script>"; 
		}
		else
		{
			// Message for unsuccessfull insertion
			echo "<script>alert('Something went wrong. Please try again');</script>";
			echo "<script>window.location.href='index.php'</script>"; 
		}
	}

	// Update
	if(isset($_POST['update']))
	{
		// Get the row id
		$rid=intval($_GET['id']);
		// Posted Values  
		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$age=$_POST['age'];
		$school=$_POST['school'];

		// Store  Procedure for Updation
		$sql=mysqli_query($con,"call sp_update('$fname','$lname','$age','$school','$rid')");
		// Mesage after updation
		echo "<script>alert('Record Updated successfully');</script>";
		// Code for redirection
		echo "<script>window.location.href='index.php'</script>"; 
	}

	// Delete
	if(isset($_REQUEST['del']))
	{
		$rid=intval($_GET['del']);
		$sql =mysqli_query($con,"call sp_delete('$rid')");

		echo "<script>alert('Record deleted');</script>";
		echo "<script>window.location.href='index.php'</script>"; 
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
		<!-- favicon -->
		<link rel="icon" type="image/png" sizes="192x192"  href="favicons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
		<link rel="manifest" href="favicons/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="{{ asset('images/favicons/ms-icon-144x144.png') }}">
		<meta name="theme-color" content="#ffffff">
		<title>Case Study 2 - PEO</title>
	</head>
	<body>
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-1 px-1 position-fixed bg-primary" id="sticky-sidebar">
	            <div class="nav flex-column flex-nowrap vh-100 overflow-auto p-2">
	                <a href="#form" class="nav-link text-white">Form</a>
	                <a href="#table" class="nav-link text-white">Table</a>
	                <a href="#graph" class="nav-link text-white">Graph</a>
	                <a href="#about" class="nav-link text-white">About</a>
	            </div>
	        </div>
	        <div class="col-11 offset-1">
	        	<div id="form">
					<h2 class="text-center">Case Study 2</h2>
					<div>
						<form name="add" method="POST">
							<div class="form-group">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" placeholder="First Name" name="firstname">
							</div>
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" placeholder="Last Name" name="lastname">
							</div>
							<div class="form-group">
								<label for="age">Age</label>
								<input type="number" class="form-control" placeholder="Age" name="age">
							</div>
							<div class="form-group">
								<label for="School">School</label>
								<select class="form-control" name="school">
									<option value="XU">XU</option>
									<option value="LDCU">LDCU</option>
									<option value="LC">LC</option>
									<option value="MUST">MUST</option>
									<option value="COC">COC</option>
									<option value="CU">CU</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary" name="add" value="Submit">Submit</button>
						</form>
					</div>
				</div>
				<hr>
				<div id="table">
					<h2 class="text-center">Table</h2>
					<table id="dTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
						<thead>
							<tr>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Age</th>
							<th scope="col">School</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$sql =mysqli_query($con, "call sp_read()");
								$cnt=1;
								$row=mysqli_num_rows($sql);

								if($row>0){
									while ($result=mysqli_fetch_array($sql)) {           
							?>
							<tr>
							    <td><?php echo htmlentities($cnt);?></td>
							    <td><?php echo htmlentities($result['FirstName']);?></td>
							    <td><?php echo htmlentities($result['LastName']);?></td>
							    <td><?php echo htmlentities($result['Age']);?></td>
							    <td><?php echo htmlentities($result['School']);?></td>
							 
							    <td><a href="update.php?id=<?php echo htmlentities($result['id']);?>"><button class="btn btn-primary btn-xs"><i class="fa-solid fa-pen-to-square"></i></button></a></td>
							 
							    <td><a href="?del=<?php echo htmlentities($result['id']);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa-solid fa-trash-can"></i></button></a></td>
						    </tr>
						    <?php 
								// for serial number increment
										$cnt++;
									}
								} else {
							?>
							<tr>
							    <td colspan="9" style="font-weight:bold;text-align:center;"> No Record found</td>
							</tr>
							<?php } ?>    
						</tbody>
					</table>
				</div>
				<hr>
	        	<div id="graph">
					<h2 class="text-center">Graph</h2>
					<img src="graph.png">
				</div>
				<hr>
	        	<div id="about">
					<h2 class="text-center">About</h2>
					<p class="text-center">PGMO-PEO</p>
					<ul class="list-group">
						<li class="list-group-item text-center"><a href="https://www.facebook.com/raiddto/"><i class="fa-brands fa-facebook"></i> Ryan Abcede</a></li>
						<li class="list-group-item text-center"><a href="https://www.facebook.com/errljury"><i class="fa-brands fa-facebook"></i> Earl Tejolan</a></li>
					</ul>
				</div>
	        </div>
	    </div>
	</div>
    <button onclick="topFunction()" id="btn-up" title="Go to top" class="bg-primary"><i class="fa-solid fa-arrow-up"></i></button>

	<script type="text/javascript" src="script.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>