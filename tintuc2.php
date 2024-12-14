<?php
$is_homepage = false;
require_once('components/header.php');

require('./db/conn.php'); // Kết nối database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organi Shop - Tin tức</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap"> 
    <link rel="stylesheet" href="style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <style>
 body {
    font-family: 'Quicksand', sans-serif; /* Sử dụng font Quicksand cho body */
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif; /* Sử dụng font Nunito cho các heading */
  }    </style>
</body>
</html>

<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-7">
                <div class="section-title">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sql_news = "SELECT * FROM news ORDER BY created_at DESC";
            $result_news = mysqli_query($conn, $sql_news);
            while ($row_news = mysqli_fetch_assoc($result_news)){ 
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="<?= "quantri/" . $row_news['avatar'] ?>" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> <?= $row_news['created_at'] ?></li>
                            </ul>
                            <h5><a href="tintucdetails.php?id=<?= $row_news['id'] ?>"><?= $row_news['title'] ?></a></h5>
                            <p><?= $row_news['sumary'] ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
require_once('components/footer.php');
?>