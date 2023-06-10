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

<!--<header class="header">

   <div class="flex">

      <a href="employee_page.php" class="logo">Employee<span></span></a>

      <nav class="navbar">
         <a href="employee_page.php">Home</a>
         <a href="employee_orders.php">Orders</a>
         <a href="employee_cancelled.php">Cancelled</a>
         <a href="employee_completed.php">Completed</a>

         
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['employee_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['employee_email']; ?></span></p>
         <a href="logoutemployee.php" class="delete-btn">Logout</a>
          <div>new <a href="loginadmin.php">login</a> | <a href="registeradmin.php">register</a></div> 
      </div>

   </div>

</header> -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<header class="header">

<input type="checkbox" id="check">
<!--<label for="check">
<i class="fas fa-bars" id="btn"></i>
<i class="fas fa-times" id="cancel"></i>
</label> -->
<div class="sidebar">
	<h2> Brewed Employee  </h2>
	<ul>
	<li>  <a href="employee_page.php"> <i class="fas fa-qrcode"></i>Dashboard</a></li>
	<li>  <a href="employee_products.php"> <i class='fas fa-box-open'></i>Product Inventory</a></li>
	<!--<li>  <a href="employee_orders.php"> <i class="fas fa-shopping-cart"></i>Orders</a></li>-->
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Orders
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
		<li>  <a href="employee_orders.php"> Placed Orders</a></li>
		<li>  <a href="employee_completed.php"> <i class=""></i>Completed</a></li>
		<li>  <a href="employee_cancelled.php"> <i class="fa-solid fa-cart-circle-xmark"></i>Cancelled</a></li>
	</div>
	
	
	
	<!--<li>  <a href="employee_cancelled.php"> <i class="fa-solid fa-cart-circle-xmark"></i>Cancelled</a></li>
	<li>  <a href="employee_completed.php"> <i class=""></i>Complete</a></li>-->
	
	<li>  <a href="employee_best.php"> <i class=""></i>Best Seller</a></li>
	<li>  <a href="employee_contacts.php"> <i class="fa fa-envelope-o"></i>Messages</a></li>
	<li>  <a href="employee_users.php"> <i class='fa fa-user-circle'></i>Accounts</a></li>
	
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Walk In
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
	<li>  <a href="employee_walkin.php"> <i class=""></i>Take Orders</a></li>
	<li>  <a href="employee_walkin_orders.php"> <i class=""></i>Walk In Orders</a></li>
	<li>  <a href="employee_walkin_completed.php"> <i class=""></i>Completed </a></li>
	</div>
	</ul>
	
	      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['employee_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['employee_email']; ?></span></p>
         <a href="logoutadmin.php" class="delete-btn">Logout</a>
         <!-- <div>new <a href="loginadmin.php">login</a> | <a href="registeradmin.php">register</a></div> -->
      </div>

</div>


</header>

<script>
	var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

</script>