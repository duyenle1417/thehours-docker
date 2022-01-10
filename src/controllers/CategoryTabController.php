<!-- CATEGORY TAB CONTROLLER -->
<?php
// tab lấy dữ liệu từ post

// model post
require_once('./models/PostModel.php');

// khai báo model
$post_model = new Post();

// view của category tab
require_once("./views/CategoryTabView.php");
