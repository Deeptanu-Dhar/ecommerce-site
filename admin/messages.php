<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE from `messages` where id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
   $message[]='Message Dismissed !';

}

if(isset($_GET['delete_all'])){
   $delete_messages = $conn->prepare("DELETE FROM `artsite_db`.`messages`");
   $delete_messages->execute();
   header('location:messages.php');
   $message[]='All Messages Dismissed !';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>

   <?php include '../components/admin_header.php' ?>
   <?php include '../components/script_messages.php' ?>

   <div class="messages-heading">
      <h1>MESSAGES</h1>
   </div>


   <?php 
   if($records->rowCount()>0){
    ?>

    <section style="margin: 1em;display: flex; justify-content: center;">
      <a href="messages.php?delete_all" class="delete-btn" onclick="return confirm('Dismiss all messages ?')" style="width: 60%;">Dismiss all</a>
   </section>

   <section class="messages">
   <table class="messages-table">
      <thead>
         <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Dismiss</th>
         </tr>
      </thead>
      <tbody>
         <?php 
    while($row=$records->fetch(PDO::FETCH_ASSOC)){
     ?>
         <tr>
            <td><?= $row['user_id']?></td>
            <td><?= $row['name']?></td>
            <td><?= $row['email']?></td>
            <td><?= $row['subject']?></td>
            <td><?= $row['message']?></td>
            <td><a href="messages.php?delete=<?= $row['id']?>" class="delete-btn" onclick="return confirm('Dismiss message ?')">Dismiss</a></td>
         </tr>
         <?php 
      }
   ?>
      </tbody>
   </table>
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

         <a href="?page-nr=<?php echo $counter ?>" id="page-no"><?php echo $counter ?></a>

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

<?php 

}else{
   echo '<div class="empty-text"><p class="empty">No Messages yet !</p></div>';
}   
?>

<script src="../js/admin_script.js"></script>
</body>
</html>