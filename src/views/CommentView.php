<?php require_once(ROOT_PATH . "/include/db-functions.php"); ?>
<!-- COMMENT begin -->
<div class="comment">
    <div class="grid__row">
        <div class="grid__column-12">
            <div class="comment__title">Bình luận</div>

            <?php
                if (isset($_SESSION['user_id'])) {
                    ?>
                <div class="comment_form">
                    <form action="#comment-list" method="POST">
                        <input type="text" name="post_id" id="post_id" hidden value="<?php echo $post['id'] ?>">
                        <input type="text" name="user_id" id="user_id" hidden value="<?php echo $_SESSION['user_id']; ?>">

                        <textarea name="content" id="content" placeholder="Bình luận..."></textarea>
                        <input type="submit" name="add-comment" id="add-comment" value="Bình luận">
                    </form>
                </div>

            <?php
                } else {
                    // thông báo đăng nhập
                    echo '<p style="margin-bottom: 10px; font-size: 14px; color: red;">Đăng nhập để bình luận.</p>';
                }
            ?>            

            <!-- comment list -->
            <div class="comment-list" id="comment-list">
                <?php
                $parent_comments = $model->getParentCommentsOfPost($post['id']);
                if ($parent_comments) {
                    ?>
                <ul>
                    <?php foreach ($parent_comments as $parent) { ?>
                        <li>
                            <!-- comment info: date & author of comment -->
                            <div class="comment-info">
                                <div class="author">
                                    <span><i class="fas fa-user"></i></span> 
                                    <?php
                                        $author = $user_model->getUserById($parent['user_id']);
                                        echo $author['fullname'];
                                    ?>
                                </div>
                                <div class="date">
                                <?php echo $mysqldate = date('H:i:s d/m/Y', strtotime($parent['create_date'])); ?>
                                </div>
                            </div>
                            <!-- comment content -->
                            <div class="comment-content">
                                <div class="logo">
                                    <span><i class="fas fa-comment-dots"></i></span> 
                                </div>
                                <p><?php echo $parent['content']; ?></p>
                            </div>
                            
                            <?php
                            if (isset($_SESSION['user_id'])) {
                            ?>
                                <div class="comment-action">
                                <?php if (!$parent['IsDeleted']) { ?>
                                    <a href="#" class="reply-btn">Trả lời</a>
                                    <div class="reply_form" style="display: none;">
                                        <form action="#comment-list" method="POST">
                                            <input type="text" name="post_id" id="post_id" hidden value="<?php echo $post['id']; ?>">
                                            <input type="text" name="user_id" id="user_id" hidden value="<?php echo $_SESSION['user_id']; ?>">
                                            <input type="text" name="parent_comment_id" id="parent_comment_id" hidden value="<?php echo $parent['id'] ?>">

                                            <textarea name="content" id="content" placeholder="Trả lời..."></textarea>
                                            <input type="submit" name="add-reply" id="add-reply" value="Trả lời">
                                        </form>
                                    </div>

                                    <?php if (intval($parent['user_id']) === intval($_SESSION['user_id'])) { ?>
                                        <!-- edit comment -->
                                        <a href="#" class="edit-comment-btn">Chỉnh sửa</a>
                                        <div class="reply_form" style="display: none;">
                                            <form action="#comment-list" method="POST">
                                                <input type="text" name="id" id="id" hidden value="<?php echo $parent['id']; ?>">

                                                <textarea name="content" id="content" placeholder="Trả lời..."><?php echo $parent['content']; ?></textarea>
                                                <input type="submit" name="update-reply" id="update-reply" value="Update">
                                            </form>
                                        </div>

                                        <!-- delete comment -->
                                        <div class="comment_form">
                                            <form action="#comment-list" method="POST">
                                                <input type="text" name="id" id="id" hidden value="<?php echo $parent['id']; ?>">
                                                <input type="submit" name="delete-comment" id="delete-comment" value="Xóa" class="del_comment_btn">                                           
                                            </form>
                                        </div>

                                    <?php } ?>
                                <?php
                                } ?>
                                </div>
                            <?php
                            }?>

                            <!-- reply begin -->
                            <?php
                                $replies = $model->getRepliesOfComment($parent['id']);
                                $model->ShowReplies($parent['id'], $replies, $post['id']);
                            ?>
                            <!-- reply end -->

                                
                        </li>
                    <?php
                    }
                }
                    ?>
                </ul>
            </div>
            
        </div>
    </div>
</div>
<!-- COMMENT end -->

<!-- Link trả lời => hiện form trả lời -->
<script>
    $(document).ready(function () {
        var showText = "Trả lời";
        var hideText = "Đóng";
        var editText = "Chỉnh sửa";

        $(".reply-btn").click(function (e) {
            e.preventDefault();

            if ($(this).hasClass("isShown")) {
                $(this).html(showText);
                $(this).removeClass("isShown");
            }
            else {
                $(this).html(hideText);
                $(this).addClass("isShown");
            }
            $(this).next().toggle();
        });

        $(".edit-comment-btn").click(function (e) {
            e.preventDefault();

            if ($(this).hasClass("isShown")) {
                $(this).html(editText);
                $(this).removeClass("isShown");
            }
            else {
                $(this).html(hideText);
                $(this).addClass("isShown");
            }
            $(this).next().toggle();
        });
    });
</script>
