<?php

include 'config.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if(!isset($employee_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:employee_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee Cancelled orders</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'employee_header.php'; ?>


<!--<section class="orders">

   <h2 class="title">Cancelled orders</h2>

    
  

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'cancelled'" ) or die('query failed');
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
   
  <?php } ?>
</form>



      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Cancelled orders yet!</p>';
      }
      ?>
   </div>

</section> -->




<section>
<h1 class="title">Cancelled orders</h1>
   <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'cancelled'" ) or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
   ?>
<table class="tableorders">
 <tr class="tr">
 <th class="th">User id</th>
 <th class="th">Placed on</th>
 <th class="th">Name</th>
 <th class="th">Phone Number</th>
 <th class="th">Email</th>
 <th class="th">Address</th>
 <th class="th">Orders</th>
 <th class="th">Total Price</th>
 <th class="th">Payment Method</th>
 <th class="th">status</th>


 </tr>
      <?php
            $counter = 1;
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
  <tr class="tr">
 <td class="td"><?php echo $fetch_orders['user_id']; ?></td>
 <td class="td"><?php echo $fetch_orders['placed_on']; ?></td>
 <td class="td"><?php echo $fetch_orders['name']; ?></td>
 <td class="td"><?php echo $fetch_orders['number']; ?></td>
 <td class="td"> <?php echo $fetch_orders['email']; ?>  </td>
 <td class="td"> <?php echo $fetch_orders['address']; ?>  </td>
 <td class="td"> <?php echo $fetch_orders['total_products']; ?> </td>
 <td class="td"> <?php echo $fetch_orders['total_price']; ?>  </td>
 <td class="td"> <?php echo $fetch_orders['method']; ?>  </td>




 <td class="td">  <form action="" method="post">
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