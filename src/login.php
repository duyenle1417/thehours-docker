<?php
session_start();
include('path.php');
require_once(ROOT_PATH . '/include/db-functions.php');
if (!isset($_SESSION['user_id'])) { ?>

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
    <title>Login -TheHours</title>
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
    </div>
    <div class="login-form">
        <div class="form-title">
            <p>Đăng nhập</p>
        </div>
        <!-- demo info -->
        <div style="text-align:center;">
            <p>Tài khoản demo:</p>
            <p>admin - 123456</p>
            <p>hanhmy - 123456</p>
            <p>guest - 123456</p>
        </div>
        
        <form action="login" method="POST">
            <div class="row">
                <div class="form-label">
                    <label for="username">Username:</label>
                </div>
                <div class="form-input">
                    <i class="far fa-user"></i>
                    <input type="text" id="login-username" name="username" placeholder="Type your username">
                </div>
            </div>
            <div class="row">
                <div class="form-label">
                    <label for="password">Password:</label>
                </div>
                <div class="form-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="login-password" name="password" placeholder="Type your password">
                </div>
                <!-- chưa làm quên mật khẩu -->
                <!-- <a href="#" style="float: right; font-size: 12px; margin-top: 5px;">Quên mật khẩu?</a> -->
            </div>

            <input type="submit" value="LOGIN" name="login-btn">

            <?php include(ROOT_PATH . '/include/message.php'); ?>
        </form>
        <p style="text-align: center; margin-top: 80px; font-size: 14px;">Hoặc <a href="<?php echo BASE_URL . 'signup' ?>">đăng ký ngay</a></p>
    </div>
</body>

</html>
<?php
    } else {
        header('location: ' . BASE_URL);
        exit(0);
    }?>