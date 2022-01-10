<?php
require_once(ROOT_PATH . "/include/config.php");

class Category
{
    // get all topics in db
    function getAllTopics()
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM topics";
        $result = mysqli_query($conn, $sql);

        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($topics as $topic) {
            array_push($final, $topic);
        }
        return $final;
    }

    //select parent topic only
    // SELECT * FROM `topics` WHERE `parent_topic_id` IS NULL;
    public function getParentTopics()
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM topics WHERE parent_topic_id IS NULL";
        $result = mysqli_query($conn, $sql);

        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC) or die(mysqli_error($conn));

        $final = array();
        foreach ($topics as $topic) {
            array_push($final, $topic);
        }
        return $final;
    }

    //select sub topic of a parent topic
    // SELECT * FROM `topics` WHERE `parent_topic_id` = '$id';
    public function getSubTopics($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM topics WHERE parent_topic_id = '" .$id. "'";
        $result = mysqli_query($conn, $sql);

        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $final = array();
        foreach ($topics as $topic) {
            array_push($final, $topic);
        }
        return $final;
    }

    // get a topic by id
    // SELECT * FROM `topics` WHERE `id` = $id
    public function getTopicById($id)
    {
        // use global $conn object in function
        global $conn;
        $sql = "SELECT * FROM topics WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        
        $final = mysqli_fetch_array($result);
        return $final;
    }

    // GET TOPIC NAME by ID
    // SELECT `name` FROM `topics` WHERE `id`=$id
    public function getTopicNameByID($id)
    {
        if ($id !== null) {
            // use global $conn object in function
            global $conn;

            $sql = "SELECT `name` FROM topics WHERE `id`=$id";
            $result = mysqli_query($conn, $sql);

            $final = mysqli_fetch_array($result);
            return $final['name'];
        }
    }
}
