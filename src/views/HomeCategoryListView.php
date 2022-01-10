<?php $topics_parent = $topic_model->getParentTopics();
    foreach ($topics_parent as $topic) {
        // get post
        $post_main = $post_model->GetPostsByTopicLimit($topic['id'], 0, 1);
        $post_sub = $post_model->GetPostsByTopicLimit($topic['id'], 1, 3);
        
        if (count($post_main)>=1) {
            ?>
<!-- begin TOPIC -->
<div class="category">
    <!-- heading category -->
    <h2 class="category__heading"><a href="category/<?php echo $topic['id'] ?>"
            style="text-decoration: none;"><?php echo $topic_model->getTopicNameByID($topic['id']) ?></a></h2>
    <div class="category__content">
        <!-- main new -->
        <div class="grid__column-6 main-category">
            <div class="main-news__picture">
                <a
                    href="<?php echo BASE_URL . 'article/' . $post_main[0]['id'] . "/" . $post_main[0]['slug']?>">
                    <img src="<?php echo '.' . $post_main[0]['image_path']; ?>" alt="" class="main-news__picture--img">
                </a>
            </div>
            <div class="main-news__label">
                <a
                    href="<?php echo BASE_URL . 'article/' . $post_main[0]['id'] . "/" . $post_main[0]['slug']?>">
                    <?php echo $post_main[0]['title'] ?>
                </a>
            </div>
            <div class="main-news__action">
                <div class="main-news__view">
                    <i class="far fa-eye"></i>
                    <span class="main-news__view-label"><?php echo $post_main[0]['views'] ?></span>
                </div>
                <div class="main-news__comment">
                    <i class="far fa-comment"></i>
                    <span
                        class="main-news__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($post_main[0]['id']); ?></span>
                </div>
            </div>
        </div>
        <!-- main new end -->

        <!-- SUB NEW LIST -->
        <div class="grid__column-6 sub-category__list">
            <?php
                foreach ($post_sub as $post) { ?>
            <div class="sub-category__item">
                <div class="sub-news__picture">
                    <a href="<?php echo BASE_URL . 'article/' . $post['id'] . "/" . $post['slug']?>">
                        <img src="<?php echo '.' . $post['image_path'] ?>" alt="" class="sub-news__picture--img">
                    </a>
                </div>
                <div class="sub-news__info">
                    <div class="sub-news__label">
                        <a href="<?php echo BASE_URL . 'article/' . $post['id'] . "/" . $post['slug']?>">
                            <?php echo $post['title'] ?>
                        </a>
                    </div>
                    <div class="sub-news__action">
                        <div class="sub-news__view">
                            <i class="far fa-eye"></i>
                            <span class="sub-news__view-label"><?php echo $post['views'] ?></span>
                        </div>
                        <div class="sub-news__comment">
                            <i class="far fa-comment"></i>
                            <span
                                class="sub-news__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($post['id']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            } ?>
        </div>
        <!-- end TOPIC -->

    </div>
</div>
<?php
        }
    }
?>