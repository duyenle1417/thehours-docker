<?php
include("path.php");
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['user_email']);
unset($_SESSION['user_username']);
unset($_SESSION['user_fullname']);
unset($_SESSION['user_role_id']);
session_destroy();

header('location: ' . BASE_URL);