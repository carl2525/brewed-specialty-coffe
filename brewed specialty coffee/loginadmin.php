<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['pass']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
   $row = mysqli_fetch_array($select_users);

   if(mysqli_num_rows($select_users) > 0){

      
      if($row['user_type'] == 'admin' || 'super admin'){
        
         if($row["status"] == 0){
            $_SESSION['admin_email'] = $row['email'];
            
            ?>
            <script>

               alert("Please verify email account before login.");
              window.location.replace('verificationadmin.php');
            </script>
            <?php
         }else{

         if(password_verify($pass, $row['password']))  
            {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            header('location:admin_page.php');          
         }
   
         else{
               ?>
            <script>
               alert("Wrong ");
            </script>
            <?php
         }
      }
      }elseif($row['user_type'] == 'employee'){
         
         if($row["status"] == 0){
            
            ?>
            <script>
               alert("Please verify email account before login.");
            </script>
            <?php
         }else{
            
            $_SESSION['employee_name'] = $row['name'];
            $_SESSION['employee_email'] = $row['email'];
            $_SESSION['employee_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            header('location:employee_page.php');
         }
      }

   }else{
      $message[] = 'Incorrect email or Password!';
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="adminlogin">
      

   
<div class="form-container">

   <form action="loginadmin.php" method="post">
      <h3>login admin</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="pass" placeholder="Enter your password" required class="box">

	

      <input type="submit" name="submit" value="Login now" class="btn">


<br><br> 

	<div class="link forget-pass text-left"><a href="recover_pswadmin.php">Forgot password?</a></div>

   </form>

</div>
</div>

</body>
</html>