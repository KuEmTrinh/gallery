<?php
include 'admin_header.php';
include 'db_conn.php';
?>

<form action="admin_contract_upload.php" method="post" enctype="multipart/form-data">

    <input type="file" name="file" size="50" />

    <br />

    <input type="submit" value="Upload" />

</form>
<?php require "footer.php"; ?>