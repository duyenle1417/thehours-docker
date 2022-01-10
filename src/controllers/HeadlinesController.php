<!-- HEADLINES CONTROLLER -->
<?php
// lấy dữ liệu từ post

// model post
require_once('./models/PostModel.php');

// khai báo model post
$model = new Post();

// model comment
require_once('./models/CommentModel.php');
$comment_model = new Comment();

// view của main new headlines
require_once("./views/HeadlinesView.php");
