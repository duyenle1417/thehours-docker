<?php
session_start();
include("path.php");
require_once('./models/CategoryModel.php');
$topic_model = new Category();

// kiểm tra url hợp lệ
if (isset($_GET['id'])) {
    //get topic info
    $topic = $topic_model->getTopicById($_GET['id']);
    if (count($topic) >0) {
?>

<?php include(ROOT_PATH . '/include/head.php'); ?>
<title><?php echo $topic['name'] ?> | TheHours</title>

</head>

<body>
    <div class="app">
        <!-- BEGIN header -->
        <div class="header">
            <a href="<?php echo BASE_URL . 'category/' . $topic['id']; ?>" class="thehours-logo">
                <span class="main-title"><?php echo $topic['name'] ?></span>
                <span class="sub-title">TheHours</span>
            </a>
        </div>
        <!-- END header -->

        <!-- Begin MENU -->
        <?php require_once("controllers/MenuController.php"); ?>
        <!-- End MENU -->

        <div></div>

        <div class="app__container">
            <!-- PATH begin -->
            <div class="path-library">
                <a href="<?php echo BASE_URL ?>">Home</a>
                <?php
                if ($topic['parent_topic_id'] !== null) {
                    echo '<span>/</span>';
                    $parent = $topic_model->getTopicById($topic['parent_topic_id']); ?>
                <a href="<?php echo BASE_URL . 'category/' . $parent['id']; ?>"><?php echo $parent['name'] ?></a>
                <?php
                } ?>
                <span>/</span>
                <a href="<?php echo BASE_URL . 'category/' . $topic['id']; ?>"><?php echo $topic['name'] ?></a>
            </div>
            <!-- PATH end -->
            
            <!-- CATEGORY DETAIL begin -->
            <?php require_once("controllers/CategoryDetailController.php"); ?>
            <!-- CATEGORY DETAIL end -->
        </div>

        <!-- BEGIN footer.php -->
        <?php include(ROOT_PATH . '/include/footer.php') ?>
        <!-- END footer.php -->
    </div>
</body>

</html>

<?php
    } else {
        //redirect về home nếu id không có thực
        header("Location: ". BASE_URL);
    }
}//END IF
else {
    //redirect về home nếu không có id
    header("Location: ". BASE_URL);
}?>