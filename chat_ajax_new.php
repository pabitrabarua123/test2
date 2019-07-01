<?php
    
require('connection.php');

if (isset($_POST)) {
  $from_user_id = $_POST['from_user_id'];
  $to_user_id = $_POST['to_user_id'];
}

$sql = "SELECT * FROM chat WHERE ( from_user_id = '$from_user_id' AND to_user_id = '$to_user_id') OR ( from_user_id = '$to_user_id' AND to_user_id = '$from_user_id')";
   
 $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    $data = array();
        while($row = $result->fetch_assoc()) { 
            array_push($data, $row);
        }
     echo json_encode([ 'res' => 'success', 'data' => $data ]);
 }else{
     echo json_encode([ 'res' => 'failure' ]); 
 }

?>

