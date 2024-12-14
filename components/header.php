<?php 
if (!isset($is_homepage)) {
    $is_homepage = false; // Hoặc có thể là true nếu trang hiện tại là trang chủ
}
session_start(); 
$isLoggedIn = isset($_SESSION['user_id']);
$userName = "";
if ($isLoggedIn) {
    // Lấy tên người dùng từ bảng `users`
    require_once('db/conn.php');
    $sql = "SELECT name FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $userName = $row['name'];
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
 
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặc sản Quảng Ngãi | Các món truyền thống đặc trưng Quảng Ngãi</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="./css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="./css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <style>
        .header__top__right {
  display: flex;
  justify-content: flex-end; /* Căn phải tất cả các phần tử con */
  align-items: center; /* Căn giữa theo chiều dọc */
}

.header__top__right__social {
  /* Loại bỏ text-align: center; */ 
  margin-right: 20px; /* Khoảng cách giữa số điện thoại và phần đăng nhập/tạo tài khoản */
  font-size: 14px; /* Giảm font size xuống 14px (hoặc giá trị bạn muốn) */
  margin-left: -60px;
}

.header__top__right__auth {
  display: flex; /* Xếp các liên kết "Đăng nhập" và "Tạo tài khoản" trên cùng một dòng */
  gap: 10px; /* Khoảng cách giữa các liên kết */
}</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <!-- <div class="header__top__right__language">
                <img src="../img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Đăng nhập</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/shop.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> shopdacsanquangngai@gmail.com</li>
                <li>Shop Đặc sản Quảng Ngãi</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> shopdacsanquangngai@gmail.com</li>
                                <li>Shop Đặc sản Quảng Ngãi</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
  <div class="header__top__right">
    <div class="header__top__right__social">
      <i class="fa fa-phone"></i> <span class="phone-number">0942.814.192</span>
    </div>
    <div class="header__top__right__auth">
      <?php if ($isLoggedIn): ?>
        <span>Chào, <?php echo $userName; ?></span> |
        <a href="logout.php">Đăng xuất</a>
      <?php else: ?>
        <a href="loginfe.php">Đăng nhập</a> | 
        <a href="signupfe.php">Tạo tài khoản</a>
      <?php endif; ?>
    </div>
  </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="hero__search"> -->
                        <div class="hero__search__form">
                            <form action="timkiem.php" method="get">
                                <!-- <div class="hero__search__categories"> -->
                                    <!-- Tất cả danh mục
                                    <span class="arrow_carrot-down"></span> -->
                                    <select name="danhmuc">
                                        <option value='*'>Tất cả danh mục</option>
                                        <?php
                                        require('./db/conn.php');
                                        $sql_str = "select * from categories order by name";
                                        $result = mysqli_query($conn, $sql_str);
                                            while ($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <option value=<?=$row['id']?>><?=$row['name']?></option>
                                        <?php } ?>
                                    </select>
                                <!-- </div> -->
                                <input type="text" name="tukhoa" placeholder="Bạn cần tìm gì?">
                                <button type="submit" class="site-btn">Tìm</button>
                            </form>
                        </div>
                        
                    <!-- </div> -->
                </div>
                
                <!-- <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/shop.php">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div> -->
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="./cart.php"><i class="fa fa-shopping-bag"></i> <span>
                                <?php
                                    $cart = [];
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                    }
// print_r($cart);exit;
                                    $count = 0;  //hien thi so luong san pham trong gio hang
                                    $tongtien = 0;
                                    foreach ($cart as $item) {
                                        $count += $item['qty'];
                                        $tongtien += $item['qty'] * $item['disscounted_price'];
                                    }   
                                    //hien thi so luong
                                    echo $count;
                                ?>
                            </span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng tiền: <span><?=number_format($tongtien, 0, '', '.'). " VNĐ" ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php   
    if ($is_homepage){
        echo '<section class="hero">';
    } else {
        echo '<section class="hero hero-normal">';
    }
    ?>
    <!-- <section class="hero"> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục sản phẩm</span>
                        </div>
                        <ul>
                            <?php
                                
                                $sql_str = "select * from categories order by name";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)){
                            ?>
                            <li><a href="#"><?=$row['name']?></a></li>

                            <?php } ?>
                         
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                <!-- <div class="col-lg-6"> -->
                <nav class="header__menu" style="display: flex; justify-content: center;">
                <ul>
                            <li class="active"><a href="./index.php">Trang chủ</a></li>
                            <li><a href="./shop.php">Cửa hàng</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./cart.php">Shoping Cart</a></li>
                                    <li><a href="./thanhtoan.php">Check Out</a></li>
                                </ul>
                            </li>
                            <li><a href="./tintuc2.php">Tin tức</a></li>
                            <li><a href="./lienhe.php">Liên hệ</a></li>
                        </ul>
                    </nav>
                <!-- </div> -->
                    
                    <?php   
    if ($is_homepage){
       ?>
 <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
<?php
    }
    ?>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
