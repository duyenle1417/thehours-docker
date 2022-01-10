<?php
session_start();
include("path.php");
require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/users_functions.php');

// model user
require_once('./models/UserModel.php');
$user_model = new User();

if (isset($_SESSION['user_id'])) {
    $user = $user_model->getUserById($_GET['id']); ?>

<?php
include(ROOT_PATH . '/include/head.php'); ?>
<title>Profile | TheHours</title>


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

        <div class="admin-content">
            
            <div class="change-pass-form" style="margin-top: 50px">
            <h2>Đổi mật khẩu</h2>
                <form action="" method="post" name="form" enctype="multipart/form-data">
                    <?php include(ROOT_PATH . '/include/message.php'); ?>
                    <!-- id -->
                    <input type="text" id="id" name="id" value="<?php echo $user['id']; ?>" hidden>

                    <!-- old password -->
                    <div class="row">
                        <div class="col-25">
                            <label for="Oldpassword">Current password:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="Oldpassword" name="Oldpassword" placeholder="Type your curent password">
                        </div>
                    </div>

                    <!-- password -->
                    <div class="row">
                        <div class="col-25">
                            <label for="password">New password:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="password" name="password" placeholder="Type your new password">
                        </div>
                    </div>

                    <!-- password retype -->
                    <div class="row">
                        <div class="col-25">
                            <label for="passwordConf">Retype new password:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="passwordConf" name="passwordConf" placeholder="Retype your new password" >
                        </div>
                    </div>

                    <!-- Button Submit -->
                    <div class="btn-group">
                        <input type="submit" value="Change password" name="change-password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
} else {
        header('location: ' . BASE_URL);
    }?>

