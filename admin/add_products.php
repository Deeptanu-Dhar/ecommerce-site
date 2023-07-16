<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[]='Products name already exists !';
   }
   else{

      if($image_size > 2000000){
         $message[]='image size too large';
      }
      else{

         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(product_category, product_name, product_description,product_price,product_image) VALUES (?,?,?,?,?)");
         $insert_product->execute([$category, $name, $details, $price, $image]);

         $message[]='Product added successfully !';
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
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <script src="https://kit.fontawesome.com/c96e89392a.js" crossorigin="anonymous"></script>

</head>
<body>

   <?php include '../components/admin_header.php' ?>


   <!-- -------------add products sections---------- -->
   
   <section class="add-products">

      <div class="add-product-heading">
         <h1>ADD PRODUCTS</h1>
      </div>
      
      <form action="" method="POST" enctype="multipart/form-data" class="products-form">

         <div class="flex">

            <div class="inputBox">
               <label for="name">Product name (required)</label>
               <input type="text" required placeholder="Enter Product name" name="name" maxlength="100" class="box" id="">
            </div>
            <div class="inputBox">
               <label for="price">Product price (required)</label>
               <input type="number" min="0" max="9999999" required placeholder="price" name="price" maxlength="100" id="" onkeypress="if(this.value.length == 10) return false;" class="box">
            </div>
            <div class="inputBox">
               <label for="cars">Choose category</label>
               <select id="" name="category" size="1" class="box" default="none">
                  <option value="none" selected disabled hidden>Select an Option</option>
                  <option value="brush">Brushes & Accessories</option>
                  <option value="crafts">Crafts</option>
                  <option value="paints">Paints & Colors</option>
                  <option value="paper">Papers & Boards</option>
                  <option value="stationery">Stationery</option>
               </select>
            </div>
            <div class="inputBox">
               <label for="image">Insert product image (required)</label>
               <input type="file" name="image" id="" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <div class="inputBox">
               <label for="details">Product details</label>
               <textarea name="details" id="" placeholder="Enter product details" cols="30" rows="10" class="box" required></textarea>
            </div>
            <input type="submit" value="Add Product" name="add_product" class="btn">

         </div>
         
      </form>

   </section>

   <!-- -------------add products sections---------- -->




   <script src="../js/admin_script.js"></script>
</body>
</html>