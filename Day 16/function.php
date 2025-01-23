<?php

$hostname = 'localhost'; #127.0.0.1;
$username = 'root';
$password = '';
$database = 'db_company';

$connection = new mysqli($hostname, $username, $password, $database);

// print_r($connection); //test connection

if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO `tbl_employee`(`first_name`, `last_name`, `gender`, `position`, `salary`)
            VALUES ('$first_name','$last_name','$gender','$position','$salary')";

    $connection->query($sql); // execute query
}
