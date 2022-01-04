<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
//GET GALLERY
$data = array();
if ($received_data->action == "getContract") {
    $query = "SELECT * FROM tb_contract ORDER BY id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

//DELETE Contract
if ($received_data->action == 'ContractDelete') {
    $id = $received_data->id;
    $query = "DELETE FROM tb_contract WHERE id = '" . $id . "";
    unlink('../' . $received_data->url);
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '削除しました'
    );
    echo json_encode($output);
}

//EDIT Contract
if ($received_data->action == 'ContractEdit') {
    $id = $received_data->id;
    $name = $received_data->name;
    $content = $received_data->content;
    $query = "UPDATE tb_contract SET name='" . $name . ",content='$content' WHERE id = $id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '変更しました'
    );
    echo json_encode($output);
}
?>