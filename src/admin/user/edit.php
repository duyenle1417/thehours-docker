<?php
session_start();
include("../../path.php");

// model user
require_once(ROOT_PATH . '/models/UserModel.php');
$user_model = new User();

require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/users_functions.php');

//check if user's role is ADMIN else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] === 1) {
    $user = $user_model->getUserById($_GET['id']); ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Chỉnh sửa thông tin tài khoản | Admin TheHours</title>
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


<!-- BEGIN SIDEBAR -->
<?php
    include(ROOT_PATH . '/admin/include/sidebar.php'); ?>
<!-- END SIDEBAR -->

<!-- BEGIN ADMIN CONTENT -->
<div class="admin-content">
    <div class="title">
        <p>Chỉnh sửa thông tin tài khoản</p>
    </div>

    <div class="edit-user-form">
        <?php include(ROOT_PATH . '/include/message.php'); ?>

        <form action="" method="post" name="form" enctype="multipart/form-data">
        <!-- id -->
        <input type="text" id="id" name="id" value="<?php echo $user['id']; ?>" hidden>

            <!-- fullname -->
            <div class="row">
                <div class="col-25">
                    <label for="fullname">Fullname:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fullname" name="fullname"
                        placeholder="Nguyễn Văn A..." value="<?php echo $user['fullname'] ?>">
                </div>
            </div>

            <!-- username -->
            <div class="row">
                <div class="col-25">
                    <label for="username">Username:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="username" name="username"
                        placeholder="Type username here..." disabled value="<?php echo $user['username'] ?>">
                </div>
            </div>

            <!-- email -->
            <div class="row">
                <div class="col-25">
                    <label for="email">Email:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email"
                        placeholder="Type your email here..." value="<?php echo $user['email'] ?>">
                </div>
            </div>

            <!-- role_id -->
            <div class="row">
                <div class="col-25">
                    <label for="role_id">Quyền:</label>
                </div>
                <div class="col-75">
                <select name="role_id" id="role_id">
                    <option value="0" selected disabled>- Hãy chọn quyền tài khoản -</option>
                    
                    <?php
                    $roles = $user_model->GetAllRoles();
    foreach ($roles as $role) {
        if ($role['id'] === $user['role_id']) {
            ?>
                            <option value="<?php echo $role['id'] ?>" selected><?php echo $role['role'] ?></option>
                        <?php
        } else {?>
                            <option value="<?php echo $role['id'] ?>"><?php echo $role['role'] ?></option>
                        <?php
                    }
    } ?>
                </select>
                </div>
            </div>

            <!-- Button Submit -->
            <div class="btn-group">
                <input type="submit" value="Update" name="update-user">
            </div>
        </form>
    </div>

    <div class="change-pass-form" style="margin-top: 50px">
            <h2>Đổi mật khẩu</h2>
                <form action="" method="post" name="form" enctype="multipart/form-data">
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
<!-- END ADMIN CONTENT -->

    
</body>

</html>
<?php
} else {
        header('location: ' . BASE_URL);
    }?>