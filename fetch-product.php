<?php
require_once('./db/conn.php');

$filter = $_GET['filter'];
$id = $_GET['id'];

switch ($filter) {
  case 'brand':
    $sql_str = "SELECT p.*, b.name AS brand_name 
                    FROM products p
                    INNER JOIN brands b ON p.brand_id = b.id
                    WHERE b.id = $id OR $id = 0 
                    ORDER BY p.name";
    break;
  case 'category':
    $sql_str = "SELECT p.*, c.name AS category_name 
                    FROM products p
                    INNER JOIN categories c ON p.category_id = c.id
                    WHERE c.id = $id OR $id = 0
                    ORDER BY p.name";
    break;
  default:
    $sql_str = "SELECT * FROM products ORDER BY name";
    break;
}

$result = mysqli_query($conn, $sql_str);

while ($row = mysqli_fetch_assoc($result)) {
  $anh_arr = explode(';', $row['images']);
  ?>
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
      <div class="product__item__pic set-bg" data-setbg="<?= "quantri/" . $anh_arr[0] ?>">
        <ul class="product__item__pic__hover">
          <li><a href="#"><i class="fa fa-heart"></i></a></li>
          <li><a href="#"><i class="fa fa-retweet"></i></a></li>
          <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
      </div>
      <div class="product__item__text">
        <h6><a href="sanpham.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h6>
        <div class="prices">
          <span class="old"><?= $row['price'] ?></span>
          <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
        </div>
      </div>
    </div>
  </div>
<?php } ?>