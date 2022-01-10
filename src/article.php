<?php
session_start();
// PHP include/require
include("path.php");
require_once(ROOT_PATH . "/include/db-functions.php");


// controller
require_once("controllers/ArticleDetailController.php");
