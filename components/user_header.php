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

   <?php include 'wishlist_cart.php' ?>

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
        <li><a href="orders.php">Orders</a></li>         
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

      <div id="user-btn" class="fas fa-user"><span class="icon-title"><?php if(isset($_SESSION['user_id'])){echo "ACCOUNT";}else{echo "LOGIN";} ?></span></div>
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
            <a href="register_user.php" class="option-btn">register</a>
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

