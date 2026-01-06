<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = validation($_POST["username"]);
    $pass = validation($_POST["pass"]);
    require("connection.php");
    $q_select_user = "SELECT * FROM users where username = '$username'";
    $res = mysqli_query($conn,$q_select_user);
    if(mysqli_num_rows($res) > 0){
        $data_user = mysqli_fetch_assoc($res);
        if(password_verify($pass,$data_user["password"])){
            $_SESSION["username"] = $data_user["username"];
            $_SESSION["role"] = $data_user["role"];
            $_SESSION["idUser"] = $data_user["id"];
            header("Location: index.php");
        }else{
            header("Location: login.php?err=password is incorrect");
        }
    }else{
        header("Location: login.php?err=user is not exist");
    }
}
mysqli_close($conn);
function validation($val){
    $val = trim($val);
    $val = htmlspecialchars($val);
    $val = stripslashes($val);
    return $val;
}