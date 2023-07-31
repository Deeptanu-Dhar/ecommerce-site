<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dasboards starts -->

<div class="dashboard-heading">
   <h1>DASHBOARD</h1>
</div>

<section class="dashboard">
   <div class="box">
      <h3>Welcome !</h3>
      <p><?= $fetch_profile['name']?></p>
      <a href="update_profile.php" class="btn">Update Profile</a>
   </div>

   <div class="box">
      <?php 

         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings+= $fetch_pendings['total_price'];
         }

       ?>
       <h3><span>₹</span><?= $total_pendings; ?><span>/-</span></h3>
       <p>Total pendings</p>
       <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php 

         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes+= $fetch_completes['total_price'];
         }

       ?>
       <h3><span>₹</span><?= $total_completes; ?><span>/-</span></h3>
       <p>Total completes</p>
       <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <div class="box">
      <?php 
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
       ?>
       <h3><?= $number_of_orders; ?></h3>
       <p>Total orders</p>
       <a href="placed_orders.php" class="btn">see orders</a>
   </div>

    <div class="box">
      <?php 
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
       ?>
       <h3><?= $number_of_products; ?></h3>
       <p>Products Added</p>
       <a href="products.php" class="btn">see products</a>
   </div>

   <div class="box">
      <?php 
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $number_of_users = $select_users->rowCount();
       ?>
       <h3><?= $number_of_users; ?></h3>
       <p>Users accounts</p>
       <a href="user_accounts.php" class="btn">See Accounts</a>
   </div>

   <div class="box">
      <?php 
         $select_admins = $conn->prepare("SELECT * FROM `admins`");
         $select_admins->execute();
         $number_of_admins = $select_admins->rowCount();
       ?>
       <h3><?= $number_of_admins; ?></h3>
       <p>Total Admins</p>
       <a href="admin_accounts.php" class="btn">See Admin Accounts</a>
   </div>

   <div class="box">
      <?php 
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $number_of_messages = $select_messages->rowCount();
       ?>
       <h3><?= $number_of_messages; ?></h3>
       <p>Messages</p>
       <a href="messages.php" class="btn">See Messages</a>
   </div>

</section>

<!-- admin dasboards ends -->


<script src="../js/admin_script.js"></script>
</body>
</html>