<!-- CATEGORY PAGINATION CONTROLLER -->
<?php
// lấy dữ liệu từ post

// model post
require_once('./models/PostModel.php');

// khai báo model
$post_model = new Post();

// model comment
require_once('./models/CommentModel.php');
$comment_model = new Comment();

// view của home tab
require_once("./views/CategoryDetailView.php");
