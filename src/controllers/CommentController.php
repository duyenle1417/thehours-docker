<!-- COMMENT CONTROLLER -->
<?php
// lấy dữ liệu từ comment

// model comment
require_once('./models/CommentModel.php');
$model = new Comment();

// view của comment
require_once("./views/CommentView.php");
