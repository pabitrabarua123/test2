<?php
session_start();
require('connection.php');

if (isset($_POST)) {

session_unset(); 

session_destroy(); 

echo "<script>location.replace('/mounty/login?action=LogoutSuccess')</script>";
}

$conn->close();
?>