<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

  <!-- <a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a> -->

  <section id="header">
    <div class="logo">
      <a href="index.php">ARTiO</a>
    </div>

    <div>
      <ul id="navbar">
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>         
      </ul>
    </div>

    <div class="icons">

      <?php

            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>

      <a href="wishlist.php"><i class="fas fa-heart"></i><span>[<?= $total_wishlist_counts;?>]</span></a>

      <a href="cart.php"><i class="fas fa-cart-shopping"></i><span class="icon-title">CART</span><span>[<?= $total_cart_counts; ?>]</span></a>

      <div id="user-btn" class="fas fa-user"><span class="icon-title">ACCOUNT</span></div>
    </div>

    <div class="profile">
      <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="register_user.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      


    </div>
  </section>

</body>
</html>