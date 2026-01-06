<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = validation($_POST["username"]);
    $pass = validation($_POST["pass"]);
    $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
    $email = validation($_POST["email"]);
    $phoneNumber = validation($_POST["phoneNumber"]);
    if(empty($username)){
        header("Location: register.php?err=usernameEmpty");
    }
    //array(1) { ["profile_image"]=> array(6) { ["name"]=> string(0) "" 
    //                                          ["full_path"]=> string(0) "" 
    //                                          ["type"]=> string(0) "" 
    //                                          ["tmp_name"]=> string(0) "" 
    //                                          ["error"]=> int(4) 
    //                                          ["size"]=> int(0) } }
    // $_FILES['profile_image'] همیشه وجود داره حتی اگه هیچ عکسی انتخاب نکنیم
    if(!empty($_FILES['profile_image']['size'])){
        $dir = 'uploads/';
        $target_file = $dir . basename($_FILES['profile_image']['name']);
        $is_upload = true;
        $type_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check_img =getimagesize($_FILES['profile_image']['tmp_name']);
        if(!$check_img){
            header("Location: register.php?err=is not image");
            $is_upload = false;
        }
        if(file_exists($target_file)){
            header("Location: register.php?err=file is exist");
            $is_upload = false;
        }
        if($_FILES['profile_image']['size'] > 500000){
            header("Location: register.php?err=file is large");
            $is_upload = false;
        }
        if($type_file != "jpg" &&
        $type_file != "jpeg" &&
        $type_file != "svg" &&
        $type_file != "png"){
            header("Location: register.php?err=format file must be jpg,jpeg,svg,png");
            $is_upload = false;
        }
        //check flag
        if(!$is_upload){
            header("Location: register.php?err=upload is problem");
        }else{
            if(move_uploaded_file($_FILES['profile_image']['tmp_name'],$target_file)){
                require("connection.php");
                $q_select_user = "SELECT * FROM users where username = '$username'";
                $res = mysqli_query($conn,$q_select_user);
                if(mysqli_num_rows($res) > 0){
                    header("Location: register.php?err=user is exist");
                }else{
                    $q_insert_user = "INSERT INTO `users`(`username`, `password`, `email`, `phoneNumber`, `profile_img`, `role`) 
                    VALUES ('$username','$pass_hash','$email','$phoneNumber','$target_file','user')";
                    if(mysqli_query($conn,$q_insert_user)){
                        header("Location: register.php?msg=register is completed");
                    }else{
                        header("Location: register.php?err=server err");
                    }
                }
            }else{
                //err move_uploaded_file
                header("Location: register.php?err=server is problem to upload");
            }  
        }
    }else{
        header("Location: register.php?err=profile image is Empty");
    }
}
mysqli_close($conn);
function validation($val){
    $val = trim($val);
    $val = htmlspecialchars($val);
    $val = stripslashes($val);
    return $val;
}
