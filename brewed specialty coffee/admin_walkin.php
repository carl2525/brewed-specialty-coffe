<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND admin_id = '$admin_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Order Already added!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(admin_id, name, price, quantity) VALUES('$admin_id', '$product_name', '$product_price', '$product_quantity')") or die('query failed');
      $message[] = 'Order added!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Walk In</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>



<section>
   <h1 class="title">Walk In</h1>
   
</section>


<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Search products..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>



<br>
<br>
<section class="products" style="padding-top: 0;">

   <div class="box-containerS">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <!--<img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">-->
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">₱ <?php echo $fetch_product['price']; ?></div>

      <div class="quantity">Available : <?php echo $fetch_product['quantity']; ?></div>
	   <input type="number"  class="qty" name="product_quantity" min="1" max="10" value="1">

      <?php if ($fetch_product['quantity'] >= 16) { ?>
        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
        <input type="hidden" name="product_quantity" value="<?php echo $fetch_product['quantity']; ?>">
       <!-- <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>"> -->
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


 
         <div class="wiicons">   
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE admin_id = '$admin_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="admin_cart.php">  <span style="color:brown"> Check Out (<?php echo $cart_rows_number; ?>)</span> <i class="fas fa-shopping-cart" style="color:brown"></i> </a>
         </div>

   <h1 class="title">menu</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <!-- <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""> -->
      <br></br>
	  <br></br>
	  <div class="name"><?php echo $fetch_products['name']; ?></div>
	  
      <div class="price">₱ <?php echo $fetch_products['price']; ?></div>

     <div class="quantity"> Available : <?php echo $fetch_products['quantity']; ?></div>

      <input type="number"  class="qty" name="product_quantity" min="1" max="10" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">

     <!-- <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>"> -->
      <?php if ($fetch_products['quantity'] >= 1) { ?>
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


<script>
// Get the button
let mybutton = document.getElementById("up");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
   
</section>



<!--<section>
   <h1 class="title">Menu</h1>

   <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
   ?>
<table class="table">
 <tr class="tr">
 <th class="th">Product name</th>
 <th class="th">Price</th>
 <th class="th">Availability</th>
 <th class="th">Action</th>
 </tr>
      <?php
            
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
  <tr class="tr">
 <td class="td"><?php echo $fetch_products['name']; ?></td>
 <td class="td"><div class="price">₱<?php echo $fetch_products['price']; ?></div></td>
 <td class="td"> <div class="quantity">  <?php echo $fetch_products['quantity']; ?></div>

     
	  
	  
	  
 <td class="td">  

      <input type="number"  class="qty" name="product_quantity" min="1" max="10" value="1"> <br>
      <?php if ($fetch_products['quantity'] >= 16) { ?>
        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <?php } else { ?>
        <div class="name"><span style="color:red">Currently not available</span></div>
      <?php } ?>  </td>

      <?php
          
            }
         }
      ?>
</table>
</section> -->
	














<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>