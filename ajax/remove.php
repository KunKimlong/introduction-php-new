<?php 

    include('connectToDB.php');

    $id = $_POST['id'];

    $rs = $connection->query("DELETE FROM `tbl_employee` WHERE `id`='$id'");
    echo $rs;