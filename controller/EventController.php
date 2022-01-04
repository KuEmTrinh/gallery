<?php
$connect = new PDO("mysql:host=localhost;dbname=gallery", "root", "");
$received_data = json_decode(file_get_contents("php://input"));

//GET EVENT
$data = array();
if ($received_data->action == "getEvents") {
    $query = "SELECT * FROM tb_event ORDER BY time ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

//DELETE EVENT
if ($received_data->action == 'deleteEvents') {
    $id = $received_data->id;
    $query = "DELETE FROM tb_event WHERE id = '" . $id . "'";
    unlink('../' . $received_data->url);
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '削除できました!'
    );
    echo json_encode($output);
}
//Edit Event
if ($received_data->action == "editEvent") {
    $id = $received_data->id;
    $name = $received_data->name;
    $content = $received_data->content;
    $time_start = $received_data->time_start;
    $time_end = $received_data->time_end;
    $artist = $received_data->artist;
    $query = "UPDATE tb_event SET name='$name' , content='$content' , time_start='$time_start' , time_end='$time_end' , artist='$artist' WHERE id=$id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array(
        'mess' => '変更出来ました！'
    );
    echo json_encode($output);
}
