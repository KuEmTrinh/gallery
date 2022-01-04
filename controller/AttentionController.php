<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

// Create Attention
if ($received_data->action == 'createAttention') {
    $content = $received_data->content;
    $query = "INSERT INTO tb_atten (content) VALUES('$content')";
    $statement = $connect->prepare($query);
    $statement->execute();
}
// GET Attention
if ($received_data->action == "getAttentions") {
    $query = "SELECT * FROM tb_atten ORDER BY id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $count = 0;
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
        $count++;
    }
    if ($count > 0) {
        echo json_encode($data);
    }
}
//DELETE Attention
if ($received_data->action == 'deleteAttention') {
    $id = $received_data->id;
    $query = "DELETE FROM tb_atten WHERE id = '" . $id . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = "削除しました！";
    echo json_encode($output);
}

//EDIT Attention
if ($received_data->action == 'attentionEdit') {
    $id = $received_data->id;
    $content = $received_data->content;
    $query = "UPDATE tb_atten SET content='$content' WHERE id = '$id' ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = '変更しました';
    echo json_encode($output);
}
