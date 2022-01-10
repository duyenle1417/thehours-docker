<?php
// kiểm tra url id hợp lệ
if (isset($_GET['id'])) {
    // get post info
    $post = $post_model->getPublishedPostById($_GET['id']);
    if (count($post) >0) {
        // get post's topic info
        $topic = $topic_model->getTopicById($post['topic_id']);
        // get user info
        $user = $user_model->getUserById($post['user_id']);
        //update views
        $views = $post['views'] + 1;
        $post_model->UpdateView($post['id'], $views); ?>

<!DOCTYPE html>

<head>
    <!-- khai báo các meta link script ở đây -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/news.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/form.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/scripts/script.js"></script>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- FONT AWSOME CDN -->
    <script src="https://kit.fontawesome.com/0f79449357.js" crossorigin="anonymous"></script>
<title><?php echo $post['title']; ?> | TheHours</title>
</head>

<body>
    <div class="app">
        <!-- BEGIN header -->
        <div class="header">
            <a href="<?php echo BASE_URL . 'category?id=' . $topic['id']; ?>" class="thehours-logo">
                <span class="main-title"><?php echo $topic['name'] ?></span>
                <span class="sub-title">TheHours</span>
            </a>
        </div>
        <!-- END header -->

        <!-- Begin MENU -->
        <?php require_once("controllers/MenuController.php"); ?>
        <!-- End MENU -->

        <div class="app__container">
            <div class="path-library">
                <a href="<?php echo BASE_URL ?>">Home</a>
                <!-- topic path -->
                <?php if ($topic['parent_topic_id'] !== null) {
            echo '<span>/</span>';
            $parent = $topic_model->getTopicById($topic['parent_topic_id']); ?>
                <a href="<?php echo BASE_URL . 'category/' . $parent['id']; ?>"><?php echo $parent['name'] ?></a>
                <?php
        } ?>
                <span>/</span>
                <a href="<?php echo BASE_URL . 'category/' . $topic['id']; ?>"><?php echo $topic['name'] ?></a>
                <!-- post path <= title -->
                <span>/ <?php echo $post['title'] ?></span>
            </div>

            <div class="content">
                <!-- topic_id -->
                <div class="content__category"><?php echo $topic['name'] ?></div>

                <!-- title -->
                <h2 class="content__title"><?php echo $post['title']; ?></h2>

                <!-- user_id =>author & create_date -->
                <div class="content__author-view-date">
                    <div class="content__author-comment">
                        <div class="content__author">
                            <span><i class="fas fa-user"></i></span>
                            <?php echo $user['fullname']; ?>
                            <!-- edit post link if loggin user is author -->
                            <?php if (isset($_SESSION['user_id']) && intval($post['user_id']) === intval($_SESSION['user_id'])) { ?>
                                <a href="<?php echo BASE_URL . 'edit-post/' . $post['id']; ?>">  Edit post?</a>
                            <?php } ?>
                        </div>
                        <div class="content__comment">
                            <span><i class="far fa-comment"></i></span>
                            <?php echo $comment_model->getCommentsNumberOfPost($post['id']); ?>
                        </div>
                    </div>
                    
                    <div class="content__view-date">
                        <div class="content__date">
                            <span><i class="fas fa-clock"></i></span>
                            <?php echo $mysqldate = date('H:i:s d/m/Y', strtotime($post['create_date'])); ?>
                        </div>

                        <div class="content__views">
                            <span><i class="far fa-eye"></i></span>
                            <?php echo $post['views'] + 1; ?>
                        </div>
                    </div>
                </div>

                <!-- content -->
                <div class="content__main">
                    <?php echo html_entity_decode($post['content']) ?>
                </div>
            </div>

            <!-- RECENT begin -->
            <div class="recent">
                <div class="recent__title">Gần đây</div>
                <div class="recent-content">
                <?php
                // get recent 3 posts
                    $recents = $post_model->GetPostsByTopicTab($post['topic_id'], 3, 'id');
        foreach ($recents as $recent) { ?>
                        <div class="recent-item">
                        <a href="<?php echo BASE_URL . 'article/' . $recent['id'] . "/" . $recent['slug']?>">
                            <img src="<?php echo '../.' . $recent['image_path'] ?>" alt="" class="recent__img">
                        </a>
                        <div class="recent__label">
                            <a href="<?php echo BASE_URL . 'article/' . $recent['id'] . "/" . $recent['slug']?>">
                                <?php echo $recent['title'] ?>
                            </a>
                        </div>
                        <div class="recent__action">
                            <div class="recent__view">
                                <i class="far fa-eye"></i>
                                <span class="recent__view-label"><?php echo $recent['views'] ?></span>
                            </div>
                            <div class="recent__comment">
                                <i class="far fa-comment"></i>
                                <span class="recent__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($recent['id']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    } ?>
                </div>
            </div>
            <!-- RECENT end -->

            <!-- COMMENT begin -->
            <?php require_once("controllers/CommentController.php"); ?>
            <!-- COMMENT end -->

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