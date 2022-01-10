<?php
session_start();
include("../../path.php");

// model category
require_once(ROOT_PATH . '/models/CategoryModel.php');
$topic_model = new Category();

// model post
require_once(ROOT_PATH . '/models/PostModel.php');
$post_model = new Post();

require_once(ROOT_PATH . '/include/db-functions.php');
require_once(ROOT_PATH . '/admin/include/posts_functions.php');

//check if user's role is ADMIN OR AUTHOR else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] !== 3) {
    ?>

<?php
include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Thêm bài viết | Admin TheHours</title>
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
        <p>Thêm bài viết mới</p>
    </div>

    <div class="add-post-form">
        <form action="" method="post" name="form" enctype="multipart/form-data">
        <?php include(ROOT_PATH . '/include/message.php'); ?>
            <!-- title -->
            <div class="row">
                <div class="col-25">
                    <label for="title">Tiêu đề:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="title" name="title"
                        placeholder="">
                </div>
            </div>
            
            <!-- content -->
            <div class="row">
                <div class="col-25">
                    <label for="content">Nội dung:</label>
                </div>
                <div class="col-75">
                    <textarea id="content" name="content">
                        <p>Enter text here...</p>
                    </textarea>
                </div>
            </div>

            <!-- image_path -->
            <div class="row">
                <div class="col-25">
                    <label for="image_path">Ảnh bìa:</label>
                </div>
                <div class="col-75">
                    <input type="file" id="image_path" name="image_path">
                </div>
            </div>

            <!-- topic_id -->
            <div class="row">
                <div class="col-25">
                    <label for="topic_id">Danh mục:</label>
                </div>
                <div class="col-75">
                <select name="topic_id" id="topic_id">
                    <option value="0" selected disabled>- Hãy chọn danh mục -</option>
                    <?php
                        $parent_topics = $topic_model->getParentTopics();
    foreach ($parent_topics as $parent_topic) {
        $sub_topics = $topic_model->getSubTopics($parent_topic['id']); ?>
                            <option value="<?php echo $parent_topic['id'] ?>"><?php echo $parent_topic['name'] ?></option>
                            <?php
                            // if the parent topic has subtopic => arrow
                            // and list all subtopic
                            if (count($sub_topics)>0) {
                                foreach ($sub_topics as $sub_topic) { ?>
                                    <option value="<?php echo $sub_topic['id'] ?>">
                                        <?php echo $parent_topic['name'] . ' >> ' . $sub_topic['name'] ?>
                                    </option>
                            <?php }
                            }
    } ?>
                </select>
                </div>
            </div>

            <!-- user_id -->
            <!-- get from $_SESSION -->


            <!-- IsPublished -->
            <!-- defautl 1 = published -->

            <!-- Button Submit -->
            <div class="btn-group">
                <input type="submit" value="Publish" name="add-post">
            </div>
        </form>
    </div>
</div>
<!-- END ADMIN CONTENT -->

    
</body>
<script>
    var editor = CKEDITOR.replace('content',
        {
            height: 450,
            filebrowserBrowseUrl: '../src/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '../src/ckfinder/ckfinder.html?type=Images',
            filebrowserUploadUrl : '../src/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '../src/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '800'
        });
    CKFinder.setupCKEditor(editor);
</script>
</html>

<?php
} else {
        header('location: ' . BASE_URL);
    }?>