<?php include("header.php");
require("connection.php");
$id_user = $_GET["id"];
$q_select_userData = "SELECT * from users where id = '$id_user'";
$res = mysqli_query($conn,$q_select_userData);    
$res_data_user = mysqli_fetch_assoc($res);
?>
    <img src="assets/img/Rectangle-1.png" class="position-absolute top-0 end-0 z-n1 vh-100" id="shadow-1">
    <img src="assets/img/Rectangle-2.png" class="position-absolute top-0 start-0 z-n1 vh-100" id="shadow-2">
  </div>
<div class="container">
  <div class="row my-5">
    <div class="col-lg-6 mx-auto p-4 rounded-3" id="edit-form">
      <h3 class="text-light mb-2">edit :</h3>
        <div class="col-12 form-floating mb-2">
          <input class="form-control text-end" type="text" value='<?= $res_data_user["username"] ?>'
          name="username" placeholder=" " id="username" onkeyup="validd(this)">
          <label class="form-label" for="username">نام کاربری :</label>
        </div>
        <div class="col-12 form-floating mb-2">
          <input class="form-control text-end" type="email" value='<?= $res_data_user["email"] ?>'
          name="email" placeholder=" " id="email"  onkeyup="validd(this)">
          <label class="form-label" for="email">ایمیل :</label>
        </div>
        <div class="col-12 form-floating mb-2">
          <input class="form-control text-end" type="text" value='<?= $res_data_user["phoneNumber"] ?>'
          name="phoneNumber" placeholder=" " id="phone-number"  onkeyup="validd(this)">
          <label class="form-label" for="phone-number">شماره موبایل :</label>
        </div>
        <div class="col-12 mb-2 d-flex flex-column align-items-start">
            <img src='<?= $res_data_user["profile_img"] ?>' id="img-prev" class="img-profile rounded-circle my-2">
            <input class="form-control text-end d-none" type="file" onchange="prevImg()"
            name="profile_image" id="profile-image">
            <label class="btn btn-outline-light" for="profile-image">عکس پروفایل</label>
        </div>
        <div class="col-12 mb-2">
          <button class="btn btn-custom text-light px-3" onclick='updateUser(<?= $res_data_user["id"] ?>)'>ثبت</button>
          <a href="profile.php" class="btn btn-secondary text-light px-3">انصراف</a>
        </div>
    </div>
  </div>
</div>


<?php include("footer.php"); ?>