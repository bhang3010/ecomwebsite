<?php
session_start();
require('db/conn.php'); // Kết nối đến database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Truy vấn để lấy thông tin người dùng từ database
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'"; 
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Đăng nhập thành công
        $_SESSION['user_id'] = $user['id'];
        // Chuyển hướng đến trang chủ hoặc trang người dùng
        header('Location: index.php'); // Thay đổi đường dẫn nếu cần
        exit();
    } else {
        $error = "Email hoặc mật khẩu không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chào mừng bạn đến với ORGANI!</title>
  
  <!-- Google Fonts: Quicksand và Nunito -->
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      flex-direction: column;
      margin: 0;
    }

    .login-form {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 400px;
      padding: 20px;
      text-align: center;
    }

    .header {
      background: #007bff;
      color: #fff;
      padding: 20px 0;
      border-radius: 8px 8px 0 0;
      margin-bottom: 20px;
    }

    .header h3 {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      font-weight: 600;
      font-size: 1.5em;
    }

    .body {
      padding: 20px;
    }

    .form-control {
      width: 100%;
      padding: 14px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
      font-family: 'Quicksand', sans-serif;
      box-sizing: border-box;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      border-color: #007bff;
      outline: none;
    }

    .btn {
      background-color: #007bff;
      color: white;
      padding: 14px 20px;
      margin: 10px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 4px;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #0056b3;
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
      transition: color 0.3s;
    }

    a:hover {
      color: #0056b3;
    }

    .text-center {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="login-form">
    <div class="header">
      <h3>Chào mừng bạn đến với ORGANI!</h3>
    </div>
    <div class="body">
      <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
      <form method="post" action="loginfe.php">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div>
          <label for="password">Mật khẩu:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn">Đăng nhập</button>
      </form>
      <div class="text-center">
        <a href="signupfe.php">Tạo tài khoản!</a>
      </div>
    </div>
  </div>
</body>

</html>
