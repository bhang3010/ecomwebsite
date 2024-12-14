<?php
require('includes/header.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu
    // ... các trường dữ liệu khác cần thêm

    $sql = "INSERT INTO users (name, email, password, ...) VALUES ('$name', '$email', '$password', ...)";

    if (mysqli_query($conn, $sql)) {
        header('Location: listuser.php');
    } else {
        echo "Lỗi: " . mysqli_error($conn);
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
                            <h1 class="h4 text-gray-900 mb-4">Thêm mới người dùng</h1>
                        </div>
                        <form class="user" method="post" action="adduser.php">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Tên người dùng" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Mật khẩu" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Tạo mới
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>