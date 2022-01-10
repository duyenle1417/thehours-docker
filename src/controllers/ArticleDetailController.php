<!-- ARTICLE DETAIL CONTROLLER -->
<?php

// model post
require_once(ROOT_PATH . '/models/PostModel.php');
$post_model = new Post();

// model category
require_once(ROOT_PATH . '/models/CategoryModel.php');
$topic_model = new Category();

// model user
require_once(ROOT_PATH . '/models/UserModel.php');
$user_model = new User();

// model comment
require_once('./models/CommentModel.php');
$comment_model = new Comment();

// view article detail
require_once(ROOT_PATH . '/views/ArticleDetailView.php');
