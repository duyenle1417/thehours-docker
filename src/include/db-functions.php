<?php
require('config.php');

$errors = array();


// *************
// POST'S functions
// ************

function validatePost($post)
{
    $errors = array();

    // title trống?
    if (empty($post['title'])) {
        array_push($errors, 'Phải nhập tiêu đề bài viết');
    }

    // content trống?
    if (empty($post['content'])) {
        array_push($errors, 'Phải nhập nội dung bài viết');
    }

    // danh mục trống?
    if (empty($post['topic_id'])) {
        array_push($errors, 'Hãy chọn topic cho bài viết');
    }

    // trùng title?
    $existingPost = selectOne('posts', ['title' => $post['title']]);
    if ($existingPost) {
        if (isset($post['update-post']) && $existingPost['id'] != $post['id']) {
            array_push($errors, 'Tiêu đề này đã tồn tại, vui lòng nhập tiêu đề khác');
        }

        if (isset($post['add-post'])) {
            array_push($errors, 'Tiêu đề này đã tồn tại, vui lòng nhập tiêu đề khác');
        }
    }
    return $errors;
}

// *************
// TOPIC'S functions
// ************
function validateTopic($topic)
{
    $errors = array();

    // tên trống?
    if (empty($topic['name'])) {
        array_push($errors, 'Không được để trống tên topic');
    }

    // danh mục cha trống?
    if (empty($topic['parent_topic_id'])) {
        if (isset($topic['add-topic'])) {
            array_push($errors, 'Hãy chọn danh mục cha');
        }
    }
    
    // trùng tên topic?
    $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic) {
        if (isset($post['update-topic']) && $existingTopic['id'] != $topic['id']) {
            array_push($errors, 'Tên topic này đã có sẵn, vui lòng chọn tên khác');
        }

        if (isset($post['add-topic'])) {
            array_push($errors, 'Tên topic này đã có sẵn, vui lòng chọn tên khác');
        }
    }
    return $errors;
}



// *************
// USER'S functions
// ************

//validate dữ liệu nhập khi tạo user
function validateUser($user)
{
    $errors = array();
    // email trống?
    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }

    // tên trống?
    if (empty($user['fullname'])) {
        array_push($errors, 'Fullname is required');
    }

    // chỉ xét đk bên trong khi đăng ký/tạo user mới
    if (isset($_POST['register-btn']) || isset($user['create-user'])) {
        // username trống?
        if (empty($user['username'])) {
            array_push($errors, 'Username is required');
        }

        // password trống?
        if (empty($user['password'])) {
            array_push($errors, 'Password is required');
        }

        // nhập lại pass sai?
        if ($user['passwordConf'] !== $user['password']) {
            array_push($errors, 'Password do not match');
        }

        // trùng username trong hệ thống?
        $existingUser = selectOne('users', ['username' => $user['username']]);
        if ($existingUser) {
            array_push($errors, 'Username already exists');
        }
    }

    // kiểm tra có trùng email không?
    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if (isset($user['update-user']) && $existingUser['id'] != $user['id']) {
            array_push($errors, 'Email already exists');
        }

        if (isset($_POST['register-btn']) || isset($user['create-user'])) {
            array_push($errors, 'Email already exists');
        }
    }

    
    return $errors;
}

// valdate khi login
function validateLogin($user)
{
    $errors = array();
    // username trống?
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    // pass trống?
    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
}

// nhấn nút login
if (isset($_POST['login-btn'])) {
    // kiểm tra values
    $errors = validateLogin($_POST);
    if (count($errors) === 0) {
        $user = selectOne('users', ['username' => $_POST['username'], 'IsActivated' => 1]);

        // tài khoản có thực và mật khẩu trùng thì đăng nhập thành công
        if ($user && md5($_POST['password']) === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_role_id'] = $user['role_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_fullname'] = $user['fullname'];
            
            header('location: ' . BASE_URL);//direct đến home
            exit(0);
        } elseif ($user) {
            array_push($errors, 'Sai thông tin đăng nhập');
        } else {
            array_push($errors, 'Tài khoản không tồn tại');
        }
    }
}

