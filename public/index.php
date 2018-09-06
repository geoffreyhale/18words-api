<?php

require_once '../lib/database.class.php';
require_once '../lib/api.class.php';

$db = new Database();
$api = new Api($db);

if (isset($_POST['user_id']) && isset($_POST['post'])) {
    $user_id = $_POST['user_id'];
    $post = $_POST['post'];
    $date = date("Y-m-d");

    $result = $api->submitPost($user_id, $post, $date);

    echo $result;

} else {
    $posts = $api->getAllPosts();

    echo json_encode($posts);
}