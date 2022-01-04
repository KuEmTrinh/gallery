<?php
include_once "db_conn.php";

$sql_admin = "INSERT INTO tb_user (username, password, name)
VALUES ('admin', '123456','Admin')";
if ($conn->query($sql_admin) === TRUE) {
    echo "ADMIN ACCOUNT CREATED";
} else {
    echo "Error:" . $sql_admin . "<br>" . $conn->error;
}
