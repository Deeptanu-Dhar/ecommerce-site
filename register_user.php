<?php

include 'components/connect.php';

session_start(); 

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $email = ($_POST['email']);
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
   $select_user->execute([$name]);

   if($select_user->rowCount() > 0){
      $message[]='username already exists !';
   }else{
      if($pass != $cpass){
         $message[]= 'Confirm password does not match !';
      }
      else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, password, email) VALUES(?,?,?)");
         $insert_user->execute([$name, $cpass, $email]);
         header('location:user_login.php');
         $message[]= 'New User registered !';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include 'components/user_header.php' ?>

   <!-- ------------user register start------------- -->

<section class="form-container">

   <form action="" method="post">

      <h3>Register new</h3>
      <div class="form-input-wrapper">
         <i class="fa-regular fa-user form-icon"></i>
         <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>

      <div class="form-input-wrapper">
         <i class="fa-regular fa-envelope form-icon"></i>
         <input type="email" name="email" required placeholder="enter your email" maxlength="30"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>

      <div class="form-input-wrapper">
         <i class="fa-solid fa-lock form-icon"></i>
         <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="form-input-wrapper">
         <i class="fa-solid fa-key form-icon"></i>
         <input type="password" name="cpass" required placeholder="confirm password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      
      
      <input type="submit" value="Register" class="btn" name="submit">
   </form>

</section>

   <!-- ------------user register end------------- -->

<script src="js/main.js"></script>
</body>
</html>