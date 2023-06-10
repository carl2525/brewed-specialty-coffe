<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:loginuser.php');
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
   <title>Home</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Pouring hearts one cup at a time. Farm to cup neighborhood cafe.</h3>
      <p>It’s always a pleasure having you here! 🤎 Awesome food and awesome coffee guaranteed to give you a #BrewedDay☕️✨.</p>
     
   </div>

</section>

<!--<section classs="container">
<h1 class="title">Best Seller</h1>
  <div class="slider-wrapper">
    <div class="slider">
  <img id="slide-1" src="images/B_oreo_ssalt_latte.png" alt=""/>
  <img id="slide-2" src="images/B_Creamy Truffle Mushroom.png" alt=""/>
  <!--<img id="slide-3" src="images/B_Grilled Cheese Sandwich.png" alt=""/>
  <img id="slide-3" src="images/B_Presa Latte.png" alt=""/>
  <img id="slide-4" src="images/B_Beef Tapa.png" alt=""/>
  <img id="slide-5" src="images/B_Carmel Macchiato.png" alt=""/>
  <img id="slide-6" src="images/B_Sausage Stroganoff.PNG" alt=""/>

    </div>
    <div class="slider-nav">
      <a href="#slide-1"></a>
      <a href="#slide-2"></a>
      <a href="#slide-3"></a>
      <a href="#slide-4"></a>
      <a href="#slide-5"></a>
      <a href="#slide-6"></a>
      
    </div>
  </div>
      <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Shop</a>
   </div>
</section> -->

<!--<section class="menu">

   <h1 class="title">Best Seller</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price"><?php echo $fetch_products['price']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section> -->


<section class="products">

   <h1 class="title">Best Seller</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `best` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
     <!-- <div class="price">$<?php echo $fetch_products['price']; ?>/-</div> 
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">-->
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>


<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/employee.jpg" alt="">
      </div>

      <div class="content">
         <h3>How to order?</h3>
         <p>Go to shop you can find our menu there.</p>
         <p>For drinks add ons you can also see it on shop section or just search it.</p>
         <p>For add ons Espresso you can reffer to this:
	<br>Extra Espresso Shot +30, Upgrade fresh milk to oatmilk +60, Caramel & Chocolate syrup +30</br></p>
	 <p>For add ons non-coffee you can reffer to this:
	<br>Upgrade fresh milk to oatmilk +60, Caramel & Chocolate syrup +30</br></p>
         <p>If you have other add ons you can sent us a message on our contact section.</p>
         <a href="contact.php" class="white-btn">contact us</a>
         
      </div>

   </div>
   
   

</section>



<section class="home-contact">

   <div class="content">
      <h3>Brewed Specialty Coffee</h3>
      <p>About Us?</p>
      <a href="about.php" class="btn">read more</a>
   </div>
   
   
   
   <button onclick="topFunction()" id="up" title="Go to top"><i class='fas fa-angle-up'></i></button>

</section>






<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>