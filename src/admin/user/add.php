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
    ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Thêm tài khoản | Admin TheHours</title>
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
        <p>Thêm người dùng mới</p>
    </div>


    <div class="add-user-form">
        <form action="" method="post" name="form" enctype="multipart/form-data">
        <?php include(ROOT_PATH . '/include/message.php'); ?>

            <!-- fullname -->
            <div class="row">
                <div class="col-25">
                    <label for="fullname">Fullname:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fullname" name="fullname"
                        placeholder="Nguyễn Văn A...">
                </div>
            </div>

            <!-- username -->
            <div class="row">
                <div class="col-25">
                    <label for="username">Username:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="username" name="username"
                        placeholder="Type username here...">
                </div>
            </div>

            <!-- email -->
            <div class="row">
                <div class="col-25">
                    <label for="email">Email:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email"
                        placeholder="Type your email here...">
                </div>
            </div>

            <!-- password -->
            <div class="row">
                <div class="col-25">
                    <label for="password">Password:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="password" name="password" placeholder="Type your password">
                </div>
            </div>

            <!-- password retype -->
            <div class="row">
                <div class="col-25">
                    <label for="passwordConf">Retype Password:</label>
                </div>
                <div class="col-75">
                    <input type="password" id="passwordConf" name="passwordConf" placeholder="Retype your password">
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
    foreach ($roles as $role) {  ?>
                            <option value="<?php echo $role['id'] ?>"><?php echo $role['role'] ?></option>
                        <?php
                    } ?>
                </select>
                </div>
            </div>

            <!-- Button Submit -->
            <div class="btn-group">
            <input type="submit" value="Add" name="create-user">
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