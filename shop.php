<?php
$is_homepage = false;
require_once('components/header.php');

require('./db/conn.php'); // Kết nối database

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default'; 

if ($sort == 'asc') {
    $sql_str = "SELECT * FROM products ORDER BY price ASC"; 
} elseif ($sort == 'desc') {
    $sql_str = "SELECT * FROM products ORDER BY price DESC"; 
} else {
    $sql_str = "SELECT * FROM products"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organi Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap"> 
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <style>
        /* Sidebar */
        .sidebar {
            padding: 20px;
            background-color: #f8f9fa; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
        }

        .sidebar__item {
            margin-bottom: 30px;
        }

        .sidebar__item h4 {
            font-weight: bold;
            margin-bottom: 15px;
            color: #333; /* Màu tiêu đề sidebar */
        }

        .sidebar__item ul {
            list-style: none;
            padding: 0;
        }

        .sidebar__item li a {
            display: block;
            padding: 10px 0;
            color: #6c757d; /* Màu chữ liên kết */
            text-decoration: none;
            transition: all 0.3s ease; 
        }

        .sidebar__item li a:hover {
            color: #e91e63; /* Màu chữ khi hover */
            padding-left: 10px; 
        }

        /* Price Range */
        /* ... (giữ nguyên CSS phần này) */

        /* Color Option */
        /* ... (giữ nguyên CSS phần này) */

        /* Popular Size */
        /* ... (giữ nguyên CSS phần này) */

        /* Latest Product */
        .latest-product__text h4 {
            color: #333; /* Màu tiêu đề sản phẩm mới */
        }

        .latest-product__item__text h6 {
            color: #333;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Product Discount */
        .product__discount__title h2 {
            color: #333; /* Màu tiêu đề sản phẩm giảm giá */
        }

        .product__discount__item__text span {
            color: #6c757d; /* Màu chữ tên danh mục */
        }

        .product__discount__item__text h5 a {
            color: #333; /* Màu chữ tên sản phẩm */
        }

        /* Product Item */
        .product__item__text h6 a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .product__item__text h6 a:hover {
            color: #e91e63;
        }

        /* Prices */
        /* ... (giữ nguyên CSS phần này) */

        /* Pagination */
        /* ... (giữ nguyên CSS phần này) */

        .breadcrumb__text h2 {
            font-family: 'Playfair Display', serif; /* Font chữ tiêu đề trang */
            font-weight: bold;
            color: #333;
        }
    body {
    font-family: 'Quicksand', sans-serif; /* Sử dụng font Quicksand cho body */
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif; /* Sử dụng font Nunito cho các heading */
  }

  
    </style>
</body>
</html>

<section class="product spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-7">
        <div class="sidebar">
          <div class="sidebar__item">
            <h4>Danh mục sản phẩm</h4>
            <ul>
              <?php
              $sql_categories = "select * from categories order by name";
              $result_categories = mysqli_query($conn, $sql_categories);
              while ($row_category = mysqli_fetch_assoc($result_categories)){
                ?>
                <li><a href="#"><?=$row_category['name']?></a></li>
              <?php } ?>
            </ul>
          </div>

          <div class="sidebar__item">
            <div class="latest-product__text">
              <h4>Sản phẩm mới nhất</h4>
              <div class="latest-product__slider owl-carousel">
                <div class="latest-prdouct__slider__item">
                  <?php
                  $sql_latest = "SELECT * FROM `products` order by created_at desc limit 0, 3";
                  $result_latest = mysqli_query($conn, $sql_latest);
                  while ($row_latest = mysqli_fetch_assoc($result_latest)){
                    $anh_arr = explode(';', $row_latest['images']);
                    ?>
                    <a href="sanpham.php?id=<?=$row_latest['id']?>" class="latest-product__item">
                      <div class="latest-product__item__pic">
                        <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                      </div>
                      <div class="latest-product__item__text">
                        <h6><?=$row_latest['name']?></h6>
                        <div class="prices">
                          <span class="old"><?=$row_latest['price']?></span>
                          <span class="curr"><?= number_format($row_latest['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                        </div>
                      </div>
                    </a>
                  <?php } ?>
                </div>
                <div class="latest-prdouct__slider__item">
                  <?php
                  $sql_latest = "SELECT * FROM `products` order by created_at desc limit 3, 3";
                  $result_latest = mysqli_query($conn, $sql_latest);
                  while ($row_latest = mysqli_fetch_assoc($result_latest)){
                    $anh_arr = explode(';', $row_latest['images']);
                    ?>
                    <a href="sanpham.php?id=<?=$row_latest['id']?>" class="latest-product__item">
                      <div class="latest-product__item__pic">
                        <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                      </div>
                      <div class="latest-product__item__text">
                        <h6><?=$row_latest['name']?></h6>
                        <div class="prices">
                          <span class="old"><?=$row_latest['price']?></span>
                          <span class="curr"><?= number_format($row_latest['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                        </div>
                      </div>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 col-md-7">
        <div class="product__discount">
          <div class="section-title product__discount__title">
            <h2>Giảm giá</h2>
          </div>
          <div class="row">
            <div class="product__discount__slider owl-carousel">
              <?php
              $sql_discount = "SELECT p.id as pid, p.name as pname, c.name as cname, 
                                     ROUND((p.price - p.disscounted_price)/p.price*100) as discount, 
                                     p.images, p.price, p.disscounted_price 
                               FROM `products` p 
                               JOIN `categories` c ON p.category_id = c.id 
                               ORDER BY discount DESC 
                               LIMIT 0, 6 ";
              $result_discount = mysqli_query($conn, $sql_discount);
              while ($row_discount = mysqli_fetch_assoc($result_discount)){
                $anh_arr = explode(';', $row_discount['images']);
                ?>
                <div class="col-lg-4">
                  <div class="product__discount__item">
                    <div class="product__discount__item__pic set-bg" data-setbg="<?="quantri/".$anh_arr[0]?>">
                      <div class="product__discount__percent">-<?=$row_discount['discount']?>%</div>
                      <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                      </ul>
                    </div>
                    <div class="product__discount__item__text">
                      <span><?=$row_discount['cname']?></span>
                      <h5><a href="sanpham.php?id=<?=$row_discount['pid']?>"><?=$row_discount['pname']?></a></h5>
                      <div class="prices">
                        <span class="old"><?=$row_discount['price']?></span>
                        <span class="curr"><?= number_format($row_discount['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="filter__item">
          <div class="row">
            <div class="col-lg-4 col-md-5">
              <div class="filter__sort">
                <span>Sort By</span>
                <form method="GET" action="shop.php"> 
                  <select name="sort" onchange="this.form.submit()">
                    <option value="default" <?= isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'selected' : '' ?>>Default</option>
                    <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'selected' : '' ?>>Price: High to Low</option>
                  </select>
                </form>
              </div>
            </div>

            <?php
            // Phần hiển thị số lượng sản phẩm:
            $result = mysqli_query($conn, $sql_str); 
            ?>
            <div class="col-lg-4 col-md-4">
              <div class="filter__found">
                <h6>Có <span><?=mysqli_num_rows($result)?></span> sản phẩm</h6>
              </div>
            </div>

            <div class="col-lg-4 col-md-3">
              <div class="filter__option">
                <span class="icon_grid-2x2"></span>
                <span class="icon_ul"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <?php
          // Phần hiển thị danh sách sản phẩm:
          $result = mysqli_query($conn, $sql_str); 
          while ($row = mysqli_fetch_assoc($result)){ 
            $anh_arr = explode(';', $row['images']);
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="<?="quantri/".$anh_arr[0]?>">
                  <ul class="product__item__pic__hover">
                    <li><a href="./cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                  </ul>
                </div>
                <div class="product__item__text">
                  <h6><a href="sanpham.php?id=<?=$row['id']?>"><?=$row['name']?></a></h6>
                  <div class="prices">
                    <span class="old"><?=$row['price']?></span>
                    <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once('components/footer.php');
?>