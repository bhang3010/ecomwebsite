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