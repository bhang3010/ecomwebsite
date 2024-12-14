<?php
$is_homepage = false;
require_once('quantri/includes/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organi Shop</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap"> 
  <link rel="stylesheet" href="style.css"> </head>
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


/* Font chữ */
body {
  font-family: 'Arial', sans-serif; /* Font chữ cho toàn bộ trang web */
}

.breadcrumb__text h2 {
  font-family: 'Playfair Display', serif; /* Font chữ tiêu đề trang */
  font-weight: bold;
  color: #333;
}
</style>
  </body>
</html>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục sản phẩm</h4>
                            <ul>
                <?php
                require('./db/conn.php');
                 $sql_str = "select * from categories order by name";
                 $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)){
                ?>
                    <li><a href="#"><?=$row['name']?></a></li>
                <?php } ?>
                                
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới nhất</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
<?php
$sql_str = "SELECT * FROM `products` order by created_at desc limit 0, 3";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                                        <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?=$row['name']?></h6>
                                                <!-- <span><?=$row['price']?></span> -->
                                                <div class="prices">
                                                    <span class="old"><?=$row['price']?></span>
                                                    <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                                </div>
                                            </div>
                                        </a>
<?php
}
?>
                                        
                                    </div>
                                    <div class="latest-prdouct__slider__item">
<?php
$sql_str = "SELECT * FROM `products` order by created_at desc limit 3, 3";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                                        <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?=$row['name']?></h6>
                                                <div class="prices">
                                                    <span class="old"><?=$row['price']?></span>
                                                    <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
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
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                            <?php
$sql_str = "SELECT products.id as pid, products.name as pname, categories.name as cname, round((price - disscounted_price)/price*100) as discount, images, price, disscounted_price  FROM `products`, `categories` where products.category_id=categories.id order by discount desc limit 0, 6 ";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>                                
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?="quantri/".$anh_arr[0]?>">
                                            <div class="product__discount__percent">-<?=$row['discount']?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span><?=$row['cname']?></span>
                                            <h5><a href="sanpham.php?id=<?=$row['pid']?>"><?=$row['pname']?></a></h5>
                                            <!-- <div class="product__item__price"><?=$row['disscounted_price']?> <span><?=$row['price']?></span></div> -->
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
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
 <?php
    $sql_str = "select * from products order by name";
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
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?="quantri/".$anh_arr[0]?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="sanpham.php?id=<?=$row['id']?>"><?=$row['name']?></a></h6>
                                    <!-- <h5><?=$row['price']?></h5> -->
                                    <div class="prices">
                                        <span class="old"><?=$row['price']?></span>
                                        <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php } ?>

                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php

require_once('components/footer.php');
?>