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
            <h6 class="m-0 font-weight-bold text-primary">Inventory</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh đại diện</th>
                            <th>Số lượng nhập về</th>
                            <th>Số lượng đã bán</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh đại diện</th>
                            <th>Số lượng nhập về</th>
                            <th>Số lượng đã bán</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        require('../db/conn.php');
                        $sql_str = "SELECT 
                                        p.name, 
                                        p.images, 
                                        p.stock AS so_luong_nhap_ve, 
                                        IFNULL(SUM(od.qty), 0) AS so_luong_da_ban,
                                        p.stock - IFNULL(SUM(od.qty), 0) AS so_luong_con_lai
                                    FROM products p
                                    LEFT JOIN order_details od ON p.id = od.product_id
                                    GROUP BY p.id, p.name, p.images, p.stock";
                        $result = mysqli_query($conn, $sql_str);
                        $stt = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stt++;
                        ?>
                            <tr>
                                <td><?= $stt ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= anhdaidien($row['images'], '100px') ?></td>
                                <td><?= $row['so_luong_nhap_ve'] ?></td>
                                <td><?= $row['so_luong_da_ban'] ?></td>
                                <td><?= $row['so_luong_con_lai'] ?></td>
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