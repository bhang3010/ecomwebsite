<?php 
require('includes/header.php');

// Kết nối CSDL
require('../db/conn.php');

// Xử lý khi người dùng submit form thêm admin
if (isset($_POST['btnAddAdmin'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    // Xác nhận dữ liệu đầu vào (ví dụ đơn giản)
    if (empty($name) || empty($email) || empty($password)) {
        echo "<div class='alert alert-danger'>Vui lòng điền đầy đủ thông tin.</div>";
        exit;
    }

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm admin vào CSDL sử dụng prepared statements
    $stmt = $conn->prepare("INSERT INTO admins (name, email, password, phone, address, type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $hashed_password, $phone, $address, $type);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Thêm admin thành công.</div>"; 
        // Chuyển hướng sau một khoảng thời gian ngắn
        echo "<script>setTimeout(function(){ window.location.href = 'user.php'; }, 2000);</script>"; 
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $stmt->error . "</div>";
    }

    $stmt->close();
    exit;
}
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm admin</h1>
                        </div>
                        <form class="user" method="post" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Tên admin">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mật khẩu">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control form-control-user" id="address" name="address" placeholder="Địa chỉ"></textarea>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="type">
                                    <option value="Admin">Admin</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" name="btnAddAdmin">Thêm admin</button>
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
?>