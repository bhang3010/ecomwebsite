<?php
session_start();
require_once('./db/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method']; 

    // Lấy thông tin giỏ hàng
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : []; 

    // Tạo dữ liệu cho order
    $sqli = "INSERT INTO orders (user_id, firstname, lastname, address, phone, email, status, created_at, updated_at) 
             VALUES (0, '$firstname', '$lastname', '$address', '$phone', '$email', 'Processing', NOW(), NOW())";

    if (mysqli_query($conn, $sqli)) {
        $last_order_id = mysqli_insert_id($conn);

        // Thêm vào order details
        foreach ($cart as $item) {
            $masp = $item['id'];
            $disscounted_price = $item['disscounted_price'];
            $qty = $item['qty'];
            $total = $item['qty'] * $item['disscounted_price'];
            $sqli2 = "INSERT INTO order_details (order_id, product_id, price, qty, total, created_at, updated_at) 
                      VALUES ($last_order_id, $masp, $disscounted_price, $qty, $total, NOW(), NOW())";
            mysqli_query($conn, $sqli2);
        }

        // Xóa cart
        unset($_SESSION["cart"]);

        // Chuyển hướng theo phương thức thanh toán
        if ($payment_method == 'cod') {
            header("Location: thankyou.php");
        } elseif ($payment_method == 'transfer') {
            header("Location: transfer.php");
        } 
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>