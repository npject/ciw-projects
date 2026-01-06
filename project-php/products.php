<?php include("header.php"); 
    require("connection.php");
    $limit_perpage = 12;
    if(isset($_GET["p"])){
        $page = $_GET["p"];
    }else{
        $page = 1;
    }
    $offset = ($page - 1) * $limit_perpage ;
    $q_total = "SELECT COUNT(*) FROM products";
    $total = mysqli_query($conn, $q_total);
    $total_rows = mysqli_fetch_array($total)[0];
    $total_page = ceil($total_rows / $limit_perpage);
    $q_select_products = "SELECT * FROM products ORDER BY id DESC LIMIT $limit_perpage OFFSET $offset";
    $res = mysqli_query($conn, $q_select_products);

   // $filename = "data.json";
  // //Read the JSON file in php
  // $data = file_get_contents($filename);
  // $array = json_decode($data, true);
  // if($array === null){
  //   die("invalid JSON file or content");
  // }
  // foreach ($array as $row) {
  //   $title = mysqli_real_escape_string($conn,$row["title"]);
  //   $price = mysqli_real_escape_string($conn,$row["price"]);
  //   $description = mysqli_real_escape_string($conn,$row["description"]);
  //   $category = mysqli_real_escape_string($conn,$row["category"]);
  //   $image = mysqli_real_escape_string($conn,stripslashes($row["image"]));
  //   $query = "INSERT INTO `products`(`title`, `price`, `description`, `category`, `image`) 
  //   VALUES ('$title','$price','$description','$category','$image')";
  //   if(mysqli_query($conn,$query)){
  //     echo "insert data";
  //   }else{
  //     echo "err";
  //   }
  // };
  // mysqli_close($conn);
?>
    <img src="assets/img/Rectangle-1.png" class="position-absolute top-0 end-0 z-n1 vh-100" id="shadow-1">
    <img src="assets/img/Rectangle-2.png" class="position-absolute top-0 start-0 z-n1 vh-100" id="shadow-2">
  </div>
<div class="container">
  <div class="row">
    <?php while($item = mysqli_fetch_assoc($res)) : ?>
    <div class="col-lg-3 my-2">
      <div class="card">
        <a href="single.php?id=<?= $item["id"] ?>" target="_blank">
            <img src="<?= $item["image"] ?>" class="card-img-top object-fit-contain"></img>
        </a>
        <div class="card-body">
            <h5 class="card-title text-truncate"><?= $item["title"] ?></h5>
            <p class="card-text"><?= $item["category"] ?></p>        
            <p class="card-text"><?= $item["price"] ?></p>        
        </div>
      </div> 
    </div>
    <?php endwhile; ?>
  </div>

  <nav class="mt-5">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="products.php?p=<?= $page - 1 ?>">قبلی</a>
        </li>
        <?php for ($i=1; $i <= $total_page ; $i++) { 
            
         ?>
        <li class="page-item <?= $page == $i ? 'active' : '' ?>">
            <a class="page-link" href="products.php?p=<?= $i ?>">
             <?= $i ?>
            </a>
        </li>
        <?php } ?>
        <li class="page-item <?= $page == $total_page ? 'disabled' : '' ?>">
            <a class="page-link" href="products.php?p=<?= $page + 1 ?>">بعدی</a>
        </li>
    </ul>
  </nav>

</div>  


<?php include("footer.php"); ?>