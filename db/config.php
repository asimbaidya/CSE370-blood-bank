<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "bloodbank";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "<h1>DB connected!</h1>\n";
}
