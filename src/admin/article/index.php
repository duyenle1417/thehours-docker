<?php
session_start();
include("../../path.php");

// model post
require_once(ROOT_PATH . '/models/PostModel.php');
$post_model = new Post();

// model category
require_once(ROOT_PATH . '/models/CategoryModel.php');
$topic_model = new Category();

// model user
require_once(ROOT_PATH . '/models/UserModel.php');
$user_model = new User();

require_once(ROOT_PATH . '/admin/include/posts_functions.php');

//check if user's role is ADMIN OR AUTHOR else redirect to unauthorized page
if (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] !== 3) {
    ?>

<?php
    include(ROOT_PATH . '/admin/include/head.php'); ?>
    <title>Quản lý bài viết | Admin TheHours</title>
    
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

            <h2 class="page-title">Post's Dashboard</h2>
            

            <div class="btn"><a href="<?php echo BASE_URL . 'add-post/'?>" class="add-btn">Add</a></div>

            <div class="content">
                <div class="post-table">
                
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <?php if ($_SESSION['user_role_id'] === 1) { ?>
                                <th>Author</th>
                                <?php } ?>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($_SESSION['user_role_id'] ===1) {
                                $posts = $post_model->GetAllPosts();
                            } else {
                                $posts = $post_model->getPostsOfAuthor($_SESSION['user_id']);
                            }
    $STT = 1;
    foreach ($posts as $post) {?>

                            <tr>
                                <td><?php echo $STT; ?></td>
                                <!-- title -->
                                <td class="post_title">
                                    <span style="font-weight: 500;"><?php echo $post['title']; ?></span>
                                </td>
                                <!-- topic -->
                                <td class="topic_name">
                                    <?php echo $topic_model->getTopicNameByID($post['topic_id']); ?>
                                </td>
                                <!-- author -->
                                <?php if ($_SESSION['user_role_id'] === 1) {
        $user = $user_model->getUserById($post['user_id']); ?>
                                    <td class="author">
                                    <?php echo $user['username']. ' - ' . $user['fullname']; ?>
                                    </td>
                                <?php
    }; ?>
                                <!-- thao tác -->
                                <td class="thaotac">
                                    <div class="btn-group">
                                        <a href="<?php echo BASE_URL . 'edit-post/' . $post['id']; ?>" class="edit-btn">Edit</a>
                                        <a href="<?php echo BASE_URL . 'delete-post/'. $post['id']; ?>"
                                            class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Delete</a>
                                        <a href="<?php echo BASE_URL . 'publish-toggle/' . $post['id'] . '/' . ($post['IsPublished'] ? 0 : 1) ?>" class="publish-btn">
                                            <?php echo(!$post['IsPublished'] ? 'Published' : 'Unpublished') ?>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                            <?php
                        $STT++;
                        }; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            
        </div>
        <!-- // Admin Content -->
    </div>
    <!--// Admin Page Wrapper -->
    <div class="admin">
        hello
    </div>
</body>
</html>
<?php
} else {
                            header('location: ' . BASE_URL);
                        }?>