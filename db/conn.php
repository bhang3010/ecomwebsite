<?php
$host = "localhost"; // Nếu MySQL đang chạy trên máy local
$user = "root";      // Tên người dùng MySQL
$password = "";      // Mật khẩu (thường là rỗng nếu dùng XAMPP)
$dbname = "ecommerceshop"; // Tên cơ sở dữ liệu bạn đang sử dụng

$conn = mysqli_connect($host, $user, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>