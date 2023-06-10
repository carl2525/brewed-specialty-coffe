<?php

include 'config.php';

session_start();

$employee_id = $_SESSION['employee_id'];

if(!isset($employee_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:employee_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee Accounts</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'employee_header.php'; ?>

<section class="orders">

<div class="box-container" >
<div class="box" style="font-size: 18px;">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <p>User accounts :</p>
         <h3><?php echo $number_of_users; ?></h3>
         
      </div>

      <div class="box" style="font-size: 18px;">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <p>Admin Accounts :</p>
         <h3><?php echo $number_of_admins; ?></h3>
        
      </div>

 <div class="box" style="font-size: 18px;">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'employee'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <p>Employee Accounts :</p>
         <h3><?php echo $number_of_admins; ?></h3>
        
      </div>

</section>

<!--<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> User id : <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> Username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> User type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--red)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
      <?php
         };
      ?>
   </div>

</section> -->


<section>
   <h1 class="title">Accounts</h1>
<?php
$select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
?>
<table class="table">
    <tr class="tr">
        <th class="th">User Id</th>
        <th class="th">User Name</th>
        <th class="th">Email</th>
        <th class="th">User Type</th>
    </tr>
    <?php while($fetch_users = mysqli_fetch_assoc($select_users)){ ?>
    <tr class="tr">
        <td class="td"> <?php echo $fetch_users['id']; ?> </td>
        <td class="td"> <?php echo $fetch_users['name']; ?> </td>
        <td class="td"> <?php echo $fetch_users['email']; ?> </td>
        <td class="td"> <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--red)'; } ?>"><?php echo $fetch_users['user_type']; ?></span>
            
        </td>
    </tr>
    <?php } ?>
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