<?php

    include('connectToDB.php');

    $name = $_POST['Name'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $profile = $_POST['profile'];
    $sql = "INSERT INTO `tbl_employee`(`name`, `gender`, `phone_number`, `profile`) 
                                VALUES ('$name','$gender','$phone_number','$profile')";
    $rs = $connection->query($sql);

    if($rs){
        $rs_id = $connection->query("SELECT `id` FROM `tbl_employee` ORDER BY `id` DESC LIMIT 1");
        $row = mysqli_fetch_assoc($rs_id);
        echo $row['id'];
    }

