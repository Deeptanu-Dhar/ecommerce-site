<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE from `admins` where id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
   $message[]='Account removed !';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>

<?php include '../components/admin_header.php' ?>
<?php include '../components/script_admin_account.php' ?>

<div class="admins-heading">
      <h1>ADMINS</h1>
   </div>

   <?php 
      if($records->rowCount()>0){
    ?>

<section id="produts-table" style="display: flex; align-items: center; justify-content: center;">
   <table class="table-content" width="90%" style="text-align: center;">  

      <thead>  

         <tr>  

            <th>ID</th>           

            <th>Name</th>

            <th>Update</th>

            <th>Delete</th>  

         </tr>  

      </thead>

      <tbody>

         <?php       
            while($row=$records->fetch(PDO::FETCH_ASSOC)){
            ?>

            <tr>

               <td><h4><?php echo $row['id']; ?></h4></td>
               <td><h5><?php echo $row['name']; ?></h5></td>
               <?php 

               if($row['id'] == $admin_id){

                ?>
               <td><a href="update_profile.php?update=<?php echo $row["id"]; ?>"class="btn">Update</a></td>

               <?php 
                  }else{
                ?>
                <td><span style="font-style: italic; color: grey;">action not allowed</span></td>
                <?php 
                  }
                 ?>
               <td><a href="admin_accounts.php?delete=<?php echo $row["id"]; ?>" onclick="return confirm('Delete this account ?');" class="delete-btn">Delete</a></td>

            </tr>

            <?php

         };

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
   echo '<div class="empty-text"><p class="empty">No accounts available !</p></div>';
}   
 ?>

<script src="../js/admin_script.js"></script>
</body>
</html>