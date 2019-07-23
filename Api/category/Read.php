<?php

header('Access-control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';



$database = new Database();

$db = $database->connection();


//instantiate post class
$cate = new Category($db);

$result = $cate->read();

print_r($result);
$num = $result->rowCount();

if($num > 0){
    $cate_arr = array();
    $cate_arr['data'] = array();
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        $cate_item = array(
            'id'=> $id,
            'title' => $title,
            'body'=> html_entity_decode($body),
            'author'=> $author,
            'created_at'=> $created_at,
            'name' => $category_name
            
        );

        array_push($cate_arr['data'], $cate_item);
    }

    // turn to json  format
    echo json_encode($cate_arr);
}
else{
    echo json_encode(array('message' => 'No post found'));
}
