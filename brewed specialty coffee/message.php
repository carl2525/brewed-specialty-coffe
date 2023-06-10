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


if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Message</title>
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Messages</h3>
   <p> <a href="home.php">Home</a> / Messages </p>
</div>

<!--<section class="placed-orders">

   <h1 class="title"> messages </h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> User id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Name : <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Phone Number : <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email : <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Message : <span><?php echo $fetch_message['message']; ?></span> </p>
      <p> Feedback : <span><?php echo $fetch_message['feedback']; ?></span> </p>
      
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">You have no messages!</p>';
   }
   ?>
   </div>

</section> -->



<section>
   <h1 class="title">Message</h1>

   <?php
         $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
   ?>
<table class="table">
 <tr class="tr">
 <!--<th class="th">User ID</th>-->
 <th class="th">Name</th>
 <th class="th">Phone Number</th>
 <th class="th">Email</th>
 <th class="th">Message</th>
 <th class="th">Feedback</th>
 </tr>
      <?php
            
            while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
  <tr class="tr">
<!-- <td class="td"> <span><?php echo $fetch_message['user_id']; ?></span> </td>-->
 <td class="td"> <span><?php echo $fetch_message['name']; ?></span> </td>
 <td class="td"> <span><?php echo $fetch_message['number']; ?></span> </td>
 <td class="td"> <span><?php echo $fetch_message['email']; ?></span> </td>
 <td class="td"> <span><?php echo $fetch_message['message']; ?></span> </td>
 <td class="td"> <span><?php echo $fetch_message['feedback']; ?></span> </td>

         <?php
      };
   }else{
      echo '<p class="empty">You have no messages!</p>';
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