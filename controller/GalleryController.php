<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

//GET GALLERY
$data = array();
if ($received_data->action == "getGallerys") {
    $query = "SELECT * FROM tb_photo ORDER BY id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

//DELETE GALLERY
if ($received_data->action == 'galleryDelete') {
    $id = $received_data->id;
    $query = "DELETE FROM tb_photo WHERE id = '" . $id . "'";
    unlink('../' . $received_data->url);
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '削除しました'
    );
    echo json_encode($output);
}

//EDIT GALLERY
if ($received_data->action == 'galleryEdit') {
    $name = $received_data->name;
    $id = $received_data->id;
    $query = "UPDATE tb_photo SET name='" . $name . "' WHERE id = '" . $id . "'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '変更しました'
    );
    echo json_encode($output);
}
