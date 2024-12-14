<?php
session_start();
require_once('db/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Lấy thông tin sản phẩm
    $sql = "SELECT id, name, discounted_price FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Lưu sản phẩm vào giỏ hàng
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $found = false;
    foreach ($cart as &$item) {
        if ($item['id'] == $productId) {
            $item['qty'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $cart[] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'disscounted_price' => $product['discounted_price'],
            'qty' => $quantity
        ];
    }

    $_SESSION['cart'] = $cart;

    header("Location: cart.php");
}
?>
