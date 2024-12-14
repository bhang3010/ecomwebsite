<?php
$is_homepage = false;

require_once('./db/conn.php');

require_once('components/header.php');
$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý khi người dùng nhấn "Thanh toán"
    if (!$isLoggedIn) {
        echo "<script>alert('Bạn cần đăng nhập để thanh toán');</script>";
        // Có thể dùng JavaScript để hiển thị popup hoặc chuyển hướng đến login
        echo "<script>window.location.href = 'loginfe.php';</script>";
    } else {
        // Đã đăng nhập, chuyển tới trang thanh toán
        header("Location: thanhtoan.php");
    }
}
?>

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
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Giỏ hàng</h4>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">
                            Products <span>Total</span>
                        </div>
                        <table class="table">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                            <?php
                            $cart = [];
                            if (isset($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                            }
                            $count = 0; //số thứ tự
                            $total = 0;
                            foreach ($cart as $item) {
                                $total += $item['qty'] * $item['disscounted_price'];
                                ?>
                                <form action="updatecart.php?id=<?= $item['id'] ?>" method="post">
                                    <tr>
                                        <td>
                                            <?= ++$count ?>
                                        </td>
                                        <td>
                                            <?= $item['name'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ" ?>
                                        </td>
                                        <td><input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" /></td>
                                        <td>
                                            <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                        </td>
                                        <td><button class="btn btn-warning">Cập nhật</button></td>
                                        <td><a href='./deletecart.php?id=<?= $item['id'] ?>' class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                </form>
                                <?php
                            }
                            ?>
                        </table>
                        <div class="checkout__order__total">
                            Tổng tiền: <span>
                                <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="shop.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                            <a href="thanhtoan.php" class="btn btn-success">
                                Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($isLoggedIn) { ?>
            <div class="row mt-5">
                <div class="col-lg-12 col-md-12">
                    <div class="checkout__order">
                        <h4>Đơn hàng đã mua</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $user_id = $_SESSION['user_id'];

                                // Lấy danh sách đơn hàng của người dùng
                                $sql = "SELECT * FROM orders WHERE user_id = $user_id";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $count = 0;
                                    while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td><?= number_format($row['total'], 0, '', '.') . " VNĐ" ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <td>
                                                <a href="chitietdonhang.php?id=<?= $row['id'] ?>" class="btn btn-info">Chi tiết</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
require_once('components/footer.php');
?>