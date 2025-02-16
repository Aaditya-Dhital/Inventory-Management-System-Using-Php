<?php
//Page to add a new product
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    mysqli_query($conn, "INSERT INTO products (name, description, price, quantity)
        VALUES ('$name', '$description', '$price', '$quantity')") or die("Error");
    
    $_SESSION['message'] = "Product added.";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Add Product</title>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
      body {
         font-family: 'Poppins', sans-serif;
         background: #f7f7f7;
         margin: 0;
      }
      .container {
         max-width: 500px;
         margin: 40px auto;
         background: #fff;
         padding: 30px;
         border-radius: 15px;
         box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      }
      h2 {
         text-align: center;
         color: #333;
         margin-bottom: 20px;
      }
      form {
         display: flex;
         flex-direction: column;
      }
      input, textarea {
         padding: 12px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 30px;
         font-size: 1rem;
         outline: none;
      }
      input[type="submit"] {
         background: #667eea;
         color: #fff;
         border: none;
         padding: 12px;
         border-radius: 30px;
         cursor: pointer;
         transition: background 0.3s;
      }
      input[type="submit"]:hover {
         background: #556cd6;
      }
      a {
         text-decoration: none;
         text-align: center;
         display: block;
         margin-top: 20px;
         color: #667eea;
      }
   </style>
</head>
<body>
   <div class="container">
      <h2>Add Product</h2>
      <form method="post">
         <input type="text" name="name" placeholder="Product Name" required>
         <textarea name="description" placeholder="Description"></textarea>
         <input type="number" step="0.01" name="price" placeholder="Price (Rs.)" required>
         <input type="number" name="quantity" placeholder="Quantity" required>
         <input type="submit" name="add" value="Add Product">
      </form>
      <a href="index.php">Back to Home</a>
   </div>
</body>
</html>
