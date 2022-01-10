<div class="main-news">
    <?php $post = $model->getPostHeadline(); ?>
    <div class="main-news__picture">
        <a href="<?php echo BASE_URL . 'article/' . $post['id'] . "/" . $post['slug'] ?>">
            <img src="<?php echo '.' . $post['image_path'] ?>" alt="" class="main-news__picture--img">
        </a>
    </div>
    <div class="main-news__label">
        <a
            href="<?php echo BASE_URL . 'article/' . $post['id'] . "/" . $post['slug']?>"><?php echo $post['title'] ?></a>
    </div>
    <div class="main-news__action">
        <div class="main-news__view">
            <i class="far fa-eye"></i>
            <span class="main-news__view-label"><?php echo $post['views'] ?></span>
        </div>
        <div class="main-news__comment">
            <i class="far fa-comment"></i>
            <span
                class="main-news__comment-label"><?php echo $comment_model->getCommentsNumberOfPost($post['id']); ?></span>
        </div>
    </div>
</div>