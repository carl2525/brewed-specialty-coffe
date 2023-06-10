<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];

   $qty = $_POST['quantity'];

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, quantity, archive) VALUES('$name', '$price', '$image', '$qty', '0')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'Image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Product added successfully!';
         }
      }else{
         $message[] = 'Product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);


  date_default_timezone_set("asia/manila");
 $time = date("Y/m/d H:i:s",strtotime("+0 HOURS"));

  $row_audit = mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$delete_id'") or die('query failed');
   $row_result = mysqli_fetch_assoc($row_audit); 

   $audit_name = $row_result['name'];
   $audit_price = $row_result['price'];
   $audit_quantity = $row_result['quantity'];


 $delete_product_trail = mysqli_query($conn, "INSERT INTO `audit_trail`(timedate ,employeename, name, action, description) VALUES('$time' ,'$admin_name', ' Delete the product named ', '$audit_name', 'with a price value of $audit_price pesos and quantity of $audit_quantity')") or die('query failed');


   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');

   header('location:admin_archive_products.php');
}

if(isset($_GET['restore'])){
   $restore_id = $_GET['restore'];
   mysqli_query($conn, "UPDATE products SET archive ='0' WHERE id = '$restore_id'") or die('query failed');

     date_default_timezone_set("asia/manila");
 $time = date("Y/m/d H:i:s",strtotime("+0 HOURS"));

  $row_audit = mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '$delete_id'") or die('query failed');
   $row_result = mysqli_fetch_assoc($row_audit); 

   $audit_name = $row_result['name'];
   $audit_price = $row_result['price'];
   $audit_quantity = $row_result['quantity'];


 $restore_product_trail = mysqli_query($conn, "INSERT INTO `audit_trail`(timedate ,employeename, name, action, description) VALUES('$time' ,'$admin_name', ' Restored the product named ', '$audit_name', 'with a price value of $audit_price pesos and quantity of $audit_quantity')") or die('query failed');


   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_quantity = $_POST['update_quantity'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', quantity = '$update_quantity' WHERE id = '$update_p_id'") or die('query failed');

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
   <title>Admin Products Inventory</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->





<section class="add-products">

   <h1 class="title">Product Audit Trail</h1>

</section>


<section>
   <!--<h1 class="title">Menu</h1>-->

   <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `audit_trail`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
   ?>
<table class="table">
 <tr class="tr">
 <th class="th">Time</th>
 <th class="th">Employee Name</th>
 <th class="th">Action</th>
 <th class="th">Item Name</th>
 <th class="th">Description</th>
 </tr>
      <?php
            
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
  <tr class="tr">
 <td class="td"><?php echo $fetch_products['timedate']; ?></td>
 <td class="td"><?php echo $fetch_products['employeename']; ?></td>
 <td class="td"><?php echo $fetch_products['name']; ?></td>
 <td class="td"><?php echo $fetch_products['action']; ?></td>
 <td class="td"><?php echo $fetch_products['description']; ?></td>

      <?php
          
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


















<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">

      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">



      <input type="number" name="update_quantity" value="<?php echo $fetch_update['quantity']; ?>" min="0" class="box" required placeholder="enter product quantity">



      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">

      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>
   
   
   

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>