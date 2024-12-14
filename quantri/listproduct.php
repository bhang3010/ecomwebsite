<?php
require('includes/header.php');

function anhdaidien($arrstr, $height)
{
    $arr = explode(';', $arrstr);
    return "<img src='$arr[0]' height='$height' />";
}
?>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh đại diện</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh đại diện</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        require('../db/conn.php');
                        // Truy vấn để lấy danh sách sản phẩm (đã sửa)
                        $sql = "SELECT 
                                    p.id, 
                                    p.name, 
                                    p.images, 
                                    c.name AS category_name, 
                                    b.name AS brand_name, 
                                    p.status
                                FROM products p
                                INNER JOIN categories c ON p.category_id = c.id
                                INNER JOIN brands b ON p.brand_id = b.id
                                ORDER BY p.name";

                        $result = mysqli_query($conn, $sql); // Thực thi truy vấn
                        $stt = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stt++;
                        ?>
                            <tr>
                                <td><?= $row['name'] ?></td>
                                <td><?= anhdaidien($row['images'], "100px") ?></td>
                                <td><?= $row['category_name'] ?></td>
                                <td><?= $row['brand_name'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="editproduct.php?id=<?= $row['id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="deleteproduct.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn xóa sản phẩm này?');">Delete</a>
                                </td>
                            </tr>
                        <?php
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