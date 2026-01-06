<?php
$post = file_get_contents('php://input');
$decode_data = json_decode($post);
$user_id = $decode_data->id;
require("../connection.php");
$q_delete_user = "DELETE from users where id = '$user_id'";
$response = [];
if(mysqli_query($conn,$q_delete_user)){
    $response["status"] = 200;
    $response["data"] = "user is deleted";
    echo json_encode($response);
}else{
    $response["status"] = 500;
    $response["data"] = "user is not deleted";
    echo json_encode($response);
}
mysqli_close($conn);