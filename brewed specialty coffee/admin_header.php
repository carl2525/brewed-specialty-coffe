<?php
$user_type = $_SESSION['user_type'];

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


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<header class="header">

  <!-- <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
        <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_cancelled.php">Cancelled</a>
         <a href="admin_completed.php">Completed</a>
          <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
	 <a href="admin_best.php">Best Seller</a>
         <a href="walkin.php">Walk In</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logoutadmin.php" class="delete-btn">Logout</a>
         <div>new <a href="loginadmin.php">login</a> | <a href="registeradmin.php">register</a></div>
      </div>

   </div>-->

<input type="checkbox" id="check">
<!--<label for="check">
<i class="fas fa-bars" id="btn"></i>
<i class="fas fa-times" id="cancel"></i>
</label>-->
<div class="sidebar">
	<h2> Brewed Admin </h2>
	<ul>
	<li>  <a href="admin_page.php"> <i class="fas fa-qrcode"></i>Dashboard</a></li>
		<button class="dropdown-btn"><i class="fas fa-box-open"></i> Inventory
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
		<li><a href="admin_products.php">Product Inventory</a></li>
		<li><a href="admin_archive_products.php">Archive</a></li>
    <li><a href="admin_product_trail.php">Product Trail</a></li>
	</div>
	
	
	<!--<li>  <a href="admin_orders.php"> <i class="fas fa-shopping-cart"></i>Orders</a></li>
	<li>  <a href="admin_cancelled.php"> <i class="fa-solid fa-cart-circle-xmark"></i>Cancelled</a></li>
	<li>  <a href="admin_completed.php"> <i class=""></i>Complete</a></li>-->
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Orders
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
		<li><a href="admin_orders.php">Placed Orders</a></li>
		<li><a href="admin_completed.php">Completed</a></li>
		<li><a href="admin_cancelled.php">Cancelled</a></li>
	</div>
	
	
	<li>  <a href="admin_best.php"> <i class=""></i>Best Seller</a></li>
	<li>  <a href="admin_contacts.php"> <i class="fa fa-envelope-o"></i>Messages</a></li>

	<button class="dropdown-btn"><i class="fas fa-user-circle"></i> Accounts
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
		<li><a href="admin_users.php">Accounts</a></li>
		<li><a href="admin_archive_users.php">Archive Accounts</a></li>
    <li><a href="registeradmin.php">Create Account</a></li>
	</div>
	
	
	<button class="dropdown-btn"><i class="fas fa-shopping-cart"></i> Walk In
		<i class="fa fa-caret-down"></i>
    </button>
	<div class="dropdown-container">
	<li>  <a href="admin_walkin.php"> <i class=""></i>Take Orders</a></li>
	<li>  <a href="admin_walkin_orders.php"> <i class=""></i>Walk In Orders</a></li>
	<li>  <a href="admin_walkin_completed.php"> <i class=""></i>Completed </a></li>
	</div>
	
	
	</ul>
	
	      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logoutadmin.php" class="delete-btn">Logout</a>
         <!-- <div>new <a href="loginadmin.php">login</a> | <a href="registeradmin.php">register</a></div> -->
      </div>

</div>


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


</header>






