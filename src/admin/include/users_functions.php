<?php

//update user
if (isset($_POST['update-user'])) {
    global $conn;
    // kiểm tra values
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-user']);
        $sql = "UPDATE users SET `fullname`"."='".$_POST['fullname']."', email = '".$_POST['email']."', role_id = '".$_POST['role_id']."' WHERE id='".$_POST['id']. "'";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: ' . BASE_URL . 'manage-users/');
            exit(0);
        }
    }
}

//change pass
if (isset($_POST['change-password'])) {
    global $conn;
    // validate password
    if (empty($_POST['Oldpassword'])) {
        array_push($errors, 'Current password is required');
    } else {
        require_once('./models/UserModel.php');
        $user_model = new User();
        $user = $user_model->getUserById($_POST['id']);
        $pass = $user['password'];
        if (md5($_POST['Oldpassword']) !== $pass) {
            array_push($errors, 'Current password is wrong');
        }
    }
    
    // new pass trống?
    if (empty($_POST['password'])) {
        array_push($errors, 'New password is required');
    }

    // nhập lại pass sai?
    if ($_POST['passwordConf'] !== $_POST['password']) {
        array_push($errors, 'Password do not match');
    }

    // nếu không có lỗi sẽ đổi pass
    if (count($errors) === 0) {
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $sql = "UPDATE users SET `password`"."='".$password."' WHERE id='".$_POST['id']. "'";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            array_push($errors, 'Chỉnh sửa thành công!');
            // exit(0);
        }
    }
}

//update user profile
if (isset($_POST['update-user-profile'])) {
    global $conn;
    // kiểm tra values
    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-user']);
        if (isset($_POST['role_id'])) {
            $sql = "UPDATE users SET `fullname`"."='".$_POST['fullname']."', email = '".$_POST['email']."', role_id = '".$_POST['role_id']."' WHERE id='".$_POST['id']. "'";
        } else {
            $sql = "UPDATE users SET `fullname`"."='".$_POST['fullname']."', email = '".$_POST['email']."' WHERE id='".$_POST['id']. "'";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            array_push($errors, 'Chỉnh sửa thành công!');
        }
    }
}

// delete user
if (isset($_GET['delete_id'])) {
    global $conn;
    $id=$_GET['delete_id'];
    $sql = "DELETE FROM users WHERE id=$id";
    
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: ' . BASE_URL . 'manage-users/');
        exit(0);
    }
}
