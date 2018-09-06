<?php

require_once '../lib/database.class.php';

class Api
{
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $db = $this->db;
        $query = 'SELECT username, `date`, post FROM posts
              JOIN users ON users.id = posts.user_id
              ORDER BY `date` DESC';
        $db->query($query);
        $posts = $db->resultset();

        return $posts;
    }

    public function submitPost($user_id, $post, $date) {
        if (empty($post)) {
            return 'post is empty';
        }
        $db = $this->db;
        $query = 'INSERT INTO `posts` (user_id, post, `date`)
              VALUES (:user_id, :post, :date)';
        $db->query($query);
        $db->bind(':user_id', $user_id);
        $db->bind(':post', $post);
        $db->bind(':date', $date);
        $result = $db->execute();
        return $result;
    }
}