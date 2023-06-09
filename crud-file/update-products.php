<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json', 'Charset=UTF-8'); // write this one in every header
include '../database/Database.php';

$obj = new Database();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $data= json_decode(file_get_contents("php://input"));
    $id=$data->id;
    $title=$data->title;
    $content=$data->content;
    $url=$data->url;
    $price=$data->price;
    $rate=$data->rate;

    $obj->update('products', ['title'=>$title,'content'=>$content, 'url'=>$url, 'price'=>$price, 'rate'=>$rate],"id='{$id}'");
    $result=$obj->getResult();
    if ($result[0] == 1) {
        echo json_encode([
            'status' => 1,
            'message' => "Product Add Successfully",
        ]);
    } else {
        echo json_encode([
            'status' => 0,
            'message' => "Server Problem",
        ]);
    }
}else{
    echo json_encode([
        'status' => 0,
        'message' => "Access Denied",
    ]);
}
