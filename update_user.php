<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:user_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
   $update_name->execute([$name, $user_id]);
   
   // $empty_pass = '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2';
   $select_old_pass = $conn->prepare("SELECT password from `users` where id = ?");
   $select_old_pass->execute([$user_id]);

   $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];

   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $prev_pass){
      $message[] = 'please enter old password !';
   }
   elseif ($old_pass == $new_pass){
      $message[] = 'password already used !';
   }
   elseif ($new_pass != $confirm_pass) {
      $message[] = 'confirm password does not match !';
   }
   else{
      if ($new_pass != $prev_pass){
         $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass->execute([$confirm_pass, $user_id]);

         $message[] = 'password updated succesfully!';
      }
      else{
         $message[] = 'please enter new password';
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
   <title>Update User</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>

<?php include 'components/user_header.php' ?>

<!-- -------------user update starts----------- -->

<section class="form-container">

   <form action="" method="post">

      <h3>Update User</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
      <div class="form-input-wrapper">
         <i class="fa-regular fa-user form-icon"></i>
         <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name'];?>">
      </div>
      
      <div class="form-input-wrapper">
         <i class="fa-solid fa-lock form-icon"></i>
         <input type="password" name="old_pass" required placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="form-input-wrapper">
         <i class="fa-solid fa-lock form-icon"></i>
         <input type="password" name="new_pass" required placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <div class="form-input-wrapper">
         <i class="fa-solid fa-key form-icon"></i>
         <input type="password" name="confirm_pass" required placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      </div>
      
      <input type="submit" value="Update" class="btn" name="submit">
   </form>

</section>

<!-- ---------------------user update ends------------------->


<script src="js/main.js"></script>
</body>
</html>