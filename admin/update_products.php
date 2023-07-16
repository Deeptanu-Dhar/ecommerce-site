<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET product_name = ?, product_price = ?, product_description = ? WHERE product_id = ?");
   $update_product->execute([$name, $price, $details, $pid]);

   $message[] = 'product updated successfully!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `products` SET product_image = ? WHERE product_id = ?");
         $update_image->execute([$product_image, $product_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated successfully!';
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
   <title>update product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="update-product">

      <div class="update-product-heading">
         <h1>UPDATE PRODUCT</h1>
      </div>

      <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
            ?>
            <form action="" method="post" enctype="multipart/form-data">

               <input type="hidden" name="pid" value="<?= $fetch_products['product_id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['product_image']; ?>">

               <div class="image-container">
                  <img src="<?= $fetch_products['product_image']; ?>" alt="">
               </div>
               <div class="inputBox">
                  <label>update name</label>
                  <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['product_name']; ?>">
               </div>

               <div class="inputBox">
                <label>update price</label>
                <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['product_price']; ?>"> 
             </div>

             <div class="inputBox">
               <label>update details</label>
               <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['product_description']; ?></textarea>
            </div>

            <div class="inputBox">
               <label>update image</label>
               <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            </div>

            <div class="flex-btn">
               <input type="submit" name="update" class="btn" value="update">
               <a href="products.php" class="option-btn">go back</a>
            </div>
         </form>

         <?php
      }
   }else{
      echo '<p class="empty">no product found!</p>';
   }
   ?>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>