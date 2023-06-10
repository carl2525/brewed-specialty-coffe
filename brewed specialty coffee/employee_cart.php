<?php

include 'config.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if(!isset($employee_id)){
   header('location:login_employee.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'Cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE employee_id = '$employee_id'") or die('query failed');
   header('location:employee_cart.php');
}


if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_SESSION['employee_name']); 
   $cname = $_POST['cname'];
   $onumber = $_POST['onumber'];
   $email = mysqli_real_escape_string($conn, $_SESSION['employee_email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE employee_id = '$employee_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){

   $prd_name = $cart_item['name'];
   $prd_qty = $cart_item['quantity'];
   $prd_price = $cart_item['price'];
 

         $cart_products[] = $prd_name.' ('.$prd_qty.')';
         $sub_total = ($prd_price * $prd_qty);
         $cart_total += $sub_total;


    mysqli_query($conn, "UPDATE `products` SET quantity = (quantity - '$prd_qty') WHERE name = '$prd_name'") or die('query failed');
      }
   }

   $total_products = implode(' ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `walkin` WHERE name = '$name' AND cname = '$cname' AND onumber = '$onumber' AND email = '$email' AND method = '$method'  AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Your Cart is Empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Order Already Placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `walkin`(employee_id, name, cname, onumber , email, method, total_products, total_price, placed_on) VALUES('$employee_id', '$name', '$cname', '$onumber', '$email', '$method', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Order Placed Successfully!';

         mysqli_query($conn, "DELETE FROM `cart` WHERE employee_id = '$employee_id'") or die('query failed');
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
   <title>Employee Checkout Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'employee_header.php'; ?>

<!-- <div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="home.php">Home</a> / Cart </p>
</div> -->

<section class="shopping-cart">

   <h1 class="title">Orders</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE employee_id = '$employee_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="employee_cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price"><?php echo $fetch_cart['price']; ?></div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" max="10"  name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> Sub total : <span><?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?></span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="employee_cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all from cart?');">delete all</a>
	  <br>
	  <a href="employee_walkin.php" class="option-btn">Add more</a>
   </div>

  <!-- <div class="cart-total">
      <p>Grand total : <span><?php echo $grand_total; ?></span></p>
      <div class="flex">
         <a href="admin_walkin.php" class="option-btn">Add more</a>
         <a href="admin_checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a> 
      </div>-->
   </div>

</section>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE employee_id = '$employee_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo ''.$fetch_cart['price'].''.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
         }
      } else {
         echo '<p class="empty">Empty</p>';
      }
   ?>
   <div class="grand-total"> Grand total : <span><?php echo $grand_total; ?></span> </div>

   <input type="number" id="change-input" style="padding: 18px; margin-top: 10px; border: 1px solid;" placeholder="Enter the amount" oninput="calculateChange()">

   <script>
      function calculateChange() {
         var amountReceived = document.getElementById('change-input').value;
         var grandTotal = <?php echo $grand_total; ?>;
         var change = amountReceived - grandTotal;
         document.getElementById('change-output').innerHTML = 'Change: ' + change;
      }
   </script>

   <div style="font-size: 25px; color: var(--red); margin-top: 10px;" id="change-output"></div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3> your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <p> <span><?php echo $_SESSION['employee_name']; ?></span></p>
         </div>
         <div class="inputBox">
            <span>Customer Name :</span>
            <input type="text" name="cname" required placeholder=" Customer Name">
         </div>
		 
        <div class="inputBox">
            <span>Email :</span>
            <p> <span><?php echo $_SESSION['employee_email']; ?></span></p>
         </div> 

 <div class="inputBox">
            <span>Order Number :</span>
            <input type="number" name="onumber" required placeholder="Customer Order Number" maxlength="3">
         </div>

         <div class="inputBox">
            <span>Method :</span>
            <select name="method">
               <option value="dine in">Dine In</option>
               <option value="take out">Take Out</option>
            </select>
         </div>



       <!--  <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="blk" required placeholder=" block no. lot no. and street">
         </div>
         <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="barangay" required placeholder=" Subdivision and Barangay  ">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <select name="city">
               <option value="Cainta Rizal">Cainta Rizal</option>
               <option value="Taytay Rizal">Taytay Rizal</option>
               <option value="Pateros City">Pateros City</option>
               <option value="Pasig City">Pasig City</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Landmark :</span>
            <input type="text" name="info" required placeholder=" e.g.. green gate" >
         </div>

          <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder=" india">
         </div> 

         <div class="inputBox">
            <span>ZIP code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="1900">
         </div> -->

      </div>
      <input type="submit" value="Place Order" class="btn" name="order_btn">

   </form>










<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>