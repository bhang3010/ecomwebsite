<?php
// Kết nối cơ sở dữ liệu
require_once('db/conn.php');

// Kiểm tra xem có tham số order_id trong URL không
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Lấy thông tin đơn hàng từ bảng orders
    $sql_order = "SELECT * FROM orders WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_order);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result_order = mysqli_stmt_get_result($stmt);

    // Kiểm tra xem đơn hàng có tồn tại không
    if (mysqli_num_rows($result_order) > 0) {
        $order = mysqli_fetch_assoc($result_order);
        echo "<h3>Thông tin đơn hàng #{$order['id']}</h3>";
        echo "<p>Họ tên: {$order['firstname']} {$order['lastname']}</p>";
        echo "<p>Địa chỉ: {$order['address']}</p>";
        echo "<p>Số điện thoại: {$order['phone']}</p>";
        echo "<p>Email: {$order['email']}</p>";
        echo "<p>Trạng thái: {$order['status']}</p>";

        // Lấy chi tiết các sản phẩm trong đơn hàng
        $sql_details = "SELECT * FROM order_details WHERE order_id = ?";
        $stmt_details = mysqli_prepare($conn, $sql_details);
        mysqli_stmt_bind_param($stmt_details, "i", $order_id);
        mysqli_stmt_execute($stmt_details);
        $result_details = mysqli_stmt_get_result($stmt_details);

        if (mysqli_num_rows($result_details) > 0) {
            echo "<h4>Chi tiết sản phẩm:</h4>";
            echo "<table border='1'>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result_details)) {
                echo "<tr>
                        <td>{$row['product_id']}</td>
                        <td>" . number_format($row['price'], 0, '', '.') . " VNĐ</td>
                        <td>{$row['quantity']}</td>
                        <td>" . number_format($row['total'], 0, '', '.') . " VNĐ</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Không có sản phẩm trong đơn hàng này.</p>";
        }
    } else {
        echo "<p>Không tìm thấy đơn hàng.</p>";
    }

    // Đóng statement
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt_details);
} else {
    echo "<p>Không có thông tin đơn hàng.</p>";
}

// Đóng kết nối
mysqli_close($conn);
?>
