<?php
include('connectToDB.php');

$id = $_POST['id'];
$name = $_POST['Name'];
$gender = $_POST['gender'];
$phone_number = $_POST['phone_number'];
$profile = $_POST['image'];

$sql = "UPDATE `tbl_employee` SET `name`='$name',`gender`='$gender',`phone_number`='$phone_number',`profile`='$profile' WHERE `id`='$id'";
echo $rs = $connection->query($sql);
