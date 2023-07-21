<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){
   header('location:user_login.php');
}

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, `number`, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

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

   <?php include 'components/script_cart.php' ?>

   <div class="cart-heading">
    <h1>view your items</h1>
  </div>

  <?php
     $check_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?"); 
     $check_items->execute([$user_id]);
     if($check_items->rowCount() > 0){
      
   ?>

  <section class="wishlist-items">
   <section class="scroll-items">
   <table class="table-content" max-width="95%">  

      <thead>  

         <tr>  

            <th>Quantity</th>

            <th>Image</th>

            <th>Name</th>
           
            <th>Price</th>  

         </tr>  

      </thead>

      <tbody>

         <?php

         $grand_total = 0;
         $cart_items[] = '';
         while ($fetch_cart = $check_items->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
                  $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
               }      

         while($row = $result->fetch_assoc()){

            ?>
            
            <tr>
               <td><h5><?= $row['quantity']?></h5></td>
               <td><div class="img-box"><a href="quick_view.php?pid=<?= $row['pid']?>"><img src="<?= $row['image']; ?>" alt=""></a></div></td>
               <td><h5><?php echo $row['name']; ?></h5></td>
               
               <td><h4><span class="price-sign">₹</span><?php echo $row['price']; ?></h4></td>

            </tr>

            <?php
                  };
            ?>

            

      </tbody>

   </table>
   </section>
   <table class="table-content">
      <tr>
               <th colspan="2">Grand Total</th>
               <th><span class="price-sign">₹</span><?= $grand_total ?></th>
            </tr>
   </table>

</section>

<section>
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
      echo '<div class="empty-text"><p class="empty">Your cart is empty !</p></div>';
   }
 ?>

 </section>

 <div class="cart-heading">
    <h1>Place your order</h1>
  </div>

  <section class="order-form">

   <form action="" method="POST">
      
      <input type="hidden" name="total_products" value="<?= $total_products; ?>">
      <input type="hidden" name="total_price" value="<?= $grand_total; ?>">

      <div class="flex shadow-style2" id="order-form-container">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paytm">paytm</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" placeholder="e.g. mumbai" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" placeholder="e.g. maharashtra" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. India" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>


      <div class="order-btn"><input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order"></div>
      
   </form>
     
  </section>


<?php include 'components/user_footer.php' ?>

<script src="js/main.js" type="text/javascript"></script>
<script>
  let link = document.querySelectorAll("#page-no")
  let bodyIds = parseInt(document.body.id) - 1 ;
  link[bodyIds].classList.add("active");
</script>
</body>
</html>