<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>

<?php 

if(isset($_GET['page-nr'])){
   $id = $_GET['page-nr'];
}
else{
   $id = 1;
}

?>

<body id="<?= $id ?>">

   <?php include '../components/admin_header.php' ?>

   <?php include '../components/script_placed_orders.php' ?>

   <div class="orders-heading">
      <h1>Current Orders</h1>
   </div>

   <?php 

   $select_orders=$conn->prepare("SELECT * from orders");
   $select_orders->execute();
   if($select_orders->rowCount() > 0){


     ?>
     <section>

        <section class="manage-orders">
         <?php 
         while($row = $result->fetch_assoc()){  
           ?>
           <div class="box">
            <p> Placed on : <span><?= $row['placed_on']; ?></span> </p>
            <p> Name : <span><?= $row['name']; ?></span> </p>
            <p> Number : <span><?= $row['number']; ?></span> </p>
            <p> Address : <span><?= $row['address']; ?></span> </p>
            <p> Total products : <span><?= $row['total_products']; ?></span> </p>
            <p> Total price : <span>₹<?= $row['total_price']; ?>/-</span> </p>
            <p> Payment method : <span><?= $row['method']; ?></span> </p>
            <form action="" method="post">
               <input type="hidden" name="order_id" value="<?= $row['id']; ?>">

               <select name="payment_status" class="select">
                  <option selected disabled><?= $row['payment_status']; ?></option>
                  <option value="pending">pending</option>
                  <option value="completed">completed</option>
               </select>
               <div class="flex-btn">
                  <input type="submit" value="update" class="option-btn" name="update_payment">
                  <a href="placed_orders.php?delete=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
               </div>
            </form>
         </div>
         <?php 
            }
         ?>
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
</section>
<?php 

}else{
   echo '<div class="empty-text"><p class="empty">No current orders !</p></div>';
}

?>



<script src="../js/admin_script.js"></script>
<script>
 let link = document.querySelectorAll("#page-no")
 let bodyIds = parseInt(document.body.id) - 1 ;
 link[bodyIds].classList.add("active");
</script>
</body>
</html>