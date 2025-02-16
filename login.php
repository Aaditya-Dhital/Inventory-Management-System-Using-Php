<?php
//Basic login page
session_start();
include 'db.php';
$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
       font-family: 'Poppins', sans-serif;
       background: linear-gradient(135deg, #667eea, #764ba2);
       display: flex;
       justify-content: center;
       align-items: center;
       height: 100vh;
       margin: 0;
    }
    .login-container {
       background: #fff;
       padding: 40px;
       border-radius: 15px;
       box-shadow: 0 8px 16px rgba(0,0,0,0.2);
       width: 350px;
       text-align: center;
    }
    h2 {
       margin-bottom: 20px;
       color: #333;
    }
    input {
       width: 100%;
       padding: 12px 15px;
       margin: 10px 0;
       border: 1px solid #ccc;
       border-radius: 30px;
       outline: none;
       font-size: 1rem;
    }
    input[type="submit"] {
       background: #667eea;
       color: #fff;
       border: none;
       cursor: pointer;
       transition: background 0.3s ease;
    }
    input[type="submit"]:hover {
       background: #556cd6;
    }
    .error {
       color: red;
       margin-bottom: 10px;
    }
  </style>
  <script>
    function validateLogin() {
       var username = document.forms["loginForm"]["username"].value;
       var password = document.forms["loginForm"]["password"].value;
       if (username == "" || password == "") {
         alert("Both fields are required!");
         return false;
       }
       return true;
    }
  </script>
</head>
<body>
   <div class="login-container">
      <h2>Login</h2>
      <?php if ($error != "") { echo "<p class='error'>$error</p>"; } ?>
      <form name="loginForm" method="post" onsubmit="return validateLogin();">
         <input type="text" name="username" placeholder="Username" required>
         <input type="password" name="password" placeholder="Password" required>
         <input type="submit" name="login" value="Login">
      </form>
   </div>
</body>
</html>
