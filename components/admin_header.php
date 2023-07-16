<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/admin_style.css">
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

  <section id="header">
    <div class="logo">
      <a href="#">ARTiO<span>[ADMIN]</span></a>
    </div>

    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="placed_orders.php">Orders</a></li>
        <li><a href="admin_accounts.php">Admins</a></li>
        <li><a href="user_accounts.php">Users</a></li>
        <li><a href="messages.php">Messages</a></li>         
      </ul>
    </div>

    <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="user-btn" class="fas fa-user"></div>
    </div>

    <div class="profile">
      <?php 
        $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
        $select_profile->execute([$admin_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
       ?>
       <p><?= $fetch_profile['name']?></p>
       <a href="update_profile.php" class="btn">Update Profile</a>
       <div class="flex-btn">
         <a href="admin_login.php" class="option-btn">Login</a>
         <a href="register_admin.php" class="option-btn">Register</a>
       </div>
       <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Logout from this session ?')">Logout</a>

    </div>

  </section>

<script src="../js/admin_script.js"></script>
</body>
</html>