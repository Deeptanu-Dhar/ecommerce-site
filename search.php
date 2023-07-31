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
<?php include 'components/wishlist_cart.php'?>



<div class="shop-products-heading" style="margin-top: 20px;">
    <h1>Search Products</h1>
  </div>

<section class="search-form">
    <form action="" method="POST">
      <input type="text" name="search" required placeholder="Search Items" maxlength="100" oninput="this.value = this.value.replace(/\s/g, '')">
      <button type="submit" class="fa-solid fas fa-search" name="submit_search"></button>
    </form>
</section>

  <section class="shop-products">

    <?php 

        if (isset($_POST['search']) or isset($_POST['submit_search'])) {
          $search=$_POST['search'];
          $search=filter_var($search, FILTER_SANITIZE_STRING); 
        $select_products=$conn->prepare("SELECT * FROM products where product_name like '%{$search}%'");
        $select_products->execute();
        if($select_products->rowCount()>0){
            while($row=$select_products->fetch(PDO::FETCH_ASSOC)){
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

        }
        }else{
            echo '<div class="empty-text"><p class="empty">No items found !</p></div>';
        }

        }
    ?>
</section>

<?php include 'components/user_newsletter.php' ?>

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