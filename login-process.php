<?php
session_start();
require('connection.php');

if (isset($_POST)) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
}

$sql = "SELECT id, name FROM user WHERE username = '$username' && password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$_SESSION["username"] = $username;
    	$_SESSION["name"] = $row['name'];
    	$_SESSION["user_id"] = $row['id'];
        echo "<script>location.replace('/mounty')</script>";
    }
} else {
    echo "<script>location.replace('/mounty/login?login=error')</script>";
}
$conn->close();
?>
