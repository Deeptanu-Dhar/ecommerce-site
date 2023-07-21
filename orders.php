<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:user_login.php');
}

if(isset($_GET['cancel_order'])){
   $order_id=$_GET['cancel_order'];
  $select_orders=$conn->prepare("SELECT * FROM orders WHERE user_id = ?");
   $select_orders->execute([$user_id]);
   if($select_orders->rowCount()>0){

      $cancel_order=$conn->prepare("DELETE FROM orders WHERE user_id = ? && id = ?");
      $cancel_order->execute([$user_id,$order_id]);

      $message[]='Order cancelled';

   }
}

if(isset($_GET['cancel_all'])){

      $cancel_all_order = $conn->prepare("DELETE FROM `artsite_db`.`orders` where user_id = ?");
      $cancel_all_order->execute([$user_id]);

      $message[]='All Orders cancelled';

   }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Orders</title>

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

   

   <div class="orders-heading">
     <h1>Your Orders</h1>
  </div>

  


<section class="view-orders">
   
   <?php 
   $slno=0;
   $select_orders=$conn->prepare("SELECT * FROM orders WHERE user_id = ?");
   $select_orders->execute([$user_id]);
   if($select_orders->rowCount()>0){
      while($fetch_orders=$select_orders->fetch(PDO::FETCH_ASSOC)){
         $slno++;
   ?>

   <div class="order-container">
      <div class="order-sl-no">
         <h2><?= $slno ?></h2>
      </div>
      <table class="orders-table">
         <tr>
            <th>Name</th>
            <td><?= $fetch_orders['name'] ?></td>
         </tr>
         <tr>
            <th>Number</th>
            <td><?= $fetch_orders['number'] ?></td>
         </tr>
         <tr>
            <th>Email</th>
            <td><?= $fetch_orders['email'] ?></td>
         </tr>
         <tr>
            <th>Method</th>
            <td><?= $fetch_orders['method'] ?></td>
         </tr>
         <tr>
            <th>Address</th>
            <td><?= $fetch_orders['address'] ?></td>
         </tr>
         <tr>
            <th>Total Products</th>
            <td><?= $fetch_orders['total_products'] ?></td>
         </tr>
         <tr>
            <th>Total Price</th>
            <td><?= $fetch_orders['total_price'] ?></td>
         </tr>
         <tr>
            <th>Placed on</th>
            <td><?= $fetch_orders['placed_on'] ?></td>
         </tr>
         <tr>
            <th>Payment Status</th>
            <td><?= $fetch_orders['payment_status'] ?></td>
         </tr>
         <tr>
            <th>Cancel Order</th>
            <td><a href="?cancel_order=<?= $fetch_orders['id']?>"><i class="fa-regular fa-circle-xmark"></i></a></td>
         </tr>

      </table>
   </div>
   <div class="cancel-all">
   <a href="?cancel_all=0" class="delete-btn">Cancel all orders</a>
   </div>

   <?php
      }
   }else{
      echo '<div class="empty-text"><p class="empty">No orders placed !</p></div>
        <div class="cart-btn">
      <a href="index.php" class="btn">Browse Products</a>
   </div>';
   }

   ?>
   

</section>

<!--   <section>
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

</section> -->


<?php include 'components/user_footer.php' ?>

<script src="js/main.js" type="text/javascript"></script>
<script>
 let link = document.querySelectorAll("#page-no")
 let bodyIds = parseInt(document.body.id) - 1 ;
 link[bodyIds].classList.add("active");
</script>
</body>
</html>