<?php
require('connection.php');

if (isset($_POST)) {
	$from_user_id = $_POST['from_user_id'];
	$to_user_id = $_POST['to_user_id'];
	$message = $_POST['message'];
}

$sql = "INSERT INTO chat ( from_user_id, to_user_id, message, time) 
VALUES ('$from_user_id', '$to_user_id', '$message', UTC_TIMESTAMP())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['sent' => 'yes']);
} else {
    echo json_encode(['sent' => 'no']);
}

$conn->close();
?>