// register user or add new user
if (isset($_POST['register-btn']) || isset($_POST['create-user'])) {
    // kiểm tra values
    $errors = validateUser($_POST);
    // nếu không có lỗi values sẽ xử lý tiếp
    if (count($errors) === 0) {
        unset($_POST['passwordConf']);
        $_POST['password'] = md5($_POST['password']);
        $_POST['verification_hash'] = md5(time());
        
        // nếu là admin thêm user
        if (isset($_POST['create-user'])) {
            $sql = "INSERT INTO users (`email`, `username`, `password`, `fullname`, `role_id`, `verification_hash`, `IsActivated`) 
            VALUES ('".$_POST['email']."', '".$_POST['username']."', '".$_POST['password']."', '".$_POST['fullname']."', '".$_POST['role_id']."', '".$_POST['verification_hash']."', 1)";
        
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header('location: ' . BASE_URL . 'manage-users/');
                exit();
            }
        }

        // nếu là đăng ký mới ở trang signup.php
        if (isset($_POST['register-btn'])) {
            $_POST['role_id'] = 3;
            $sql = "INSERT INTO users (`email`, `username`, `password`, `fullname`, `role_id`, `verification_hash`, `IsActivated`) 
            VALUES ('".$_POST['email']."', '".$_POST['username']."', '".$_POST['password']."', '".$_POST['fullname']."', '".$_POST['role_id']."', '".$_POST['verification_hash']."', 1)";
            
            $result = mysqli_query($conn, $sql);
            
            // nếu thêm dữ liệu thành công
            if ($result) {
                SendMailRegister($_POST);

                // lấy dũ liệu user
                $user = selectOne('users', ['username' => $_POST['username']]);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_username'] = $user['username'];
                $_SESSION['user_role_id'] = $user['role_id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_fullname'] = $user['fullname'];
            
                // quay về home
                header('location: ' . BASE_URL);
                exit();
            }
        }
    }
}

// send mail
function SendMailRegister($user)
{
    $to = $_POST['email'];
    $subject = 'Signup Verification - TheHours';
    $message = '
  
    Cảm ơn '.$user['fullname'].' đã đăng ký tài khoản trên TheHours!
    Tài khoản của bạn đã được tạo, vui lòng truy cập đường link sau để xác thực tài khoản
    
    ------------------------
    Username: '.$user['username'].'
    Fullname: '.$user['fullname'].'
    ------------------------
  
';
    $headers = 'From:noreply@thehours.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}

/* Select custom */
function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";

    $i = 0;
    // điều kiện
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }
    // chỉ lấy 1 kết quả
    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

// thực thi query
function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}


// *************
// COMMENT'S functions
// ************

// add reply (có thêm trường parent comment id)
if (isset($_POST['add-reply'])) {
    global $conn;

    if (!empty($_POST['content'])) {
        $sql = "INSERT INTO comments (`content`,`post_id`, `user_id`, `parent_comment_id`) 
        VALUES ('".$_POST['content']."', '".$_POST['post_id']."', '".$_POST['user_id']."', '".$_POST['parent_comment_id']."')";
        $result = mysqli_query($conn, $sql);
    }
}

// add comment (parent comment id = NULL)
if (isset($_POST['add-comment'])) {
    global $conn;

    if (!empty($_POST['content'])) {
        $sql = "INSERT INTO comments (`content`,`post_id`, `user_id`) 
        VALUES ('".$_POST['content']."', '".$_POST['post_id']."', '".$_POST['user_id']."')";
        $result = mysqli_query($conn, $sql);
    }
}

// update a comment
if (isset($_POST['update-reply'])) {
    global $conn;

    if (!empty($_POST['content'])) {
        $sql = "UPDATE comments SET `content`"."='".$_POST['content']."' WHERE id='".$_POST['id']. "'";
        $result = mysqli_query($conn, $sql);
    }
}

// delete a comment (update content and set IsDeleted = 0)
if (isset($_POST['delete-comment'])) {
    global $conn;
    $sql = "UPDATE comments SET `content`"."='<p><i>Bình luận này đã bị xóa</i></p>', `IsDeleted` = '1' WHERE id='".$_POST['id']. "'";
    $result = mysqli_query($conn, $sql);
}
