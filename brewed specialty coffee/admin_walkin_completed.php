<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:loginadmin.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `walkin` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `walkin` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_walkin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Completed orders</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>


<!-- <section class="orders">

   <h2 class="title">Completed orders</h2>

    
  

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed'" ) or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> User id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total price : <span><?php echo $fetch_orders['total_price']; ?></span> </p>
         <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>




       <form action="" method="post">
  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
  <?php if ($fetch_orders['payment_status'] != 'cancelled') { ?>
    <select name="update_payment">
      <option value=><?php echo $fetch_orders['payment_status']; ?></option>
      <option value="pending">Pending</option>
      <option value="preparing">Preparing</option>
      <option value="to deliver">To Deliver</option>
      <option value="completed">Completed</option>
    </select>
    <?php if ($fetch_orders['payment_status'] != 'completed') { ?>
      <input type="submit" value="update" name="update_order" class="option-btn">
    <?php } ?>
  <?php } else { ?>
    <p>Cancelled Order</p>
  <?php } ?>
  <?php if ($fetch_orders['payment_status'] == 'completed' || $fetch_orders['payment_status'] == 'cancelled') { ?>
    <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
  <?php } ?>
</form>



      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Completed sales yet!</p>';
      }
      ?>
   </div>

</section> -->


<section>
<h1 class="title">Walk In Completed orders</h1>
</section>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Search Placed On..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
   if (isset($_POST['submit'])) {
      $search_item = $_POST['search'];
      $select_products = mysqli_query($conn, "SELECT * FROM `walkin` WHERE placed_on LIKE '%{$search_item}%' AND payment_status = 'completed'") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
		  $total_price = 0;
         ?>
         <table class="tableorders">
            <tr class="tr">
               <!-- <th class="th">User id</th>-->
				 <th class="th">Placed on</th>
				 <th class="th">Name</th>
				 <th class="th">Email</th>
				 <th class="th">Order Number</th>
				 <th class="th">Customer Name</th>
				 <th class="th">Orders</th>
				 <th class="th">Total Price</th>
				 <th class="th"> Method</th>
				 <th class="th">status</th>
				
            </tr>
         <?php
         while ($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>
            <tr class="tr">
               <!--<td data-label="User id"><?php echo $fetch_product['admin_id']; ?></td>-->
			 <td data-label="Placed on"><?php echo $fetch_product['placed_on']; ?></td>
			 <td data-label="Name"><?php echo $fetch_product['name']; ?></td>
			 <td data-label="Email"> <?php echo $fetch_product['email']; ?>  </td>
			 <td data-label="Order Number"><?php echo $fetch_product['onumber']; ?></td>
			  <td data-label="Customer Name"><?php echo $fetch_product['cname']; ?></td>
			 <td data-label="Orders"> <?php echo $fetch_product['total_products']; ?> </td>
			 <td data-label="Total Price">₱ <?php echo $fetch_product['total_price']; ?>  </td>
			 <td data-label="method"> <?php echo $fetch_product['method']; ?>  </td>
			 <td data-label="method"> <?php echo $fetch_product['payment_status']; ?>  </td>
            </tr>
            <?php
			 $total_price += $fetch_product['total_price']; // Add the current total_price to the cumulative sum
         }
         echo "</table>";
		  echo "<p style='color: red; margin-top: 1.5rem; text-align: center; font-size: 20px;'>Total: ₱ " . $total_price . "</p>"; // Display the total price
      } else {
         echo "<p style='color: red; text-align: center; font-size: 20px;'>No completed orders found.</p>";
      }
   }
   ?>

</section>

<section>
   <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `walkin` WHERE payment_status = 'completed'" ) or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
   ?>
<table class="tableorders">
 <tr class="tr">
 <!--<th class="th">User id</th>-->
 <th class="th">Placed on</th>
 <th class="th">Name</th>
 <th class="th">Email</th>
 <th class="th">Order Number</th>
 <th class="th">Customer Name</th>
 <th class="th">Orders</th>
 <th class="th">Total Price</th>
 <th class="th"> Method</th>
 <th class="th">status</th>


 </tr>
      <?php
            $counter = 1;
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
  <tr class="tr">
 <!--<td data-label="User id"><?php echo $fetch_orders['admin_id']; ?></td>-->
 <td data-label="Placed on"><?php echo $fetch_orders['placed_on']; ?></td>
 <td data-label="Name"><?php echo $fetch_orders['name']; ?></td>
 <td data-label="Email"> <?php echo $fetch_orders['email']; ?>  </td>
 <td data-label="Order Number"><?php echo $fetch_orders['onumber']; ?></td>
  <td data-label="Customer Name"><?php echo $fetch_orders['cname']; ?></td>
 <td data-label="Orders"> <?php echo $fetch_orders['total_products']; ?> </td>
 <td data-label="Total Price">₱ <?php echo $fetch_orders['total_price']; ?>  </td>
 <td data-label="method"> <?php echo $fetch_orders['method']; ?>  </td>




 <td class="td">  <form action="" method="post">
  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
  <?php if ($fetch_orders['payment_status'] != 'cancelled') { ?>
    <select name="update_payment" style="padding: 0.5rem;">
      <option value=><?php echo $fetch_orders['payment_status']; ?></option>
      <option value="pending">Pending</option>
      <option value="preparing">Preparing</option>
      <option value="completed">Completed</option>
    </select>
    <?php if ($fetch_orders['payment_status'] != 'completed') { ?>
      <input type="submit" value="update" name="update_order" class="option-btn">
    <?php } ?>
  <?php } else { ?>
    <p>Cancelled Order</p>
  <?php } ?>
  <?php if ($fetch_orders['payment_status'] == 'completed' || $fetch_orders['payment_status'] == 'cancelled') { ?> <br>
    <a href="admin_walkin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
  <?php } ?>
</form> </td>


 </tr>
       <?php
         }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
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







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>