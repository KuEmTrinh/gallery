<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

//GET NOTICE
$data = array();
if ($received_data->action == 'getNotice') {
    $query = "SELECT * FROM tb_notice ORDER BY time DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

//GET NOTICE 3
$data = array();
if ($received_data->action == 'getNoticeThree') {
    $query = "SELECT * FROM tb_notice ORDER BY time DESC LIMIT 3";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
