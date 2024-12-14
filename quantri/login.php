<?php
session_start();
$errorMsg = "";
if (isset($_POST["btSubmit"])) {
    require_once('../db/conn.php');
    //lay du lieu tu form
    $email = $_POST["email"];
    $password = $_POST["password"];
    //ket noi csdl
    //cau lenh truy van
    $sql = "select * from admins where email='$email' and password='$password'";

$result = mysqli_query($conn, $sql);
// ...
    if (mysqli_num_rows($result) > 0) {
        // echo "<h4>Dang nhap thanh cong</h4>";
        //luu tru thong tin dang nha
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        // print_r($_SESSION['user']);
        // exit;
        // chuyen qua trang quan trị
        header("Location: ./index.php");
    } else {
        $errorMsg = "Không tìm thấy thông tin tài khoản trong hệ thống";
        require_once("includes/loginform.php");
    }

    //
} else {
    require_once("includes/loginform.php");
}
?>