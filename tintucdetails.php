<?php
$is_homepage = false;
require_once('components/header.php');

require_once('./db/conn.php');

if (isset($_GET['id'])) {
    $id_tintuc = $_GET['id'];

    // Sử dụng prepared statement để ngăn chặn SQL injection
    $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->bind_param("i", $id_tintuc);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row_tintuc = $result->fetch_assoc();
        ?>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
 body {
    font-family: 'Quicksand', sans-serif; /* Sử dụng font Quicksand cho body */
  }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Nunito', sans-serif; /* Sử dụng font Nunito cho các heading */
  }    </style>

        <section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog__details__hero__text">
                            <h2><?= $row_tintuc['title'] ?></h2>
                            <ul>
                                <li><?= $row_tintuc['created_at'] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="blog-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 order-md-1 order-1">
                        <div class="blog__details__text">
                            <img src="<?= "quantri/" . $row_tintuc['avatar'] ?>" alt="">
                            <?= $row_tintuc['description'] ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 order-md-1 order-2">
                        <div class="blog__sidebar">
                            <div class="blog__sidebar__item">
                                <h4>Danh mục tin tức</h4>
                                <ul>
                                    <?php
                                    $sql_categories = "SELECT * FROM newscategories ORDER BY id";
                                    $result_categories = mysqli_query($conn, $sql_categories);
                                    while ($row_category = mysqli_fetch_assoc($result_categories)) {
                                        ?>
                                        <li><a href="#"><?= $row_category['name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="blog__sidebar__item">
                                <h4>Tin tức mới</h4>
                                <div class="blog__sidebar__recent">
                                    <?php
                                    $sql_recent = "SELECT * FROM news ORDER BY created_at DESC LIMIT 0, 3";
                                    $result_recent = mysqli_query($conn, $sql_recent);
                                    while ($row_recent = mysqli_fetch_assoc($result_recent)) {
                                        ?>
                                        <a href="chitiettintuc.php?id=<?= $row_recent['id'] ?>" class="blog__sidebar__recent__item">
                                            <div class="blog__sidebar__recent__item__pic">
                                                <img src="<?= "quantri/" . $row_recent['avatar'] ?>" width="70px" alt="">
                                            </div>
                                            <div class="blog__sidebar__recent__item__text">
                                                <h6><?= $row_recent['title'] ?></h6>
                                                <span><?= $row_recent['created_at'] ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    } else {
        echo "Không tìm thấy tin tức.";
    }

    $stmt->close();
} else {
    echo "Không có id tin tức.";
}

require_once('components/footer.php');
?>