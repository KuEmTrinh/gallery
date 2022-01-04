<?php
$connect = new PDO("mysql:host=localhost;dbname=git_gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

//CREATE POST
if($received_data->action == 'create'){
    $title = $received_data->title;
    $content = $received_data->content;
    $query = "INSERT INTO post (title,content) VALUES('$title','$content')";
    $statement = $connect->prepare($query);
    $statement->execute();
    echo json_encode($content);
}