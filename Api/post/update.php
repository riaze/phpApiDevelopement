<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();

$db = $database->connection();
//instantiate post class
$post = new Post($db);

// get raw data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if($post->update()){
    echo json_encode(array('messsage' => 'Post Updated'));
}
else{
    echo json_encode(array('messsage' => 'Post Not Updated'));
}