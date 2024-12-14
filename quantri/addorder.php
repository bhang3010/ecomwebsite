<?php 
require('includes/header.php');
require('../db/conn.php');

// Xử lý thêm đơn hàng khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin khách hàng
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Thêm thông tin đơn hàng vào bảng orders
    $sql_order = "INSERT INTO orders (firstname, lastname, address, phone, email) 
                  VALUES ('$firstname', '$lastname', '$address', '$phone', '$email')";

    if (mysqli_query($conn, $sql_order)) {
        $order_id = mysqli_insert_id($conn); // Lấy ID của đơn hàng vừa thêm

        // Lấy thông tin sản phẩm và số lượng
        $product_ids = $_POST['product_id'];
        $qtys = $_POST['qty'];

        // Thêm chi tiết đơn hàng vào bảng order_details
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $qty = $qtys[$i];

            // Lấy giá sản phẩm từ database (hoặc từ nguồn dữ liệu khác)
            $sql_price = "SELECT price FROM products WHERE id = $product_id";
            $result_price = mysqli_query($conn, $sql_price);
            $row_price = mysqli_fetch_assoc($result_price);
            $price = $row_price['price'];

            $total = $price * $qty;

            $sql_detail = "INSERT INTO order_details (order_id, product_id, price, qty, total) 
                           VALUES ($order_id, $product_id, $price, $qty, $total)";
            mysqli_query($conn, $sql_detail); 
        }

        echo "Thêm đơn hàng thành công!";
        // Chuyển hướng đến trang danh sách đơn hàng
        header("Location: orders.php"); // Thay orders.php bằng trang danh sách đơn hàng của bạn
        exit();
    } else {
        echo "Lỗi: " . $sql_order . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container">
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Thêm mới đơn hàng</h1>
                    </div>
                    <form class="user" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                        <div class="form-group">
                            <label for="firstname">Họ:</label>
                            <input type="text" class="form-control form-control-user" id="firstname" name="firstname" placeholder="Nhập họ" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Tên:</label>
                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" placeholder="Nhập tên" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ:</label>
                            <textarea class="form-control form-control-user" id="address" name="address" placeholder="Nhập địa chỉ" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Nhập email" required>
                        </div>

                        <h2>Chọn sản phẩm</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Lấy danh sách sản phẩm từ database
                                $sql_products = "SELECT * FROM products";
                                $result_products = mysqli_query($conn, $sql_products);
                                while ($row_product = mysqli_fetch_assoc($result_products)) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="product_id[]" value="<?php echo $row_product['id']; ?>">
                                        <?php echo $row_product['name']; ?>
                                    </td>
                                    <td><?php echo $row_product['price']; ?></td>
                                    <td>
                                        <input type="number" name="qty[]" value="0" min="0">
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require('includes/footer.php');
mysqli_close($conn); 
?>