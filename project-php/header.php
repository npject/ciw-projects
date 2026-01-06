<?php session_start(); 
$title_page = pathinfo(basename($_SERVER['PHP_SELF']),PATHINFO_FILENAME);
$arr_title = [
  'index' => 'خانه',
  'register' => 'ثبت نام',
  'login' => 'ورود به حساب کاربری',
  'profile' => 'پروفایل',
  'edit-user' => 'ویرایش اطلاعات کاربر',
  'products' => 'محصولات'
];
$title = $arr_title[$title_page] ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid position-relative mb-5">
    <!-- start Nav -->
    <nav class="navbar navbar-expand-lg bg-body-transparent" data-bs-theme="dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="assets/img/logo.svg">
        </a>
        <button class="navbar-toggler order-first" type="button" data-bs-toggle="offcanvas" data-bs-target="#MyMenu"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">
              <i class='fa-solid fa-house mx-1 fs-5'></i>
              خانه
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="#">خدمات</a>
            </li>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="#">پروژه های ما</a>
            </li>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="#">درباره ما</a>
            </li>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="products.php">products</a>
            </li>
            <?php if(!isset($_SESSION["username"])) : ?>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="register.php">register</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link opacity-75" href="<?php echo isset($_SESSION["username"]) ? "profile.php" : "login.php" ?>">
                <?php echo isset($_SESSION["username"]) ? "hi " . $_SESSION["username"] . "<i class='fa-solid fa-mug-hot mx-2 fs-5'></i>" : "login" ?>
              </a>
            </li>
            <?php if(isset($_SESSION["username"])) : ?>
            <li class="nav-item">
              <a class="nav-link opacity-75 text-bg-danger rounded-3 logout"
              data-bs-toggle="modal" data-bs-target="#exampleModal"
              onclick="modalLogout()">logout</a>
              <!-- به href نیاز نداره -->
            </li>
            <?php endif; ?>
          </ul>
          <a class="btn btn-outline-light" href="#">ارتباط با ما</a>
        </div>


      </div>
    </nav>

