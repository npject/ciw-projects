<?php include("header.php");
    if(isset($_GET["err"])){
        $err = $_GET["err"];
    }
    if(isset($_GET["msg"])){
        $msg = $_GET["msg"];
    }
?>
    <img src="assets/img/Rectangle-1.png" class="position-absolute top-0 end-0 z-n1 vh-100" id="shadow-1">
    <img src="assets/img/Rectangle-2.png" class="position-absolute top-0 start-0 z-n1 vh-100" id="shadow-2">
  </div>
<div class="container">
  <div class="row my-5">
    <div class="col-lg-6 mx-auto p-4 rounded-3" id="login-form">
      <h3 class="text-light mb-2">login :</h3>
      <?php if(isset($err)): ?>
          <div class="alert alert-danger">
              <?php echo($err); ?>
          </div>
      <?php endif; ?>
      <?php if(isset($msg)): ?>
          <div class="alert alert-success">
              <?php echo($msg); ?>
          </div>
      <?php endif; ?>
      <form action="<?php echo htmlspecialchars("log.php"); ?>" method="POST"
       onsubmit="return validLogin()" class="p-3 rounded-3">
        <div class="col-12 form-floating mb-2">
            <input class="form-control text-end" type="text" name="username" placeholder=" " id="username-login">
            <label class="form-label" for="username">نام کاربری :</label>
        </div>
        <div class="col-12 form-floating mb-2">
            <input class="form-control text-end" type="password" name="pass" placeholder=" " id="password-login">
            <label class="form-label" for="password">رمز عبور :</label>
            <div id="feedback-pass"></div>
        </div>
        <div class="col-12 mb-2">
            <input class="btn btn-custom text-light px-3" type="submit" value="ارسال">
        </div>
      </form>
    </div>
  </div>
</div>


<?php include("footer.php"); ?>