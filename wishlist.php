<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:user_login.php');
}

if(isset($_GET['remove'])){

   $remove_id = $_GET['remove'];


   $remove_from_wishlist = $conn->prepare("DELETE FROM wishlist WHERE id = ?");
   $remove_from_wishlist->execute([$remove_id]);

   if($remove_from_wishlist->execute([$remove_id])){
      
      header('location:wishlist.php');
      $message[] = "Product removed !";
   }

   
}
if(isset($_GET['removeall'])){

   $remove_all_from_wishlist = $conn->prepare("DELETE FROM `artsite_db`.`wishlist` where user_id = ?");
   $remove_all_from_wishlist->execute([$user_id]);

   if($remove_all_from_wishlist->execute()){
      
      header('location:wishlist.php');
      echo "All Products removed from wishlist!";
   }

   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wishlist</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<a href="#" class="to-top">
    <i class="fa-solid fa-angle-up"></i>
  </a>

<?php 

   if(isset($_GET['page-nr'])){
   $id = $_GET['page-nr'];
}
else{
   $id = 1;
}

 ?>

<body id="<?= $id ?>">

   <?php include 'components/user_header.php' ?>

   <?php include 'components/script_wishlist.php' ?>

   <div class="wishlist-heading">
    <h1>Your Wishlist</h1>
  </div>

  <?php
     $check_items = $conn->prepare("SELECT * FROM `wishlist`"); 
     $check_items->execute();
     if($check_items->rowCount() > 0){
      
   ?>

  <section class="wishlist-items">
   <table class="table-content" max-width="95%">  

      <thead>  

         <tr>  

            <th>Image</th>

            <th>Name</th>
           
            <th>Price</th>

            <th><a href="wishlist.php?removeall=0" class="delete-btn" onclick="return confirm('Remove all products from wishlist ?')">Remove all</a></th>  

         </tr>  

      </thead>

      <tbody>

         <?php

         $grand_total = 0;
         while ($fetch_wishlist = $check_items->fetch(PDO::FETCH_ASSOC)) {
                  $grand_total += $fetch_wishlist['price'];
               }      

         while($row = $result->fetch_assoc()){

            ?>
            
            <tr>
               <td><div class="img-box"><a href="quick_view.php?pid=<?= $row['pid']?>"><img src="<?= $row['image']; ?>" alt=""></a></div></td>
               <td><h5><?php echo $row['name']; ?></h5></td>
               
               <td><h4><span class="price-sign">₹</span><?php echo $row['price']; ?></h4></td>
               <td><a href="wishlist.php?remove=<?php echo $row["id"]; ?>" onclick="return confirm('Remove this product ?');"><i class="fa-regular fa-circle-xmark"></i></a></td>

            </tr>

            <?php
                  };
            ?>

            <tr>
               <th colspan="2">Grand Total</th>
               <th><span class="price-sign">₹</span><?= $grand_total ?></th>
            </tr>

      </tbody>

   </table>

</section>

<div class="wishlist-btn">
   <a href="shop.php" class="btn">Continue Shopping</a>
   <a href="wishlist.php?removeall=0" class="delete-btn" onclick="return confirm('Remove all products from wishlist ?')">Remove all</a>
</div>


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
   }
   else{
      echo '<div class="empty-text"><p class="empty">Your wishlist is empty !</p></div>';
   }
 ?>


<?php include 'components/user_footer.php' ?>

<script src="js/main.js" type="text/javascript"></script>
<script>
  let link = document.querySelectorAll("#page-no")
  let bodyIds = parseInt(document.body.id) - 1 ;
  link[bodyIds].classList.add("active");
</script>
</body>
</html>