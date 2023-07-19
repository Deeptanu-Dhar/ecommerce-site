<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];

   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE product_id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['product_image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE product_id = ?");
   $delete_products->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
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

   <?php include '../components/script.php' ?>


   <div class="add-product-btn">
      <a href="add_products.php" class="btn">Add products</a>
   </div>


   <table class="table-content">  

      <thead>  

         <tr>  

            <th>ID</th>

            <th>Category</th>

            <th>Image</th>

            <th>Name</th>

            <th>Description</th>  

            <th>Price</th>

            <th>Update</th>

            <th>Delete</th>  

         </tr>  

      </thead>

      <tbody>

         <?php       

         while($row = $result->fetch_assoc()){

            ?>

            <tr>

               <td><h4><?php echo $row['product_id']; ?></h4></td>
               <td><h4><?php echo $row['product_category']; ?></h4></td>
               <td><img src="<?php echo $row['product_image']; ?>" alt=""></td>
               <td><h5><?php echo $row['product_name']; ?></h5></td>
               <td><p><?php echo $row['product_description']; ?></p></td>
               <td><h4><?php echo $row['product_price']; ?></h4></td>
               <td><a href="update_products.php?update=<?php echo $row["product_id"]; ?>"class="btn">Update</a></td>
               <td><a href="products.php?delete=<?php echo $row["product_id"]; ?>" onclick="return confirm('Delete this product ?');" class="delete-btn">Delete</a></td>

            </tr>

            <?php

         };

         ?>

      </tbody>

   </table>

   


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

<script src="../js/admin_script.js"></script>
<script>
  let link = document.querySelectorAll("#page-no")
  let bodyIds = parseInt(document.body.id) - 1 ;
  link[bodyIds].classList.add("active");
</script>
</body>
</html>