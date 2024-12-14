<?php
require_once('components/header.php');
require_once('./db/conn.php'); // Đảm bảo tệp kết nối đúng

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method']; // Phương thức thanh toán: COD hoặc TRANSFER
    $user_id = $_SESSION['user_id']; // Lấy ID người dùng từ session (giả sử người dùng đã đăng nhập)

    // Thêm thông tin đơn hàng vào bảng `orders`
    $sql = "INSERT INTO orders (user_id, firstname, lastname, address, phone, email, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, 'Processing', NOW())";
    
    // Chuẩn bị câu lệnh
    $stmt = mysqli_prepare($conn, $sql);

    // Kiểm tra nếu câu lệnh đã được chuẩn bị thành công
    if (!$stmt) {
        echo "Error preparing statement: " . mysqli_error($conn);
        exit;
    }

    // Gắn kết các tham số vào câu lệnh chuẩn
    // 'i' cho user_id (kiểu integer), 's' cho các trường string (firstname, lastname, address, phone, email)
    mysqli_stmt_bind_param($stmt, 'isssss', $user_id, $firstname, $lastname, $address, $phone, $email);
    
    // Thực thi câu lệnh
    if (mysqli_stmt_execute($stmt)) {
        $order_id = mysqli_insert_id($conn); // Lấy ID của đơn hàng vừa tạo

        // Thêm chi tiết đơn hàng vào bảng `order_details`
        foreach ($_SESSION['cart'] as $item) {
            $sql_details = "INSERT INTO order_details (order_id, product_id, price, qty, total, payment_method, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt_details = mysqli_prepare($conn, $sql_details);

            // Kiểm tra nếu câu lệnh `order_details` đã được chuẩn bị thành công
            if (!$stmt_details) {
                echo "Error preparing statement: " . mysqli_error($conn);
                exit;
            }

            // Gắn kết các tham số vào câu lệnh chuẩn
            mysqli_stmt_bind_param($stmt_details, "iiidds", $order_id, $item['id'], $item['disscounted_price'], $item['qty'], ($item['disscounted_price'] * $item['qty']), $payment_method);

            // Thực thi câu lệnh `order_details`
            mysqli_stmt_execute($stmt_details);
        }

        // Dọn dẹp giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);

        // Chuyển hướng theo phương thức thanh toán
        if ($payment_method == 'COD') {
            header("Location: thankyou.php"); // Thanh toán khi nhận hàng
            exit;
        } else if ($payment_method == 'TRANSFER') {
            header("Location: transfer.php"); // Thanh toán qua chuyển khoản
        exit;
        }
    } else {
        echo "Error executing statement: " . mysqli_error($conn);
    }
}

?>
<!-- Breadcrumb Section Begin -->
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Quicksand', sans-serif; /* Sử dụng font Quicksand cho body */
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif; /* Sử dụng font Nunito cho các heading */
  }
    </style>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Thông tin Khách hàng</h4>
            <form action="#" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ & tên lót<span>*</span></p>
                                    <input type="text" name='firstname'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name='lastname'>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Địa chỉ nhận hàng:<span>*</span></p>
                            <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address">
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại:<span>*</span></p>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email:<span>*</span></p>
                                    <input type="text" name="email">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                            <ul>
                                <?php
                                $cart = [];
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                }
                                // var_dump($cart);die();
                                $count = 0; //số thứ tự
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['qty'] * $item['disscounted_price'];
                                    ?>
                                    <li>
                                        <?= $item['name'] ?> <span>
                                            <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                        </span>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="checkout__order__total">Tổng tiền: <span>
                                    <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                                </span></div>
                                <div class="form-group">
                            <label for="payment_method">Phương thức thanh toán</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="COD">Thanh toán khi nhận hàng</option>
                                <option value="TRANSFER">Chuyển khoản ngân hàng</option>
                            </select>
                        </div>


                            <button type="submit" class="site-btn" name="btDathang">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Footer Section Begin -->
<?php

require_once('components/footer.php');
?>