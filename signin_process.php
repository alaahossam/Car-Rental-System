<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "email or Password is invalid";
}
else
{
// Define $username and $password
$customer_username=$_POST['email'];
$customer_password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require 'connection.php';
$conn = Connect();

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT email, password FROM users WHERE email=? AND password=? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $customer_username, $customer_password);
$stmt -> execute();
$stmt -> bind_result($customer_username, $customer_password);
$stmt -> store_result();

if ($stmt->fetch())  //fetching the contents of the row
{
	$sql1 = "SELECT ssn FROM users WHERE email ='$customer_username'";
	$result1 = mysqli_query($conn, $sql1);
	$row1 = mysqli_fetch_assoc($result1);
	$ssn = $row1["ssn"];
	$_SESSION['login_customer']=$ssn; // Initializing Session
	header("location: index.php"); // Redirecting To Other Page
} else {
echo '<script>';
echo 'alert("Username or Password is invalid");';
echo '</script>';

echo '<script>';
echo 'window.location = "signin.php"';
echo '</script>';
}
mysqli_close($conn); // Closing Connection
}
}
?>