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
  <title>Shop Now</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>
</head>

<?php 

   if(isset($_GET['page-nr'])){
   $id = $_GET['page-nr'];
}
else{
   $id = 1;
}

 ?>

<body id="<?= $id ?>">

  <a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>


<?php include 'components/user_header.php'?>
<?php include 'components/script.php'?>
 <!-- include 'components/wishlist_cart.php' -->

  <section class="shop-products">

  <div class="shop-products-heading">
    <h1>SHOP PRODUCTS</h1>
  </div>

   <?php
     while($row = $result->fetch_assoc()){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?php echo $row['product_id']; ?>">
      <input type="hidden" name="name" value="<?php echo $row['product_name']; ?>">
      <input type="hidden" name="price" value="<?php echo $row['product_price']; ?>">
      <input type="hidden" name="image" value="<?php echo $row['product_image']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?php echo $row['product_id']; ?>">
      <img src="<?php echo $row ['product_image']; ?>" alt=""></a>
      <div class="name"><?php echo $row['product_name']; ?></div>
      <div class="flex">
         <div class="price"><span class="price-sign">₹</span><?php echo $row['product_price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      };
   ?>
</section>

<div class="page-info">

      <?php 

      if(!isset($_GET['page-nr'])){
         $page = 1;
      }
      else{
         $page=$_GET['page-nr'];
      }

      ?>

      showing <span><?php echo $page?></span> of <span><?php echo $pages ?></span>
   </div>

   <div class="pagination">

      <a href="?page-nr=1"><i class="fa-solid fa-angles-left"></i></a>

      <?php 

      if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
         ?>

         <a href="?page-nr=<?php  echo $_GET['page-nr'] -1 ?>"><i class="fa-solid fa-angle-left"></i></a>

         <?php
      }
      else{
         ?> 

         <a><i class="fa-solid fa-angle-left"></i></a>

         <?php
      }

      ?>

      <div class="page-numbers">

         <?php 

         for ($counter=1; $counter <= $pages ; $counter++) { 
            ?>

            <a href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>

            <?php
         }

         ?>
      </div>

      <?php 

      if(!isset($_GET['page-nr'])){
         ?>

         <a href="?page-nr=2"><i class="fa-solid fa-angle-right"></i></a>

         <?php
      }
      else{
       if($_GET['page-nr'] >= $pages){
        ?> 

        <a><i class="fa-solid fa-angle-right"></i></a>

        <?php
     }
     else{

      ?>

      <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>

      <?php

   }
}

?>

<a href="?page-nr=<?php echo $pages ?>"><i class="fa-solid fa-angles-right"></i></a>



</div>

<?php include 'components/user_newsletter.php'?>

 <?php include 'components/user_footer.php'?>

 <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/main.js"></script>
<script>
  let links = document.querySelectorAll('.page-numbers > a');
  let bodyId = parseInt(document.body.id) - 1 ;
  links[bodyId].classList.add("active");
</script>

</body>
</html>