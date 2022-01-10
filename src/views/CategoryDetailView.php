<!-- category detail -->
<!-- chứa tab, post pagination -->
<?php
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = intval($_GET['page']);
}
$results_per_page = 4;
$page_first_result = ($page-1) * $results_per_page;
$posts_temp = $post_model->GetPostsByTopic($topic['id']);//tất cả post
$number_of_result = count($posts_temp);
$number_of_page = ceil($number_of_result / $results_per_page);

//post của page thứ n
$posts = $post_model->GetPostsByTopicLimit($topic['id'], $page_first_result, $results_per_page);
//check number of post
$number_of_result_this_page = count($posts);

if ($number_of_result_this_page >=1) { ?>
<div class="category__with_tab">
    <div class="category__content wrap">
        <!-- lấy post từ db -->
        <!-- main new -->
        <div class="main-category">
            <div class="main-news__picture">
                <a href="<?php echo BASE_URL . 'article/' . $posts[0]['id'] . "/" . $posts[0]['slug']?>">
                    <img src="<?php echo '..' . $posts[0]['image_path'] ?>" alt="" class="main-news__picture--img">
                </a>
            </div>
            <div class="main-news__label">
                <a href="<?php echo BASE_URL . 'article/' . $posts[0]['id'] . "/" . $posts[0]['slug']?>">
                    <?php echo $posts[0]['title'] ?>
                </a>
            </div>
            <div class="main-news__action">
                <div class="main-news__view">
                    <i class="far fa-eye"></i>
                    <span class="main-news__view-label"><?php echo $posts[0]['views'] ?></span>
                </div>
                <div class="main-news__comment">
                    <i class="far fa-comment"></i>
                    <span
                        class="main-news__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($posts[0]['id']); ?></span>
                </div>
            </div>
        </div>
        <!-- main new end -->

        <!-- sub new -->
        <?php if ($number_of_result_this_page >=2) {?>
        <div class="sub-category__list">
            <?php for ($i=1; $i < count($posts); $i++) {
    ?>
            <div class="sub-category__item">
                <div class="sub-news__picture">
                    <a href="<?php echo BASE_URL . 'article/' . $posts[$i]['id'] . "/" . $posts[$i]['slug']; ?>">
                        <img src="<?php echo '..' . $posts[$i]['image_path'] ?>" alt="" class="sub-news__picture--img">
                    </a>
                    
                </div>
                <div class="sub-news__info">
                    <div class="sub-news__label">
                        <a href="<?php echo BASE_URL . 'article/' . $posts[$i]['id'] . "/" . $posts[$i]['slug']; ?>">
                            <?php echo $posts[$i]['title']; ?>
                        </a>
                    </div>
                    <div class="sub-news__action">
                        <div class="sub-news__view">
                            <i class="far fa-eye"></i>
                            <span class="sub-news__view-label"><?php echo $posts[$i]['views']; ?></span>
                        </div>
                        <div class="sub-news__comment">
                            <i class="far fa-comment"></i>
                            <span
                                class="sub-news__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($posts[$i]['id']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
} ?>
        </div>
        <!-- sub new end -->
        <?php }?>

    </div>

    <!-- TABS -->
    <?php require_once("controllers/CategoryTabController.php"); ?>
    <!-- TABS END -->
</div>

<!-- page pagination -->
<div class="nav-pagination">
    <!-- Prev btn -->
    <?php if ($page >= 2) { ?>
    <a
        href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($page-1);?>">Prev</a>
    <?php } ?>

    <!-- Number btn & Next btn -->
    <?php if ($page < $number_of_page) {
        $temp = $page + 1;
        for ($i=(($page-1)===0 ? $page : $page-1); $i <= $temp; $i++) {
            if ($i === $page) {?>
            <a class="active"
                href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($i);?>"><?php echo $i; ?></a>
            <?php } else { ?>
            <a
                href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($i);?>"><?php echo $i; ?></a>
            <?php } ?>
            <?php
        } ?>
            <a
                href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($page+1); ?>">Next</a>
            <?php
    } else {
        $temp = $page;
        for ($i=(($page-1)===0 ? $page : $page-1); $i <= $temp; $i++) {
            if ($i === $page) {?>
            <a class="active"
                href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($i);?>"><?php echo $i; ?></a>
            <?php } else { ?>
            <a
                href="<?php echo BASE_URL . "category/" . $topic['id'] . "&page=" . ($i);?>"><?php echo $i; ?></a>
            <?php } ?>
            <?php
        } ?>
            <?php
    } ?>
        </div>
<!-- page pagination end -->


<?php } else {
        //nếu topic không có post nào sẽ hiện default hoặc direct về home
        echo 'HIỆN TẠI DANH MỤC NÀY CHƯA CÓ BÀI VIẾT';
    } ?>