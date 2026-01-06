<?php include("header.php");
require("connection.php");
$user_id = $_SESSION["idUser"];
if($_SESSION["role"] == "admin"){
    $q_select_userData = "SELECT * from users";
}else{
    $q_select_userData = "SELECT * from users where id = '$user_id'";
}
$res = mysqli_query($conn,$q_select_userData);    
?>
    <img src="assets/img/Rectangle-1.png" class="position-absolute top-0 end-0 z-n1 vh-100" id="shadow-1">
    <img src="assets/img/Rectangle-2.png" class="position-absolute top-0 start-0 z-n1 vh-100" id="shadow-2">
  </div>
<div class="container min-vh-100">
  <div class="row my-5">
      <div class="col-lg-8 mx-auto p-4 rounded-3 table-responsive" id="profile-table">
      <table class="table table-sm table-striped">
          <thead>
            <tr>
              <th>عکس پروفایل</th>
              <th>#</th>
              <th>نام کاربری</th>
              <th>ایمیل</th>
              <th>شماره موبایل</th>
              <th>تاریخ ثبت</th>
              <th>نقش</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php while($item = mysqli_fetch_assoc($res)) : ?>  
            <tr>
              <td><img src="<?= $item["profile_img"] ?>" class="img-profile rounded-circle"></td>
              <td><?= $item["id"] ?></td>
              <td><?= $item["username"] ?></td>
              <td><?= $item["email"] ?></td>
              <td><?= $item["phoneNumber"] ?></td>
              <td class="reg-date"><?= $item["reg_date"] ?></td>
              <td><?= $item["role"] ?></td>
              <td>
                <div class="btn-group d-flex flex-row-reverse">
                    <?php if($_SESSION["role"] == 'admin' && $item["role"] != 'admin') : ?>
                      <button class="btn btn-danger" id='user-<?= $item["id"] ?>'
                      data-bs-toggle="modal" data-bs-target="#exampleModal"
                      onclick='modalDelete(<?= $item["id"] ?> ,event)'
                      >remove</button>
                    <?php endif; ?>
                    <a href='edit-user.php?id=<?= $item["id"] ?>' class="btn btn-warning">edit</a>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
      </table>
      </div>
  </div>
</div>


<?php include("footer.php"); ?>