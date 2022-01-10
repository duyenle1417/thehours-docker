<!-- HOME TAB CONTROLLER -->
<?php
// tab lấy dữ liệu từ post

// model post
require_once('./models/PostModel.php');

// khai báo model
$model = new Post();

// view của home tab
require_once("./views/HomeTabView.php");
