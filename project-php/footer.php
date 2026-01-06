  <!-- start footer -->
  <footer data-bs-theme="dark">
    <div class="container-fluid">
      <div class="container position-relative">
        <img src="assets/img/add.png" class="position-absolute end-0" id="el-add-4">
        <img src="assets/img/circle.png" class="position-absolute start-0" id="el-circle-3">
        <div class="text-light row justify-content-between align-items-center flex-nowrap" id="main-footer">
          <h1 class="col-lg-9 text-end">
            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
          </h1>
          <div class="col-lg-3">
            <a href="#" class="btn btn-custom py-2 px-3 float-start">تماس با ما</a>
          </div>
        </div>
      </div>
    </div>
    <div id="bottom-footer" class="navbar bg-body-transparent" data-bs-theme="dark">
      <div class="container">
        <div class="row flex-lg-nowrap">
        <a class="navbar-brand col-lg-2 me-0" href="#">
          <img src="assets/img/logo.svg">
        </a>
        <ul class="navbar-nav col-lg-5 mb-2 mb-lg-0 flex-lg-row justify-content-evenly align-items-center">
          <li class="nav-item mx-2">
            <a class="nav-link opacity-75" href="#">خدمات</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link opacity-75" href="#">پروژه های ما</a>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link opacity-75" href="#">درباره ما</a>
          </li>
        </ul>
        <p class="opacity-75 text-light col-lg-5 text-start mb-0 d-lg-flex align-items-lg-center justify-content-lg-center">
          لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
        </p>
      </div>
      </div>
    </div>
  </footer>

  <!-- menu in mobile -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="MyMenu" data-bs-theme="dark" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <h5 class="offcanvas-title" id="offcanvasLabel">منو</h5>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">خانه</a>
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
      <a class="btn btn-outline-light">ارتباط با ما</a>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content text-light">
        <div class="modal-header justify-content-between">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn fs-5 text-light" data-bs-dismiss="modal">
            <i class="fa-solid fa-close"></i>
          </button>
        </div>
        <div class="modal-body">
          <p></p>
          <div>
            <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal" id="btn-ok">آره</button>
            <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">نه</button>
          </div>
        </div> 
      </div>
    </div>
  </div>
  <!-- toast -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body">
  
      </div>
    </div>
  </div>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jalali-moment.browser.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>