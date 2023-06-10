<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>



<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">Home</a> / Shop </p>
</div>


<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Search products..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>



<br>
<br>
<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">₱ <?php echo $fetch_product['price']; ?></div>

     <!-- <div class="quantity">Available : <?php echo $fetch_product['quantity']; ?></div> -->

      <?php if ($fetch_product['quantity'] >= 11) { ?>
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
        <input type="hidden" name="product_quantity" value="<?php echo $fetch_product['quantity']; ?>">
        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
        <input type="submit" class="btn" value="add to cart" name="add_to_cart">
      <?php } else { ?>
        <div class="name"><span style="color:red">Currently not available</span></div>
      <?php } ?>
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">No result found!</p>';
         }
      }
   ?>
   </div>
  

</section>





<section class="menu">

   <h1 class="title">menu</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₱ <?php echo $fetch_products['price']; ?></div>

     <!--<div class="quantity"> Available : <?php echo $fetch_products['quantity']; ?></div>-->

      <input type="number"  class="qty" name="product_quantity" min="1" max="10" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">

      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <?php if ($fetch_products['quantity'] >= 11) { ?>
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <?php } else { ?>
        <div class="name"><span style="color:red">Currently not available</span></div>
      <?php } ?>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
   <button onclick="topFunction()" id="up" title="Go to top"><i class='fas fa-angle-up'></i></button>
   
   

</section>










<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>