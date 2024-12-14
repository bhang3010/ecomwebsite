<?php
// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Kiểm tra xem form có được submit không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $summary = $_POST['summary'] ?? '';
    $stock = $_POST['stock'] ?? 0;
    $price = $_POST['price'] ?? 0;
    $disscounted_price = $_POST['disscounted_price'] ?? 0;
    $category_name = $_POST['category_name'] ?? null;
    $brand_name = $_POST['brand_name'] ?? null;
    $status = $_POST['status'] ?? 'Active';

    //xu ly hinh anh

    $img_paths = []; // Mảng lưu các đường dẫn của hình ảnh

    if (!empty($_FILES['anhs']['name'][0])) {
        // Duyệt qua từng tệp ảnh đã chọn
        foreach ($_FILES['anhs']['name'] as $key => $filename) {
            $location = "../img/product/" . uniqid() . $filename;
            $extension = pathinfo($location, PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            $valid_extensions = array("jpg", "jpeg", "png");
        }

            // Kiểm tra xem tệp có hợp lệ không
            if (in_array($extension, $valid_extensions)) {
                if (move_uploaded_file($_FILES['anhs']['tmp_name'][$key], $location)) {
                    // Lưu đường dẫn ảnh vào mảng
                    $img_paths[] = $location;
                } else {
                    echo "Lỗi khi upload hình ảnh: $filename";
                }
            } else {
                echo "Tệp không hợp lệ: $filename";
            }
            }
        }
    

    // Kiểm tra nếu dữ liệu không đầy đủ
    if (empty($name) || empty($summary) || empty($description) || empty($stock) || empty($price) || empty($category_name)) {
        echo "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Kiểm tra tên danh mục và thương hiệu từ bảng categories và brands
        $categories_sql = "SELECT name FROM categories WHERE name = '$category_name' LIMIT 1";
        $brands_sql = "SELECT name FROM brands WHERE name = '$brand_name' LIMIT 1";

        $category_result = mysqli_query($conn, $categories_sql);
        $brand_result = mysqli_query($conn, $brands_sql);

        if (mysqli_num_rows($category_result) > 0 && mysqli_num_rows($brand_result) > 0) {
            // Lấy tên danh mục và thương hiệu
            $category_name = mysqli_fetch_assoc($category_result)['name'];
            $brand_name = mysqli_fetch_assoc($brand_result)['name'];

        // Truy vấn SQL để chèn sản phẩm mới
        $sql = "INSERT INTO products (`name`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `category_name`, `brand_name`, `status`, `images`) 
                VALUES ('$name', '$description', '$summary', '$stock', '$price', '$disscounted_price', '$category_name', '$brand_name', '$status', '$img_path')";
        
        // Thực thi truy vấn
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Sản phẩm đã được thêm thành công!'); window.location.href='listproduct.php';</script>";
        } else {
            echo "Lỗi khi thêm sản phẩm: " . mysqli_error($conn);
        }
        }
     } 

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
