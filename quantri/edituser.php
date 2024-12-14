<?php
require('includes/header.php');
require('../db/conn.php');

if (isset($_GET['id']) && isset($_GET['role'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];

    // Lấy thông tin người dùng/admin
    if ($role == 'User') {
        $sql = "SELECT * FROM users WHERE id = $id";
    } elseif ($role == 'Admin') {
        $sql = "SELECT * FROM admins WHERE id = $id";
    }
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Xử lý form submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        // ... các trường dữ liệu khác cần cập nhật

        if ($role == 'User') {
            $update_sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
        } elseif ($role == 'Admin') {
            $update_sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
        }

        if (mysqli_query($conn, $update_sql)) {
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}
?>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa người dùng</h6>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>