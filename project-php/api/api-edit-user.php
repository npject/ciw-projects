<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_user = validation($_POST["id"]);
    $username = validation($_POST["username"]);
    $email = validation($_POST["email"]);
    $phoneNumber = validation($_POST["phoneNumber"]);
    $response = [];
    if(empty($username)){
        //header("Location: edit-user.php?id=$id_user&err=usernameEmpty");
    }
    if(!empty($_FILES['profile_image']['size'])){       
        $dir = '../uploads/';
        $target_file = $dir . basename($_FILES['profile_image']['name']);
        $dest_file = 'uploads/' . basename($_FILES['profile_image']['name']);
        $is_upload = true;
        $type_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check_img =getimagesize($_FILES['profile_image']['tmp_name']);
        if(!$check_img){
            //header("Location: edit-user.php?id=$id_user&err=is not image");
            $response["status"]= 500;
            $response["data"]= 'is not image';
            echo json_encode($response);
            die;
            $is_upload = false;
        }
        if(file_exists($target_file)){
            //header("Location: edit-user.php?id=$id_user&err=file is exist");
            $response["status"]= 500;
            $response["data"]= 'file is exist';
            echo json_encode($response);
            die;
            $is_upload = false;
        }
        if($_FILES['profile_image']['size'] > 500000){
            //header("Location: edit-user.php?id=$id_user&err=file is large");
            $response["status"]= 500;
            $response["data"]= 'file is large';
            echo json_encode($response);
            die;
            $is_upload = false;
        }
        if($type_file != "jpg" &&
        $type_file != "jpeg" &&
        $type_file != "svg" &&
        $type_file != "png"){
            //header("Location: edit-user.php?id=$id_user&err=format file must be jpg,jpeg,svg,png");
            $response["status"]= 500;
            $response["data"]= 'format file must be jpg,jpeg,svg,png';
            echo json_encode($response);
            die;
            $is_upload = false;
        }
        //check flag
        if(!$is_upload){
            //header("Location: edit-user.php?id=$id_user&err=upload is problem");
            $response["status"]= 500;
            $response["data"]= 'upload is problem';
            echo json_encode($response);
            die;
        }else{
            if(move_uploaded_file($_FILES['profile_image']['tmp_name'],$target_file)){
               $move_img = true;
            }else{
               //err move_uploaded_file
                //header("Location: edit-user.php?id=$id_user&err=server is problem to upload");
                $response["status"]= 500;
                $response["data"]= 'server is problem to upload';
                echo json_encode($response);
                die; 
            }
        }
    }   // به else نیاز نداره....
    require("../connection.php");
    $q_select_user = "SELECT * FROM users where username = '$username'";
    $q_select_idUser = "SELECT * FROM users where id = $id_user";
    $res = mysqli_query($conn,$q_select_user);
    $res_idUser = mysqli_query($conn,$q_select_idUser);
    $res_data_idUser = mysqli_fetch_assoc($res_idUser);
    if(isset($move_img) && $move_img == true){      //مسیر عکس آپدیت بشه یا نه....
        $q_update_user = "UPDATE `users` SET `username`='$username',`email`='$email',
        `phoneNumber`='$phoneNumber',`profile_img`='$dest_file',`role`='user' 
        WHERE `id`=$id_user";
    }else{
        $q_update_user = "UPDATE `users` SET `username`='$username',`email`='$email',
        `phoneNumber`='$phoneNumber',`role`='user' 
        WHERE `id`=$id_user";
    }
    if(mysqli_num_rows($res) > 0){  //اگر نام کاربری از قبل وجود داشت مربوط به خودش یا نه...
        if($res_data_idUser["username"] == $username){    //ویرایش اطلاعات بدون تغییر نام کاربری
            if(mysqli_query($conn,$q_update_user)){
                //header("Location: edit-user.php?id=$id_user&msg=edit user is completed");
                $response["status"]= 200;
                $response["data"]= 'user is updated';
                echo json_encode($response);
                die;
            }else{
                //header("Location: edit-user.php?id=$id_user&err=server err");
                $response["status"]= 500;
                $response["data"]= 'server err';
                echo json_encode($response);
                die;
            }
        }else{      //نام کاربری از قبل وجود داره
            //header("Location: edit-user.php?id=$id_user&err=user is exist");
            $response["status"]= 500;
            $response["data"]= 'username is exist';
            echo json_encode($response);
            die;
        }
    }else{  //end if mysqli_num_rows($res)      //ویرایش اطلاعات با تغییر نام کاربری
        if(mysqli_query($conn,$q_update_user)){
            //header("Location: edit-user.php?id=$id_user&msg=edit user is completed");
            $response["status"]= 200;
            $response["data"]= 'user is updated';
            echo json_encode($response);
            die;
        }else{
            //header("Location: edit-user.php?id=$id_user&err=server err");
            $response["status"]= 500;
            $response["data"]= 'server err';
            echo json_encode($response);
            die;
        }
    }
}    


mysqli_close($conn);
function validation($val){
    $val = trim($val);
    $val = htmlspecialchars($val);
    $val = stripslashes($val);
    return $val;
}
