<?php
//Page to edit an existing product
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$product = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    mysqli_query($conn, "UPDATE products SET name='$name', description='$description', price='$price', quantity='$quantity' WHERE id='$id'") or die("Error");
    
    $_SESSION['message'] = "Product updated.";
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Edit Product</title>
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
         background: #2196F3;
         color: #fff;
         border: none;
         padding: 12px;
         border-radius: 30px;
         cursor: pointer;
         transition: background 0.3s;
      }
      input[type="submit"]:hover {
         background: #1976D2;
      }
      a {
         text-decoration: none;
         text-align: center;
         display: block;
         margin-top: 20px;
         color: #2196F3;
      }
   </style>
</head>
<body>
   <div class="container">
      <h2>Edit Product</h2>
      <form method="post">
         <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
         <textarea name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
         <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
         <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
         <input type="submit" name="update" value="Update Product">
      </form>
      <a href="index.php">Back to Home</a>
   </div>
</body>
</html>