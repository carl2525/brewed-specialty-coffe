<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_SESSION['user_name']);
   $email = mysqli_real_escape_string($conn, $_SESSION['user_email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message sent successfully!!! proceed to messages and wait for the feedback';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">Home</a> / Contact </p>
</div>

<section class="home-contact">

   <div class="content">
      <h3>Want to customize your drinks?</h3>
      <p>Just tell us we would try to make it. :)</p>
      <h3>Any concern?</h3>
      <p>Just tell us. :)</p>
   </div>

</section>



	

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
     <div class="flex">
      <div class="inputBox">
       	<span>Name :</span>
       	<p> <span><?php echo $_SESSION['user_name']; ?></span></p>
      </div>
      <div class="inputBox">
       <span>Email :</span>
       <p> <span><?php echo $_SESSION['user_email']; ?></span></p>
      </div>

    
      <input type="number" name="number" required placeholder="Enter your phone number" class="box">


      <textarea name="message" class="box" placeholder="Enter your message" id="" cols="30" rows="10"></textarea>



	</div>
      <input type="submit" value="send message" name="send" class="btn">
     
   </form>

</section>


<section class="home-contact">

   <div class="content">
   
      <h3>For bulk orders?</h3>
      <p>Please Send this to us : Your order/s, address block no. lot no. street. subdivision, barangay, ( City only Cainta, Taytay, Pasig, and Pateros City ) and landmarks (e.g green gate).</p>
	  <p>Then wait for our call. Thank you</p>
 </div>
 
 <button onclick="topFunction()" id="up" title="Go to top"><i class='fas fa-angle-up'></i></button>




</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>