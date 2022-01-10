<?php
session_start();
include("../path.php");
require_once(ROOT_PATH . '/include/db-functions.php');
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] !== 3) { ?>

    <?php include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Dashboard | TheHours</title>

</head>

<body>
    <!-- BEGIN HEADER -->
    <div class="admin-header">
    <div class="logo">
        <a href="<?php echo BASE_URL . "dashboard/"; ?>">ADMIN DASHBOARD</a>
    </div>

    <?php include(ROOT_PATH . '/admin/include/menu.php'); ?>
    </div>

<!-- END HEADER -->

    <!-- Admin Page Wrapper -->
    <div class="admin-wrap">

        <?php include(ROOT_PATH . '/admin/include/sidebar.php'); ?>

        <!-- Admin Content -->
        <div class="admin-content">

            <h2 class="page-title">Dashboard</h2>
            </br>
            <p>Chào mừng <span style="color: red;"><?php echo $_SESSION['user_username'] ?></span> đến trang Dashborad!</p>
            </br>
            <p>Ở đây bạn sẽ cập nhật dữ liệu của trang web</p>

            
            <!-- // Admin Content -->
        </div>
        <!-- // Page Wrapper -->
</div>
</body>

</html>
<?php } else {
    header('location: ' . BASE_URL);
    exit(0);
}?>