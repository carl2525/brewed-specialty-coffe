<?php session_start(); ?>
<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
   $user_type = $_POST['user_type'];



   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
	
	$password_hash =password_hash($_POST['cpassword'], PASSWORD_DEFAULT, array('cost' => 12));

          $result = mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, status) VALUES('$name', '$email','$password_hash', '$user_type', 0)") or die('query failed');

	if($result){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='njmirador31@gmail.com';
                    $mail->Password='bciglyewpbcdojbs';
    
                    $mail->setFrom('njmirador31@gmail.com', 'OTP Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $url="https://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]). "/loginuser.php";
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                    You can access the login link via this link. <br>
                    <a href='$url'>$url</a>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Brewed Specialty Coffee</b>
                    ";

                    $query = mysqli_query($conn, "INSERT INTO otpcode(id, email, code) VALUES (0, '$email','$otp')");
                    
    
                            if(!$mail->send()){
                                ?>
                                    <script>
                                        alert("<?php echo "Register Failed, Invalid Email "?>");
                                    </script>
                                <?php
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $email ?>");
                                    window.location.replace('loginuser.php');
                                </script>
                                <?php
                            }
                }

         
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
   <title>register</title>
   
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

<div class="userregister">

   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter your name" onkeydown="return /[a-zA-Z]/i.test(event.key)" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">

      
      <select name="user_type" class="box" style="display:none">
   <option value="user">User</option>
</select>

      <input type="submit" name="submit" value="Register now" class="btn">
      <p>Already have an account? <a href="loginuser.php">Login now</a></p>
   </form>

</div>
</div>

</body>
</html>

