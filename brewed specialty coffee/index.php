<?php

include 'config.php';

session_start();



?>




<header class="header">
   <div class="header-1">
      <div class="flex">
            <p> ☕️ brewed specialty coffee </p>
        <p> new <a href="loginuser.php">login</a> | <a href="registeruser.php">register</a> </p> 
      </div>
   </div>
</header>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Brewed</title>
   
    <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
  

</head>
<body>
   


<section class="land">

   <div class="content">
      <h3>Pouring hearts one cup at a time. Farm to cup neighborhood cafe.</h3>
      <p>It’s always a pleasure having you here! 🤎 Awesome food and awesome coffee guaranteed to give you a #BrewedDay☕️✨</p>
     
   </div>


</section>


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
      <a href="loginuser.php" class="option-btn">load more</a>
   </div>
   
    

</section>

<!-- <section classs="container">
<h1 class="title">Best Seller</h1>
  <div class="slider-wrapper">
    <div class="slider">
  <img id="slide-1" src="images/B_oreo_ssalt_latte.png" alt=""/>
  <img id="slide-2" src="images/B_Creamy Truffle Mushroom.png" alt=""/>
  <img id="slide-3" src="images/B_Grilled Cheese Sandwich.png" alt=""/>
  <img id="slide-3" src="images/B_Presa Latte.png" alt=""/>
  <img id="slide-5" src="images/B_Beef Tapa.png" alt=""/>
  <img id="slide-6" src="images/B_Carmel Macchiato.png" alt=""/>
  <img id="slide-7" src="images/B_Sausage Stroganoff.PNG" alt=""/>

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
      <a href="loginuser.php" class="option-btn">Shop</a>
   </div>
</section>-->

<!--<section classs="container">
<h1 class="title">Best Seller Drinks</h1>
  <div class="slider-wrapper">
    <div class="slider">
  <img id="slide-7" src="images/B_oreo_ssalt_latte.png" alt=""/>
  <img id="slide-8" src="images/B_Carmel Macchiato.png" alt=""/>
  <img id="slide-9" src="images/B_Presa Latte.png" alt=""/>

    </div>
    <div class="slider-nav">
      <a href="#slide-7"></a>
      <a href="#slide-8"></a>
      <a href="#slide-9"></a>
    </div>
  </div>
<div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="loginuser.php" class="option-btn">load more</a>
   </div>
</section> -->

<!--<section class="about">

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
	<br>Upgrade fresh mikl to oatmilk +60, Caramel & Chocolate syrup +30</br></p>
         <p>If you have other add ons you can sent us a message on our contact section.</p>
         <a href="loginuser.php" class="white-btn">contact us</a>
         
      </div>

   </div>

</section> -->



<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>Brewed Specialty Coffee</h3>
         <p>Coffee Shop</p>
         <p>We are a third wave Coffee Shop Serving farm to cupbeans from local farmers, Locally, Ethically source, community cafe and neighborhood cafe.</p>
         <p><i class="fas fa-map-marker-alt"></i> Located at The Red Dot, C. Raymundo Avenue, Rosario Pasig City, Pasig, Philippines, 1607 </p>
         <p>Only can deliver on Selected area (Pateros City, Taytay Rizal, Cainta Rizal, and Pasig City)</p>
      </div>

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


<!--<section class="home-contact">

   <div class="content">
      <h3>Brewed Specialty Coffee</h3>
      <p>About Us?</p>
      <a href="loginuser.php" class="btn">read more</a>
   </div>

</section>-->







<section class="footer">

  <div class="box-container">

      <div class="box">
         <h3>Shortcuts</h3>
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </div>

      <div class="box">
         <h3>Extra links</h3>
         <a href="cart.php">Cart</a>
         <a href="orders.php">Orders</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <span>☎</span> 0917 726 4129 </p>
         <p> <span>📧</span> brewedspecialtycoffee@yahoo.com </p>
         <p> <a href="https://www.google.com/maps/place/The+Red+Dot+Pasig/@14.5856935,121.085904,17z/data=!3m1!4b1!4m6!3m5!1s0x3397c74adf99bd55:0x958b4e53374ce504!8m2!3d14.5856935!4d121.0880927!16s%2Fg%2F11rjj9tf1_"><span>📍</span> The Red Dot, C. Raymundo Avenue, Rosario Pasig City, Pasig, Philippines, 1607</a> </p>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <p> <a href="https://www.facebook.com/brewedspecialtycoffee/"> ⓕ Bewed Specialty Coffee</a> </p>
      </div>

   </div>

 
  

</section>


<script src="js/script.js"></script>

</body>
</html>