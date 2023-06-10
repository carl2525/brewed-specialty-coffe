<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:orders.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';

}

if (isset($_GET['send'])) {
  $order_id = $_GET['send'];
  // update payment status to cancelled
  $fetch_orders['payment_status'] = 'cancelled'; 
  // update the payment status in the database
  mysqli_query($conn, "UPDATE orders SET payment_status='cancelled' WHERE id='$order_id'"); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p> <a href="home.php">Home</a> / Orders </p>
</div>

<!--<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Phone Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>

         <p> Total price : <span><?php echo $fetch_orders['total_price']. ' + (35 delivery fee)'; ?></span> </p>

         <p> Order status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ 
echo 'red'; }
elseif($fetch_orders['payment_status'] == 'preparing'){
echo '#ED7014'; } 
elseif($fetch_orders['payment_status'] == 'to deliver'){
echo '#9ACD32'; } 
elseif($fetch_orders['payment_status'] == 'cancelled'){
echo '#d91616'; } // added elseif clause for cancelled status 
else{ echo 'green'; } ?>;">

<?php echo $fetch_orders['payment_status']; ?></span> </p>

<?php if ($fetch_orders['payment_status'] == 'pending') { ?>
  <form action="orders.php" method="get">
    <input type="hidden" name="send" value="<?php echo $fetch_orders['id']; ?>">
    <input type="submit" value="Cancel" onclick="return confirm('Cancel this order?');" class="btn">
  </form>
<?php } ?>

         </div>
      <?php
       }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>

</section> -->




<section class="placed-orders">
   <h1 class="title">placed orders</h1>

   <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
   ?>
<table class="table">
<thead>
 <tr class="tr">
 <th class="th">Placed on</th>
 <th class="th">Name</th>
 <th class="th">Phone Number</th>
 <th class="th">Email</th>
 <th class="th">Address</th>
 <th class="th">Payment method</th>
 <th class="th">Orders</th>
 <th class="th">Total Price</th>
 <th class="th">Order Status</th>
 </tr>
</thead>
      <?php
            
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
  <tr class="tr">
<tbody>
 <td data-label="Placed on"> <span><?php echo $fetch_orders['placed_on']; ?></span> </td>
 <td data-label="Name"> <span><?php echo $fetch_orders['name']; ?></span> </td>
 <td data-label="Phone Number"> <span><?php echo $fetch_orders['number']; ?></span> </td>
 <td data-label="Email"> <span><?php echo $fetch_orders['email']; ?></span> </td>
 <td data-label="Address"> <span><?php echo $fetch_orders['address']; ?></span> </td>
 <td data-label="Payment method"> <span><?php echo $fetch_orders['method']; ?></span> </td>
 <td data-label="Orders"> <span><?php echo $fetch_orders['total_products']; ?></span> </td>
 <td data-label="Total Price">₱ <span><?php echo $fetch_orders['total_price']; ?></span> </td>
 <td data-label="Order Status"> <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ 
echo 'red'; }
elseif($fetch_orders['payment_status'] == 'preparing'){
echo '#ED7014'; } 
elseif($fetch_orders['payment_status'] == 'to deliver'){
echo '#9ACD32'; } 
elseif($fetch_orders['payment_status'] == 'cancelled'){
echo '#d91616'; } // added elseif clause for cancelled status 
else{ echo 'green'; } ?>;">

<?php echo $fetch_orders['payment_status']; ?></span> </p>

<?php if ($fetch_orders['payment_status'] == 'pending') { ?>
  <form action="orders.php" method="get">
    <input type="hidden" name="send" value="<?php echo $fetch_orders['id']; ?>">
    <input type="submit" value="Cancel" onclick="return confirm('Cancel this order?');" class="btn">
  </form>
<?php } ?> </td>
</tbody>
      <?php
       }
      }else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
</table>

<button onclick="topFunction()" id="up" title="Go to top"><i class='fas fa-angle-up'></i></button>




</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>