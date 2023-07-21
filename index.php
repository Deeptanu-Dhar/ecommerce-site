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

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <title>A R T i O</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>
</head>

<body>

  <a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>


<?php include 'components/user_header.php'?>
<?php include 'components/wishlist_cart.php'?>
<?php include 'components/script.php'?>


  <section id="hero">
    <div class="herocontent">
      <h1>Art Accessories</h1>
      <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      </h3>
      <a href="#product-categories">VIEW PRODUCTS</a>
    </div>

    <div >
      <img src="img/hero-img.png" type="img/png" class="heroimg">
    </div>
  </section>

  <div class="banner">
    <p>COLLECTIONS</p>
  </div>

  <section id="product-categories">
    <div class="category-containers">
      <div class="product-category brushes">
        <a href="category.php?category=Brush">
          <img src="img/product-brushes.png">
          <p>Brushes & Accessories</p>
        </a>
      </div>
      <div class="product-category crafts">
        <a href="category.php?category=crafts">
          <img src="img/product-stationery2.png">
          <p>Crafts</p>
        </a>
      </div>
      <div class="product-category papers">
        <a href="category.php?category=Papers & Pads">
          <img src="img/product-papers and boards.png">
          <p>Papers & Boards</p>
        </a>
      </div>
      <div class="product-category paints">
        <a href="category.php?category=Paints & Mediums">
          <img src="img/product-paints and colors.png">
          <p>Paints & Colors</p>
        </a>
      </div>
    </div>
    <div class="product-category stationery">
      <a href="category.php?category=Drawing & Illustration">
        <img src="img/product-stationery.png">
        <p>Stationery</p>
      </a>
    </div>
  </section>

  <div class="banner">
    <p>FEATURED PRODUCTS</p>
  </div>

  <section class="home-products">

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
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


  <section id="about-us">
    <div class="about-us-img">
      <img src="img/about-us-bg-1.png" type="img/png" alt="" >
    </div> 
    <div class="about-us-text">
      <h1>ABOUT US</h1>
      <p>At <span style="color: rgba(29, 196, 181, 1.0);">Artio</span>, we are passionate about providing you with a seamless and enjoyable online shopping experience. We aim to be your one-stop destination for all your art supplies needs. Here's what you need to know about us.......</p>
      <a href="about.php">Read More</a>
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