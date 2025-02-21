<?php 
include('connectToDB.php');

echo $id = $_POST['id'];
echo $name = $_POST['Name'];
echo $gender = $_POST['gender'];
echo $phone_number = $_POST['phone_number'];
echo $profile = $_POST['image'];

// $sql = "UPDATE `tbl_employee` SET `name`='$name', `gender`='$gender',`phone_number`='$phone_number', `profile`='$profile' WHERE `id`='$id'";
$sql = "UPDATE `tbl_employee` SET `name`='$name',`gender`='$gender',`phone_number`='$phone_number',`profile`='$profile' WHERE `id`='$id'";
$rs = $connection->query($sql);

echo $rs;