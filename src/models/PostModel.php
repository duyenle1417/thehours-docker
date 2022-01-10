<?php
require_once(ROOT_PATH . "/include/config.php");

class Post
{
    // when user click a post/open link => views = views +1
    // UPDATE posts SET `views` = $views WHERE id='$id'
    public function UpdateView($id, $views)
    {
        global $conn;
        $sql = "UPDATE posts SET `views`"."=" . $views . "  WHERE id='" . $id . "'";
        $result = mysqli_query($conn, $sql);
    }

    // get all post for admin
    // SELECT * FROM `posts` ORDER BY `id` DESC
    public function GetAllPosts()
    {
        global $conn;
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // select post theo topic (nếu có topic con thì show luôn)
    // SELECT * FROM `posts` WHERE `posts`.`topic_id` IN
    // (SELECT `topics`.`id` FROM `topics` WHERE `topics`.`id` = 4 OR `topics`.`parent_topic_id` = 4)
    public function GetPostsByTopic($topic_id)
    {
        global $conn;
        $sql = "SELECT * FROM `posts` WHERE IsPublished = 1 AND `topic_id` IN 
        (SELECT `id` FROM `topics` WHERE `id` = " . $topic_id . " OR `topics`.`parent_topic_id` = " . $topic_id . ")";
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // pagination get post of each topic
    // SELECT * FROM `posts` WHERE IsPublished = 1 AND `topic_id` IN 
    // (SELECT `id` FROM `topics` WHERE `id` = " . $topic_id . " OR `topics`.`parent_topic_id` = " . $topic_id . ")
    // ORDER BY `id` DESC LIMIT 0, 4;
    public function GetPostsByTopicLimit($topic_id, $page_first_result, $results_per_page)
    {
        global $conn;
        $sql = "SELECT * FROM `posts` WHERE IsPublished = 1 AND `topic_id` IN 
        (SELECT `id` FROM `topics` WHERE `id` = " . $topic_id . " OR `topics`.`parent_topic_id` = " . $topic_id . ") ORDER BY `id` DESC LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // get posts for tab
    // from specific topic id
    public function GetPostsByTopicTab($topic_id, $results_number, $orderby)
    {
        global $conn;
        $sql = "SELECT * FROM `posts` WHERE IsPublished = 1 AND `topic_id` IN 
    (SELECT `id` FROM `topics` WHERE `id` = " . $topic_id . " OR `topics`.`parent_topic_id` = " . $topic_id . ") ORDER BY `" . $orderby . "` DESC LIMIT " . $results_number;
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // get posts for tab in index.php
    // from all topics
    public function GetPostsTab($results_number, $orderby)
    {
        global $conn;
        $sql = "SELECT * FROM `posts` WHERE IsPublished = 1 ORDER BY `" . $orderby . "` DESC LIMIT " . $results_number;
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // lấy 1 post mới nhất
    // headlines
    public function getPostHeadline()
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM `posts` WHERE IsPublished = 1 ORDER BY `id` DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
    
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // get a post by id for article.php
    // SELECT * FROM posts WHERE IsPublished = 1 AND id = $id
    public function getPublishedPostById($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE IsPublished = 1 AND id = $id";
        $result = mysqli_query($conn, $sql);
    
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // get a post by id for edit post
    // SELECT * FROM posts WHERE id = $id
    public function getPostById($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE id = $id";
        $result = mysqli_query($conn, $sql);
    
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // get post by that author
    public function getPostsOfAuthor($user_id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM posts WHERE user_id = $user_id ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
    
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // Tạo slug cho bài viết
    public function createSlug($title)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');//set timezone
        // pattern
        $search = array(
            // xét cả hoa/thường
            '/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/i',
            '/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/i',
            '/ì|í|ị|ỉ|ĩ/i',
            '/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/i',
            '/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/i',
            '/ỳ|ý|ỵ|ỷ|ỹ/i',
            '/đ/i',
            "/[\ \_]/",//dấu cách và '_' sẽ thành '-'
            "/[^a-zA-Z0-9\-]/",/* các ký tự khác không nằm trong a-z A-Z 0-9, dấu '-' sẽ bị loại bỏ' */
            
        );
        // replacement
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            '-',
            ''
        );

        $string = preg_replace($search, $replace, $title);//thay thế chữ tiếng việt có dấu,etc...
        $string = preg_replace('/(-)+/', '-', $string);//chuyển nhiều '-' thành 1 dấu '-'
        $string = trim($string, '-');//loại bỏ các ký tự '-' dư ở đầu và cuối
        $string = strtolower($string);//chữ thường
        return $string;
    }
}
