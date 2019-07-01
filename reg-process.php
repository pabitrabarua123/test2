<?php
session_start();
require('connection.php');

if (isset($_POST)) {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5($password);
	$phone = $_POST['phone'];
}

$sql = "SELECT id FROM user WHERE username = '$username' OR email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<script>location.replace('/mounty/register?userExist=true')</script>";
    }
}else{
	$sql = "INSERT INTO user ( username, email, password, name, phone) 
VALUES ('$username', '$email', '$password', '$name', '$phone')";

if ($conn->query($sql) === TRUE) {
    $_SESSION["username"] = $username;
    $_SESSION["name"] = $name;
    $_SESSION["user_id"] = $row['id'];
    echo "<script>location.replace('/mounty/login?firstLogin=true')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>