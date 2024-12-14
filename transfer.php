<?php
require_once('./db/conn.php');
require_once('components/header.php');

// Xử lý khi người dùng nhấn "Thành công"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cập nhật phương thức thanh toán trong `order_details` thành "TRANSFER"
    $sql = "UPDATE order_details SET payment_method = 'TRANSFER' WHERE order_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Chuyển hướng đến trang thankyou
    header("Location: thankyou.php");
    exit;
}
?>


<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  .checkout.spad {
    padding-top: 100px;
    padding-bottom: 100px;
  }

  .checkout__form {
    background: #f5f5f5;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 0 auto; /* Thêm margin: 0 auto để căn giữa form */
  }

  .checkout__form h4 {
    color: #28a745;
    font-weight: 700;
    margin-bottom: 30px;
  }

  .checkout__form p {
    margin-bottom: 10px;
  }

  .checkout__form img {
    display: block;
    margin: 20px auto;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }

  .site-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .site-btn:hover {
    background-color: #218838;
  }

  .d-flex.justify-content-between {
    margin-top: 30px;
  }
        body {
    font-family: 'Quicksand', sans-serif; /* Sử dụng font Quicksand cho body */
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif; /* Sử dụng font Nunito cho các heading */
  }
    </style>
</style>

<!-- Form xác nhận chuyển khoản -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Thông tin chuyển khoản ngân hàng</h4>
            <p>Vui lòng chuyển khoản đến số tài khoản sau:</p>
            <img src="quantri/uploads/transfer.jpg" alt="Mã QR chuyển khoản">
            <form method="post">
                <button type="submit" class="site-btn">Thành công</button>
            </form>
        </div>
    </div>
</section>

<?php
require_once('components/footer.php');
?>