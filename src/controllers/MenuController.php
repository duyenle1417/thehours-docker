<!-- MENU CONTROLLER -->
<?php
// menu lấy dữ liệu từ category/topic

// model topic
require_once('./models/CategoryModel.php');

// khai báo model menu
$model = new Category();

// view của menu
require_once("./views/MenuView.php");
