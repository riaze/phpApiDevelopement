<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();

$db = $database->connection();
//instantiate post class
$cate = new Category($db);

// get raw data
$data = json_decode(file_get_contents("php://input"));

$cate->id = $data->id;
$cate->name = $data->name;


if($cate->update()){
    echo json_encode(array('messsage' => 'Category Updated'));
}
else{
    echo json_encode(array('messsage' => 'Category Not Updated'));
}