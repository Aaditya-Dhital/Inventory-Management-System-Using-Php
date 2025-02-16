<?php
// db.php - Basic database connection and setup

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "inventory_db";

// Connect to MySQL (without selecting a database)
$conn = mysqli_connect($host, $user, $pass) or die("Error connecting to MySQL");

// Create the database if it doesn't exist
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $dbname") or die("Error creating database");

// Select the database
mysqli_select_db($conn, $dbname);

// Create the products table if it doesn't exist
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
)") or die("Error creating products table");

// Create the users table if it doesn't exist
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
)") or die("Error creating users table");

// Insert default user if do not exists
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='User001'");
if (mysqli_num_rows($result) == 0) {
    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('User001', '12qwaszx')");
}
?>
