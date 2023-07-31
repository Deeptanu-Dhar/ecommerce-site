<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}
else{
  $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  $pid = $_GET['pid'];
  $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ? "); 
  $select_products->execute([$pid]);
  if($select_products->rowCount() > 0){
    while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
     ?>
     <title><?= $fetch_product['product_name']; ?></title>
   <?php }
 };
 ?>
 <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
 <link rel="stylesheet" href="css/style.css">
 <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>
</head>

<body>

  <a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>


  <?php include 'components/user_header.php'?>
  <?php include 'components/wishlist_cart.php'?>


  <section class="product-view-section">

    <?php
    $pid = $_GET['pid'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ? "); 
    $select_products->execute([$pid]);
    if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="product-view-container">
        <input type="hidden" name="pid" value="<?= $fetch_product['product_id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_product['product_price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_product['product_image']; ?>">
        <div class="product-image-wrapper">
          <a href="<?= $fetch_product['product_image']; ?>" target="_blank"><img src="<?= $fetch_product['product_image']; ?>" alt="" id="productImg"></a>
          <div class=".magnifier"></div>
        </div>

        <div class="content">

          <div class="name">
            <h1><?= $fetch_product['product_name']; ?></h1>
          </div>
          <div class="details-heading">
            <h2>Description</h2>
          </div>
          <div class="details"> 
            <?= $fetch_product['product_description']; ?>
          </div>
          <div class="flex">
           <div class="price"><span class="price-sign">₹</span><?= $fetch_product['product_price']; ?><span>/-</span></div>
           <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
         </div>
         <div class="flex-btn">
          <input type="submit" value="add to wishlist" class="btn wishlist" name="add_to_wishlist">
          <input type="submit" value="add to cart" class="btn" name="add_to_cart">
        </div>
      </div>

      
    </form>
    <?php
  }
}else{
  echo '<p class="empty">no products added yet!</p>';
}
?>

</section>

<div class="banner">
  <p>FEATURED PRODUCTS</p>
</div>

<section class="home-products">

 <div class="swiper products-slider">

   <div class="swiper-wrapper">

     <?php
     $select_products = $conn->prepare("SELECT * FROM `products` order by rand() LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
        <input type="hidden" name="pid" value="<?= $fetch_product['product_id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_product['product_price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_product['product_image']; ?>">
        <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
        <a href="quick_view.php?pid=<?= $fetch_product['product_id']; ?>">
          <img src="<?= $fetch_product['product_image']; ?>" alt=""></a>
          <div class="name"><?= $fetch_product['product_name']; ?></div>
          <div class="flex">
           <div class="price"><span class="price-sign">₹</span><?= $fetch_product['product_price']; ?><span>/-</span></div>
           <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
         </div>
         <input type="submit" value="add to cart" class="btn" name="add_to_cart">
       </form>
       <?php
     }
   }else{
    echo '<p class="empty">no products added yet!</p>';
  }
  ?>

</div>

<div class="swiper-pagination"></div>

</div>
</section>

<div class="banner">
  <p>NEWSLETTER</p>
</div>
<section id="newsletter">
  <div class="news-content">
    <div class="news-text">
      <h1>Subscribe to our <br>newsletter</h1>
      <p>Stay Updated about the latest products</p>
    </div>
    <form id="news-form" class="news-form" action="" method="">
      <input type="email" id="email" name="email" placeholder="email" required><br>
      <input type="submit" value="Subscribe">
    </form>
  </div>
</section>

<?php include 'components/user_footer.php'?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/main.js"></script>

<script>

  var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
});

  var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
  breakpoints: {
    0: {
     slidesPerView: 2,
   },
   650: {
    slidesPerView: 3,
  },
  768: {
    slidesPerView: 4,
  },
  1024: {
    slidesPerView: 5,
  },
},
});

  var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
  breakpoints: {
    550: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

</script>

</body>
</html>