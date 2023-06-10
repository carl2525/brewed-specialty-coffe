<?php

include 'config.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if(!isset($employee_id)){
   header('location:employee_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   



   <header class="header">

 

<input type="checkbox" id="check">
<label for="check">
<i class="fas fa-bars" id="btn"></i>
<i class="fas fa-times" id="cancel"></i>
</label>
<div class="sidebaradp">
	<h2> Brewed Employee </h2>
	<ul>
	<li>  <a href="employee_page.php"> <i class="fas fa-qrcode"></i>Dashboard</a></li>
	<li>  <a href="employee_products.php"> <i class='fas fa-box-open'></i>Product Inventory</a></li>
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Orders
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
		<li>  <a href="employee_orders.php"> Placed Orders</a></li>
		<li>  <a href="employee_completed.php"> <i class=""></i>Completed</a></li>
		<li>  <a href="employee_cancelled.php"> <i class="fa-solid fa-cart-circle-xmark"></i>Cancelled</a></li>
	</div>
	
	
	<!--<li>  <a href="employee_orders.php"> <i class="fas fa-shopping-cart"></i>Orders</a></li>
	<li>  <a href="employee_cancelled.php"> <i class="fa-solid fa-cart-circle-xmark"></i>Cancelled</a></li>
	<li>  <a href="employee_completed.php"> <i class=""></i>Complete</a></li> -->
	<li>  <a href="employee_best.php"> <i class=""></i>Best Seller</a></li>
	<li>  <a href="employee_contacts.php"> <i class="fa fa-envelope-o"></i>Messages</a></li>
	<li>  <a href="employee_users.php"> <i class='fa fa-user-circle'></i>Accounts</a></li>
	
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Walk In
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
	<li>  <a href="employee_walkin.php"> <i class=""></i>Take Orders</a></li>
	<li>  <a href="employee_walkin_orders.php"> <i class=""></i>Walk In Orders</a></li>
	<li>  <a href="employee_walkin_completed.php"> <i class=""></i>Completed </a></li>
	</div>
	</ul>
	
	      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['employee_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['employee_email']; ?></span></p>
         <a href="logoutadmin.php" class="delete-btn">Logout</a>
         <!-- <div>new <a href="loginadmin.php">login</a> | <a href="registeradmin.php">register</a></div> -->
      </div>

</div>


</header>


<script>
	var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

</script>


<!-- employee dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <p>	<!--<a href="employee_orders.php" class="btn">total pending sales</a> --> Online Pending Sales</p>
		 <h3>₱ <?php echo $total_pendings; ?></h3>
      </div>
	  
	  
	   <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status IN ('preparing', 'pending', 'to deliver')") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
		 <p><!--<a href="employee_orders.php" class="btn">Order Place</a>--> Order Place</p>
        <h3> <i class="fas fa-shopping-cart"></i>    <?php echo $number_of_orders; ?></h3>
      </div>
	  
	  
	  
      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
		 <p>	<!--<a href="employee_orders.php" class="btn">Total Completed sales</a> -->Total Online sales</p>
         <h3>₱ <?php echo $total_completed; ?></h3>
      </div>

     

      <div class="box">
         <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
		 <p><!--<a href="employee_products.php" class="btn">Product Added</a>-->Product Inventory</p>
         <h3> <i class='fas fa-box-open'></i> <?php echo $number_of_products; ?></h3>
         
      </div>
	  
	  <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `walkin` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
		 <p> <!--<a href="admin_orders.php" class="btn">total pending sales</a>--> Walk In Pending Sales</p>
         <h3>₱ <?php echo $total_pendings; ?></h3>
         <!--<p><a href="admin_orders.php" class="btn">total pending sales</a></p>-->
      </div>
	  
	  
	  <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `walkin` WHERE payment_status IN ('preparing', 'pending', 'to deliver')") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
		 <p><!--<a href="admin_orders.php" class="btn">Order Place</a>--> Walk In Order Place</p>
         <h3> <i class="fas fa-shopping-cart"></i>    <?php echo $number_of_orders; ?></h3>
         <!--<p><a href="admin_orders.php" class="btn">Order Place</a></p>-->
      </div>
	  
	  
	  <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `walkin` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
		 <p> <!--<a href="admin_orders.php" class="btn"></a>--> Total Walk In Sales</p>
         <h3>₱ <?php echo $total_completed; ?></h3>
        
      </div>

      <!--<div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><i class='fa fa-user-circle'></i><?php echo $number_of_users; ?></h3>
         <p><a href="employee_users.php" class="btn">User Account</a></p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p><a href="employee_users.php" class="btn">Admin Account</a></p>
      </div> -->
	  
	  
	  <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
		 <p>	<!--<a href="employee_contacts.php" class="btn">New Message</a>--> New Message</p>
         <h3><i class='fas fa-envelope-square'></i> <?php echo $number_of_messages; ?></h3>
         
      </div>
	  
	  
     <!-- <div class="box">
         <?php 
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
		  <p>	<a href="employee_users.php" class="btn">Total Accounts</a>Total Accounts</p>
         <h3><i class='fa fa-user-circle'></i> <?php echo $number_of_account; ?></h3>
        
      </div> -->
	  
	  <div class="box">
	  <?php
  $total_completed = 0;
  $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
  if(mysqli_num_rows($select_completed) > 0){
    while($fetch_completed = mysqli_fetch_assoc($select_completed)){
      $total_price = $fetch_completed['total_price'];
      $total_completed += $total_price;
    };
  };
  
  $select_walkin = mysqli_query($conn, "SELECT total_price FROM `walkin` WHERE payment_status = 'completed'") or die('query failed');
  if(mysqli_num_rows($select_walkin) > 0){
    while($fetch_walkin = mysqli_fetch_assoc($select_walkin)){
      $total_price = $fetch_walkin['total_price'];
      $total_completed += $total_price;
    };
  };
?>

  <p>Total Completed sales</p>
  <h3>₱ <?php echo $total_completed; ?></h3>
</div>

      

   </div>

</section>


<section class="tabadp">
   <h1 class="title">Menu</h1>

   <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
   ?>
<table class="tableadp">
 <tr class="tr">
 <th class="th">#</th>
 <th class="th">Products</th>
 <th class="th">Availability</th>
 <!--<th class="th">Price</th>-->
 </tr>
      <?php
            $counter = 1;
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
  <tr class="tr">
 <td class="td"><?php echo $counter; ?>.</td>
 <td class="td"><?php echo $fetch_products['name']; ?></td>
 <td class="td">   <div class="quantity"> 
  <?php 
    if($fetch_products['quantity'] <= 0) {
      echo '<span style="color:red">Out of stock</span>';
    } else {
      echo $fetch_products['quantity'];
      if($fetch_products['quantity'] < 21){
        echo '</p> <span style="color:orange">Critical Level</span>'; 
      }
    }
  ?>
</div>  </td>
<!-- <td class="td"><?php echo $fetch_products['price']; ?></td>-->
 </tr>
      <?php
            $counter++;
            }
         }
      ?>
</table>

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


<!-- admin dashboard section ends -->









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>