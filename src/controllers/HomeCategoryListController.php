<!-- HOME CATEGORY LIST CONTROLLER -->
<?php
// tab lấy dữ liệu từ post

// model post
require_once('./models/PostModel.php');
// model topic
require_once('./models/CategoryModel.php');

// khai báo model
$post_model = new Post();
$topic_model = new Category();

// model comment
require_once('./models/CommentModel.php');
$comment_model = new Comment();

// view của home category list
require_once("./views/HomeCategoryListView.php");
