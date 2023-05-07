<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, "3307");
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$_SESSION['conn'] = $conn;


session_start();
$plate_id = $_SESSION['edit_car'];

$result = mysqli_query($conn, "SELECT * FROM `car` WHERE car_plate_id = '$plate_id'");
$row = mysqli_fetch_assoc($result);

$price = $row['price'];
$color = $row['color'];
$power = $row['hourse_power'];
$isAutomatic = $row['automatic'];
$office_id = $row['office_id'];
$filename = $row['img'];
$out_of_service = $row['out_of_service'];
?>


<!DOCTYPE HTML>
<html>

<head>
	<title>RENTIX</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/main.css" />

	<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
	<link rel="stylesheet" href="assets/css/user.css">
	<link rel="stylesheet" href="assets/w3css/w3.css">
</head>

<body class="is-preload">
	<nav class="navbar navbar-custom" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand page-scroll" href="index.php">
					RENTIX </a>
			</div>
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="admin_dashboard.php">Home</a>
					</li>
					<li>
						<a href="cars_information.php">Cars Informationn</a>
					</li>
					<li class="nav-link">
						<a href="customers_info.php" class="nav-link">Customers Information</a>
					</li>
					<li>
						<a href="reservations_info.php" class="nav-link">Reservations</a>
					</li>
					<li class="nav-item"><a href="index.php" class="nav-link">Sign Out</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<br><br>
	<div id="wrapper">

		<!-- Header -->
		<br>
		<br>
	</div>


	<!-- Footer -->
	<footer id="footer">
		<div class="inner">
			<div class="container">
				<h2>Register</h2>
				<div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
					<form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
						<div class="form-group mx-sm-3 mb-2">
							<input type="text" name="color" class="form-control" id="color" placeholder="Color">
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<input type="number" onkeypress="return event.charCode >= 48" min="1" name="power" class="form-control" id="power" placeholder="Horse Power">
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<input type="number" onkeypress="return event.charCode >= 48" min="1" name="price" class="form-control" id="price" placeholder="Price">
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<select name="automatic" id="automatic">
								<option value="" disabled selected hidden>Automatic/Manual</option>
								<option value="1">Automatic</option>
								<option value="0">Manual</option>
							</select>
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<select name="out_of_service" id="out_of_service">
								<option value="" disabled selected hidden>Active/Out_of_Service</option>
								<option value="0">Active</option>
								<option value="1">Out_of_Service</option>
							</select>
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<select name="office_id" id="office_id">
								<option value="" disabled selected hidden>Location</option>
								<?php
								$result = mysqli_query($conn, "SELECT * FROM `office` order by location ");
								$office_idss = array();
								while ($row = mysqli_fetch_assoc($result)) {
									$office_idss[] = $row['office_id'];
								}
								foreach ($office_idss as $office_id) {
									$result = mysqli_query($conn, "SELECT * FROM `office` where office_id=$office_id");
									$row = mysqli_fetch_assoc($result);
									$office_ids = "Location: " . $row['location'] . "||office: " . $row['office_name'];
									echo "<option value=\"$office_id\">$office_ids</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<label for="img">Image: </label>
							<input type="file" accept="image/*" name="img" id="img">
						</div>
						<input type="submit" name="submit" class="btn btn-primary mb-2" value="Register" />
					</form>
				</div>
			</div>
		</div>
	</footer>

	</div>
	<?php

	if (isset($_POST['submit'])) {
		if ($_POST["price"] != "") {
			$price = $_POST['price'];
			$result = mysqli_query($conn, "UPDATE car SET price='$price' WHERE car_plate_id='$plate_id'");
		}
		if ($_POST["color"] != "") {
			$color = $_POST['color'];
			$result = mysqli_query($conn, "UPDATE car SET color='$color' WHERE car_plate_id='$plate_id'");
		}
		if ($_POST["power"] != "") {
			$power = $_POST['power'];
			$result = mysqli_query($conn, "UPDATE car SET hourse_power='$power' WHERE car_plate_id='$plate_id'");
		}
		if (isset($_POST["automatic"]) != "") {
			$isAutomatic = $_POST['automatic'];
			$result = mysqli_query($conn, "UPDATE car SET automatic='$isAutomatic' WHERE car_plate_id='$plate_id'");
		}
		if (isset($_POST["office_id"]) != "") {
			$office_id = $_POST['office_id'];
			$result = mysqli_query($conn, "UPDATE car SET office_id='$office_id' WHERE car_plate_id='$plate_id'");
		}
		if (isset($_POST["out_of_service"]) != "") {

			$result = mysqli_query($conn, "SELECT out_of_service_end_date FROM `car_status` WHERE car_plate_id = '$plate_id' AND out_of_service_end_date = '0000-00-00'");
			$row = mysqli_fetch_assoc($result);
			$out_of_service_end_date = $row["out_of_service_end_date"];

			if (($out_of_service != $_POST["out_of_service"]) && ($out_of_service == '1')) {
				if ($out_of_service_end_date = '0000-00-00') {
					$result = mysqli_query($conn, "UPDATE `car_status` SET out_of_service_end_date=(CURDATE()) WHERE car_plate_id = '$plate_id' And out_of_service_start_date<=(CURDATE())");
					$out_of_service = $_POST['out_of_service'];
					$result = mysqli_query($conn, "UPDATE car SET out_of_service='$out_of_service' WHERE car_plate_id='$plate_id'");
				}
			}else if (($out_of_service != $_POST["out_of_service"]) && ($out_of_service == '0')) {
					$result = mysqli_query($conn, " INSERT INTO `car_status`(car_plate_id,out_of_service_start_date) values('$plate_id',(CURDATE()))");
					$out_of_service = $_POST['out_of_service'];
					$result = mysqli_query($conn, "UPDATE car SET out_of_service='$out_of_service' WHERE car_plate_id='$plate_id'");
			}
		}
		echo '<script>';
		echo 'alert("Car Modified successfully");';
		echo '</script>';

		echo '<script>';
		echo 'window.location = "cars_information.php"';
		echo '</script>';
		exit();
	}
	$conn->close();
	?>
</body>

</html>