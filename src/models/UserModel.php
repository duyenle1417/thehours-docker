<?php
require_once(ROOT_PATH . "/include/config.php");

class User
{
    // get a user by id
    public function getUserById($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // get all users for admin
    public function GetAllUsers()
    {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    // get all users for admin
    public function GetAllRoles()
    {
        global $conn;
        $sql = "SELECT * FROM roles";
        $result = mysqli_query($conn, $sql);

        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($posts as $post) {
            array_push($final, $post);
        }
        return $final;
    }

    //get role of user
    public function getRoleById($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT `role` FROM roles WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // lấy thông tin user = username
    public function getUserByUsername($username)
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE username = $username";
        $result = mysqli_query($conn, $sql);
        
        $final = mysqli_fetch_array($result);
        return $final;
    }
}
