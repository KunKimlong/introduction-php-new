<?php

$connection = new mysqli('localhost', 'root', '', 'db_school');
// if($connection){
//     echo "<script>
//         alert('connect to db success')
//     </script>";
// }

function showSweetAlert($title, $text, $icon){
    echo '
        <script>
            Swal.fire({
                title: "'.$title.'",
                text: "'.$text.'",
                icon: "'.$icon.'"
            });
        </script>
    ';
}

function createTeacher()
{
    global $connection;
    if (isset($_POST['btn-submit-teacher'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $profile = $_FILES['profile']['name'];
        
        if(!empty($first_name) && !empty($last_name) && !empty($gender) && !empty($department) && !empty($profile)){
            $profile = date('d-m-y h-i-s') . '-' . $profile;
            $path = 'assets/profile/' . $profile;
            move_uploaded_file($_FILES['profile']['tmp_name'], $path); //move upload file to folder

            $query = "INSERT INTO `tbl_teacher`(`first_name`, `last_name`, `gender`, `department`, `profile`)
                        VALUES ('$first_name','$last_name','$gender','$department','$profile')";
            $rs = $connection->query($query);
            if($rs){
                showSweetAlert("Insert Success","Teacher Insert Successfully","success");
            }
        }
        else{
            showSweetAlert("Insert Error", "Please input all fields"," error");
        }
        
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
                    <button class="btn btn-danger" id="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteTeacher">Delete</button>
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
        if(!empty($first_name) && !empty($last_name) && !empty($gender) && !empty($department) ){
            $sql = "UPDATE `tbl_teacher` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`department`='$department',`profile`='$profile' WHERE `id`=$update_id";

            $rs = $connection->query($sql);
            if($rs){
                showSweetAlert("Update Success", "Teacher Update successfully","success");
            }
        }
        else{
            showSweetAlert("Update Error", "Teacher update Error", "error");
        }
              
    }
}
updateTeacher();//calling function 


function removeTeacher(){
    global $connection;
    if(isset($_POST['btn-remove-teacher'])){
        $id = $_POST['remove_value'];
        $rs = $connection->query("DELETE FROM `tbl_teacher` WHERE `id`=$id");
        if($rs){
           showSweetAlert("Delete Success", "Teacher Delete Successfully","success");
        }
    }
}
removeTeacher();

// get all teacher full name and id to display as option for adding student
function getTeacherToOption(){
    global $connection;
    $sql = "SELECT `id`, `first_name`, `last_name`,`gender` FROM `tbl_teacher` ORDER BY `id` DESC";
    $rs  = $connection->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        $prefix = $row['gender'] == "Male" ? "Mr. ": "Ms. ";
        echo '<option value="'.$row['id'].'">'.$prefix.$row['first_name'].' '.$row['last_name'].'</option>';
    }
}

// add student to database
function createStudent(){
    global $connection;
    // print_r($_POST);
    if(isset($_POST['btn-submit-student'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $teacher = $_POST['teacher'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone_number = $_POST['phone_number'];
        $profile = $_FILES['profile']['name'];

        if(!empty($first_name) && !empty($last_name) 
            && !empty($gender) && !empty($teacher)
            && !empty($email) && !empty($date_of_birth)
            && !empty($phone_number) && !empty($profile)
        ){

            $profile = rand(1,99999).'-'.$profile;
            $path = 'assets/profile/'.$profile;
            move_uploaded_file($_FILES['profile']['tmp_name'],$path);

            $sql = "INSERT INTO `tbl_students`(`first_name`, `last_name`, `gender`, `email`, `date_of_birth`, `phone_number`, `profile`, `teacher_id`) 
            VALUES ('$first_name','$last_name','$gender','$email','$date_of_birth','$phone_number','$profile','$teacher')";

            $rs  = $connection->query($sql);
            if($rs){
                showSweetAlert("Insert Success","Student insert success fully","success");
            }
        }
        else{
            showSweetAlert("Insert Error","Please input all student field","error");
        }
    }

}
createStudent();

function getStudent(){
    global $connection;
    $rs = $connection->query("SELECT * FROM `tbl_students` ORDER BY `id` DESC");
    while($row = mysqli_fetch_assoc($rs)){
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone_number'].'</td>
                <td>'.$row['teacher_id'].'</td>
                <td>'.$row['date_of_birth'].'</td>
                <td>
                    <img src="assets/profile/'.$row['profile'].'" width="150px" height="200">
                </td>
                <td>
                    <a href="updateTeacher.php?id='.$row['id'].'" class="btn btn-warning">Update</a>
                    <button class="btn btn-danger" remove-id="'.$row['id'].'" id="btn-delete-student" data-bs-toggle="modal" data-bs-target="#deleteStudent">Delete</button>
                </td>
            </tr>
        ';
    }
}

function removeStudent(){
    global $connection;
    if(isset($_POST['btn-remove-student'])){
        $id = $_POST['remove_value'];

        $rs = $connection->query("DELETE FROM `tbl_students` WHERE `id`='$id'");
        if($rs){
            showSweetAlert("Remove Success","Student has been removed from class","success");
        }
    }
}
removeStudent();