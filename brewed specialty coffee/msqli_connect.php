<?php
$servername = "localhost";
$username = "id19921209_brewed";
$password = "BrewedSpecialtyCoffeeShop.08";
$database = "id19921209_shop_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "";

?>