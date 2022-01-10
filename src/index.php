<?php
session_start();
include("path.php");

?>

<!DOCTYPE html>

<head>
    <!-- khai báo các meta link script ở đây -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="/src/assets/css/main.css">
    <link rel="stylesheet" href="/src/assets/css/news.css">
    <link rel="stylesheet" href="/src/assets/css/base.css">
    <link rel="stylesheet" href="/src/assets/css/style.css">
    <link rel="stylesheet" href="/src/assets/css/form.css">
    <script src="/src/assets/scripts/script.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- FONT AWSOME CDN -->
    <script src="https://kit.fontawesome.com/0f79449357.js" crossorigin="anonymous"></script>
<title>Trang chủ | TheHours</title>

</head>
<body>
    <div class="app">
        <!-- BEGIN header -->
        <div class="header">
            <a href="<?php echo BASE_URL ?>" class="thehours-logo">
                <span class="main-title">TheHours</span>
                <span class="sub-title">Tin tức nhanh nhất</span>
            </a>
        </div>
        <!-- END header -->

        <!-- Begin MENU -->
        <?php require_once("controllers/MenuController.php"); ?>
        <!-- End MENU -->

        <div class="app__container">
            <!-- begin HEADLINE -->
            <div class="headlines-section">
                <!-- MAINNEW BEGIN -->
                <?php require_once("controllers/HeadlinesController.php"); ?>
                <!-- MAINNEW END -->

                <!-- BEGIN TAB -->
                <?php require_once("controllers/HomeTabController.php"); ?>
                <!-- END TAB -->
            </div>
            <!-- end HEADLINE -->

            <!-- BEGIN CATEGORY LIST -->
            <?php require_once("controllers/HomeCategoryListController.php"); ?>
            <!-- END CATEGORY LIST -->

        </div>

        <!-- BEGIN footer.php -->
        <?php include(ROOT_PATH . '/include/footer.php') ?>
        <!-- END footer.php -->
    </div>
</body>

</html>

