<?php
$servername = "localhost";
$username_db = "root";
$pass_db = "";
$db_name = "first_project";
$conn = mysqli_connect($servername,$username_db,$pass_db,$db_name);
if(!$conn){
    die(mysqli_connect_error());
}