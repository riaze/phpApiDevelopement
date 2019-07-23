<?php

header('Access-control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';



$database = new Database();

$db = $database->connection();


//instantiate post class
$cate = new Category($db);

//Get id
$cate->id = isset($_GET['id'])? $_GET['id'] : die();


//get post
$cate->read_single();


$cate_arr = array(
    'id' => $cate->id,
    'title' => $cate->title,
    'body' => $cate->body,
    'author' => $cate->author,
    'post_id'=> $cate->post_id,
    'category_name'=> $cate->category_name

);

print_r(json_encode($cate_arr));


