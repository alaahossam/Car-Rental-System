<?php include 'redirectLoggedIn.php'; ?>
<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
$carid = $_GET['id'];
$ssn = $_SESSION['login_customer'];


?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rentix</title>
	<style>
		body {
			background-image: url("images/roads.jpg");
		}
	</style>
	<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/user.css">
	<link rel="stylesheet" href="assets/w3css/w3.css">
	<!--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> -->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand page-scroll" href="index.php">
					RENTIX </a>
			</div>

			<?php
			if (isset($_SESSION['login_customer'])) {
				$ssn = $_SESSION['login_customer'];
				$sql1 = "SELECT * FROM users WHERE ssn ='$ssn'";
				$result1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($result1);
				$fname = $row1["fname"];


			?>
				<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li>
							<a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $fname; ?></a>
						</li>
						<li> <a href="prereturncar.php">My Payments </a></li>
						<li> <a href="mybookings.php"> My Bookings</a></li>
						<li>
							<a href="Filter_process.php">Car Search</a>
						</li>
						<li>
							<a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
						</li>
					</ul>
				</div>
			<?php
			} ?>
		</div>
		<!-- /.container -->
	</nav>

	<br><br>
	<div id="wrapper">

		<!-- Header -->
		<br>
		<br>
		<br>
		<br>
	</div>
	<!-- Footer -->
	<footer id="footer">
		<div class="inner">
			<div class="container">
				<h3>Reservation</h3>
				<div class="card text-center" style="margin-top:10px;padding: 50px;background: transparent">
					<form enctype='multipart/form-data' class="form-inline" method="post" name="myForm" action="">
						<div class="form-group mx-sm-3 mb-2">
							<label for="pick_up_date">Pickup date</label>
							<input type="date" name="pick_up_date" class="form-control" id="pick_up_date" placeholder="Pickup date" required>
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<label for="return_date">Return date</label>
							<input type="date" name="return_date" class="form-control" id="return_date" placeholder="Return date" required>
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<label for="payment">Payment</label>
							<select type="option" name="payment" id="payment" required>
								<option value="">Pay now ?</option>
								<option value="T">Yes</option>
								<option value="F">No</option>
							</select>
						</div>
						<input type="submit" name="submit" class="btn btn-primary mb-2" value="Reserve" />
					</form>
				</div>
			</div>
		</div>
	</footer>


	<?php
	$result = mysqli_query($conn, "SELECT * FROM `car` WHERE car_plate_id = '$carid'");
	$car_status = mysqli_fetch_assoc($result);
	$office_id = $car_status['office_id'];
	if ($car_status['out_of_service'] == '1') {
		echo '<script>';
		echo 'alert("This car is Out of Service");';
		echo '</script>';
		echo '<script>';
		echo 'window.location = "Filter_process.php"';
		echo '</script>';
	} else {
		if (isset($_POST['submit'])) {
			$reservation_date = date('y-m-d');
			$pick_up_date = $_POST["pick_up_date"];
			$return_date = $_POST["return_date"];
			$payment = $_POST["payment"];
			if ($payment == 'T') {
				$paid_at = $reservation_date;
			} else {
				$paid_at = $pick_up_date;
			}
			//validate the date 
			if (strtotime($reservation_date) < strtotime($pick_up_date) && strtotime($reservation_date) < strtotime($return_date) && strtotime($pick_up_date) < strtotime($return_date)) {
				$result = mysqli_query($conn, "SELECT * FROM `reservation` WHERE car_plate_id = '$carid' AND ((pick_up_date BETWEEN '$pick_up_date' AND  '$return_date') OR (return_date BETWEEN '$pick_up_date' AND '$return_date')  OR ('$pick_up_date' BETWEEN pick_up_date AND return_date) OR ('$return_date' BETWEEN pick_up_date AND return_date))");
				$clash = mysqli_fetch_assoc($result);
				if ($clash) {
					echo '<script>';
					echo 'alert("There is a clash with another resirvation");';
					echo '</script>';
					echo '<script>';
					echo 'window.location = "reserve.php?id="<?php echo $car_id;?>" "';
					echo '</script>';
				} else {
					$query = "INSERT INTO `reservation` (reservation_date,pick_up_date,return_date,car_plate_id,ssn,office_id,payment,paid_at) VALUES('$reservation_date','$pick_up_date','$return_date','$carid', '$ssn','$office_id','$payment','$paid_at')";
					$result = mysqli_query($conn, $query);
					echo '<script>';
					echo 'alert("Reserved successfully");';
					echo '</script>';

					echo '<script>';
					echo 'window.location = "index.php"';
					echo '</script>';
				}
			} else {
				echo '<script>';
				echo 'alert("Invalid pickup date or return date !");';
				echo '</script>';
				echo '<script>';
				echo 'window.location = "reserve.php?id="<?php echo $car_id;?>" "';
				echo '</script>';
			}
		}
	}
	$conn->close();
	?>
</body>

</html>