<?php

$connection = new mysqli('localhost', 'root', '', 'db_school');
// if($connection){
//     echo "<script>
//         alert('connect to db success')
//     </script>";
// }

function createTeacher()
{
    global $connection;
    if (isset($_POST['btn-submit-teacher'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $profile = $_FILES['profile']['name'];
        $profile = date('d-m-y h-i-s') . '-' . $profile;
        $path = 'assets/profile/' . $profile;

        move_uploaded_file($_FILES['profile']['tmp_name'], $path); //move upload file to folder

        $query = "INSERT INTO `tbl_teacher`(`first_name`, `last_name`, `gender`, `department`, `profile`)
                    VALUES ('$first_name','$last_name','$gender','$department','$profile')";
        $rs = $connection->query($query);
    }
}
createTeacher();

function getTeacher()
{
    global $connection;
    $sql = "SELECT * FROM tbl_teacher";
    $rs = $connection->query($sql);
    while ($row = mysqli_fetch_assoc($rs)) {
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['department'].' Department</td>
                <td>
                    <img src="assets/profile/'.$row['profile'].'" width="150px" height="200">
                </td>
                <td>
                    <a href="updateTeacher.php?id='.$row['id'].'" class="btn btn-warning">Update</a>
                    <button class="btn btn-danger">Update</button>
                </td>
            </tr>
        ';
    }
}

function updateTeacher(){
    global $connection;
    if(isset($_POST['btn-update-teacher'])){
        $update_id = $_POST['id_update'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $profile = $_FILES['profile']['name'];
        if(empty($profile)){
            $profile = $_POST['old_profile'];
        }else{
            $profile = date('d-m-y h-i-s') . '-' . $profile;
            $path = 'assets/profile/' . $profile;
            move_uploaded_file($_FILES['profile']['tmp_name'], $path); //move upload file to folder
        }   

        $sql = "UPDATE `tbl_teacher` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`department`='$department',`profile`='$profile' WHERE `id`=$update_id";

        $rs = $connection->query($sql);
              
    }
}
updateTeacher();