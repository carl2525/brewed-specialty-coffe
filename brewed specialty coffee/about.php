<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:loginuser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   
   <link rel="icon" href="images/name.png" type="image/icon type">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>





<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>Brewed Specialty Coffee</h3>
         <p>Coffee Shop</p>
         <p>We are a third wave Coffee Shop Serving farm to cupbeans from local farmers, Locally, Ethically source, community cafe and neighborhood cafe.</p>
         <p><i class="fas fa-map-marker-alt"></i> Located at The Red Dot, C. Raymundo Avenue, Rosario Pasig City, Pasig, Philippines, 1607 </p>
         <p>Only can deliver on Selected area (Pateros City, Taytay Rizal, Cainta Rizal, and Pasig City)</p>
      </div>

   </div>

</section>




<section class="reviews">

   <h1 class="title">Customer's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/trixiegorg.jpg" alt="">
         <p>The ambiance was astonishing, relaxing and sooo soothing. Considering its expensive price I definitely love the food quality. Plus the coffees were refreshing and a must have. The meals were delicious and fulfilling, I also did not expect to be treated well by the humble staffs. ♥️ We enjoyed as a couple and we'll surely pay a visit again.</p>
         <h3>Trixie Gorg</h3>
      </div>

      <div class="box">
         <img src="images/sheena.jpg" alt="">
         <p>spanish latte was good. huge serving of the Truffle mushroom pasta, all day breakfast tapa and gorned beef. very cozy and relaxing cafe. went on a weekday for brunch - not crowded 👌
Best brunch·Cosy atmosphere·Good for working·Relaxing atmosphere·Great breakfast·Best iced coffee</p>
         <h3>Shee Na</h3>
      </div>

      <div class="box">
         <img src="images/cherrymanebuling.jpg" alt="">
         <p>highly recommended for me. staff are so kind and polite plus napaka maalaga pa to lessen the shot of coffee for my pamangkin since may coffee yung order niya (peppermint frappe) . the pasta itself (creamy mushroom) is 10/10 . the ambiance of the place is very relaxing specially night time kme pumunta. 😍🤎�?/p>
         <h3>Cherry Mae Buling</h3>
      </div>

      <div class="box">
         <img src="images/wellaocampo.jpg" alt="">
         <p>What do I recommend about Brewed Specialty Coffee? It's a pet-friendly coffee shop, where a lot of furparents will surely love, plus a free pup-uccino for my furbaby. Thank you! We will surely come back!</p>
         <h3>Well Ocampo Pagulayan</h3>
      </div>

      <div class="box">
         <img src="images/caseyreyes.jpg" alt="">
         <p>Coffee is really good 😊 The staff also adheres to strict dine-in protocol which is a must. This cafe is a must try and will definitely go back for more coffee cravings. good for the price.</p>
         <h3>Casie Reyes</h3>
      </div>

      <div class="box">
         <img src="images/marareal.jpg" alt="">
         <p>Went here last night and I commend the service of the crews. 💞 Will def reco this coffee shop and will come back. The ambiance and food are great also. Convenient location·Cosy atmosphere</p>
         <h3>Mara Alyana Real</h3>
      </div>

   </div>
   
   

</section>

<section class="owners">

   <h1 class="title">Owners</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/owner1.jpg" alt="">
         <h3>Ralf Dominique Sto. Domingo </h3>
      </div>

      <div class="box">
         <img src="images/owner2.jpg" alt="">
         <h3>Pennie Rose Anne Maurillo-Sto. Domingo </h3>
      </div>


   </div>
   
   <button onclick="topFunction()" id="up" title="Go to top"><i class='fas fa-angle-up'></i></button>



</section>







<?php include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>