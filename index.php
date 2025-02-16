<?php
//Main page to list products
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$message = "";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
   <title>Inventory Management - Home</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
   <style>
       body {
          font-family: 'Poppins', sans-serif;
          background: #f7f7f7;
          margin: 0;
       }
       .container {
          max-width: 900px;
          margin: 40px auto;
          background: #fff;
          padding: 20px;
          border-radius: 15px;
          box-shadow: 0 8px 16px rgba(0,0,0,0.1);
       }
       h2 {
          text-align: center;
          color: #333;
          margin-bottom: 20px;
       }
       .top-nav {
          text-align: center;
          margin-bottom: 20px;
       }
       .top-nav a {
          margin: 0 15px;
          text-decoration: none;
          color: #667eea;
          font-weight: 500;
       }
       .message {
          padding: 12px;
          background: #d4edda;
          color: #155724;
          border-radius: 10px;
          text-align: center;
          margin-bottom: 20px;
       }
       table {
          width: 100%;
          border-collapse: collapse;
       }
       th, td {
          border: 1px solid #ddd;
          padding: 12px;
          text-align: left;
       }
       th {
          background: #667eea;
          color: #fff;
       }
       tr:nth-child(even) {
          background: #f2f2f2;
       }
       .actions a {
          text-decoration: none;
          padding: 8px 12px;
          border-radius: 30px;
          font-size: 0.9rem;
          color: #fff;
          margin-right: 5px;
       }
       .actions a.edit {
          background: #2196F3;
       }
       .actions a.delete {
          background: #f44336;
       }
   </style>
</head>
<body>
   <div class="container">
       <h2>Inventory Management</h2>
       <div class="top-nav">
           <a href="add.php">Add Product</a> |
           <a href="logout.php">Logout</a>
       </div>
       <?php if ($message != "") { echo "<div class='message'>$message</div>"; } ?>
       <table>
          <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Description</th>
             <th>Price (Rs.)</th>
             <th>Quantity</th>
             <th>Actions</th>
          </tr>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
             <td><?php echo $row['id']; ?></td>
             <td><?php echo htmlspecialchars($row['name']); ?></td>
             <td><?php echo htmlspecialchars($row['description']); ?></td>
             <td><?php echo number_format($row['price'],2); ?></td>
             <td><?php echo $row['quantity']; ?></td>
             <td class="actions">
                <a class="edit" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?');">Delete</a>
             </td>
          </tr>
          <?php endwhile; ?>
       </table>
   </div>
</body>
</html>
