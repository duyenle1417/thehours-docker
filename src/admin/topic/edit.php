<?php
session_start();
include("../../path.php");

// model category
require_once(ROOT_PATH . '/models/CategoryModel.php');
$topic_model = new Category();

require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/topics_functions.php');

//check if user's role is ADMIN else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] === 1) {
    $topic = $topic_model->getTopicById($_GET['id']); ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Chỉnh sửa danh mục | Admin TheHours</title>
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
        <p>Chỉnh sửa danh mục</p>
    </div>

    <div class="edit-topic-form">
        <form action="" method="post" name="form" enctype="multipart/form-data">
        <input type="text" id="id" name="id"value="<?php echo $topic['id']; ?>" hidden>
            <!-- name -->
            <div class="row">
                <div class="col-25">
                    <label for="name">Tên topic:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="name"
                        placeholder="Thời sự..." value="<?php echo $topic['name']; ?>">
                </div>
            </div>

            <!-- parent_topic_id -->
            <div class="row">
                <div class="col-25">
                    <label for="parent_topic_id">Danh mục cha:</label>
                </div>
                <div class="col-75">
                <select name="parent_topic_id" id="parent_topic_id">
                    <option value="#" disabled>- Hãy chọn danh mục cha -</option>
                    <option value="NULL">Trống</option>
                    <?php
                        $parent_topics = $topic_model->getParentTopics();
    foreach ($parent_topics as $parent_topic) {
        if ($parent_topic['id'] === $topic['parent_topic_id']) { ?>
                                <option value="<?php echo $parent_topic['id'] ?>" selected><?php echo $parent_topic['name'] ?></option>
                            <?php
                            } else { ?>
                                <option value="<?php echo $parent_topic['id'] ?>"><?php echo $parent_topic['name'] ?></option>
                            <?php } ?>
                        <?php
    } ?>
                </select>
                </div>
            </div>

            <!-- Button Submit -->
            <div class="btn-group">
                <input type="submit" value="Update" name="update-topic">
            </div>
            <?php include(ROOT_PATH . '/include/message.php'); ?>
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