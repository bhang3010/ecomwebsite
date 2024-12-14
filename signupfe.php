<?php
session_start();
require('db/conn.php'); // Kết nối đến database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

  // Truy vấn để thêm người dùng vào database
  $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

  if (mysqli_query($conn, $sql)) {
    // Tạo tài khoản thành công
    // Chuyển hướng đến trang đăng nhập
    header('Location: loginfe.php');
    exit();
  } else {
    $error = "Lỗi: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tạo tài khoản</title>
  
  <!-- Google Fonts: Quicksand và Nunito -->
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    /* Reset CSS cho trang */
    body, h1, h2, h3, h4, h5, h6, p, input, button, a {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Quicksand', sans-serif;
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      flex-direction: column;
    }

    /* Form Đăng ký */
    .signup-form {
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 100%;
      max-width: 420px;
      padding: 30px;
    }

    /* Header */
    .header {
      background: #007bff;
      color: white;
      padding: 20px 0;
      border-radius: 8px 8px 0 0;
      text-align: center;
    }

    .header h2 {
      font-family: 'Nunito', sans-serif;
      font-weight: 600;
      font-size: 1.8em;
    }

    /* Nội dung */
    .body {
      padding: 20px 0;
    }

    .form-control {
      width: 100%;
      padding: 14px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      font-family: 'Quicksand', sans-serif;
      box-sizing: border-box;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
      outline: none;
    }

    .btn {
      background-color: #007bff;
      color: white;
      padding: 14px 20px;
      margin: 20px 0;
      border: none;
      border-radius: 5px;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }

    .alert {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-danger {
      color: #a94442;
      background-color: #f2dede;
      border-color: #ebccd1;
    }

    a {
      color: #007bff;
      font-size: 14px;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #0056b3;
    }

    .text-center {
      margin-top: 15px;
      font-size: 14px;
    }

    .text-center a {
      font-weight: 400;
    }
  </style>
</head>

<body>
  <div class="signup-form">
    <div class="header">
      <h2>Tạo tài khoản</h2>
    </div>
    <div class="body">
      <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
      <form method="post" action="signupfe.php">
        <div>
          <label for="name">Họ và tên:</label>
          <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div>
          <label for="password">Mật khẩu:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn">Tạo tài khoản</button>
      </form>
      <div class="text-center">
        <a href="loginfe.php">Đã có tài khoản? Đăng nhập!</a>
      </div>
    </div>
  </div>
</body>

</html>
