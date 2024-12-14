<?php
require('../db/conn.php');

if (isset($_GET['id']) && isset($_GET['role'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];

    if ($role == 'User') {
        $sql = "DELETE FROM users WHERE id = $id";
    } elseif ($role == 'Admin') {
        $sql = "DELETE FROM admins WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: listuser.php'); 
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<?php
require('includes/header.php'); 
?>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('../db/conn.php');

                        // Lấy danh sách người dùng
                        $sql_users = "SELECT id, name, email, 'User' as role FROM users";
                        $result_users = mysqli_query($conn, $sql_users);
                        $stt = 1;
                        while ($row = mysqli_fetch_assoc($result_users)) {
                        ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="edituser.php?id=<?= $row['id'] ?>&role=User">Edit</a>
                                    <a class="btn btn-danger" href="deleteuser.php?id=<?= $row['id'] ?>&role=User" onclick="return confirm('Bạn chắc chắn xóa người dùng này?');">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                        }

                        // Lấy danh sách admin
                        $sql_admins = "SELECT id, name, email, type as role FROM admins";
                        $result_admins = mysqli_query($conn, $sql_admins);
                        while ($row = mysqli_fetch_assoc($result_admins)) {
                        ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="edituser.php?id=<?= $row['id'] ?>&role=Admin">Edit</a>
                                    <a class="btn btn-danger" href="deleteuser.php?id=<?= $row['id'] ?>&role=Admin" onclick="return confirm('Bạn chắc chắn xóa admin này?');">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>