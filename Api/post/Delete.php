<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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


if($post->Delete()){
    echo json_encode(array('messsage' => 'Post Delete'));
}
else{
    echo json_encode(array('messsage' => 'Post Not Delete'));
}