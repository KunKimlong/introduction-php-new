<?php

date_default_timezone_set('Asia/Phnom_Penh');

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
function getTeacherToOption($teacher_id=0){
    global $connection;
    $sql = "SELECT `id`, `first_name`, `last_name`,`gender` FROM `tbl_teacher` ORDER BY `id` DESC";
    $rs  = $connection->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        $prefix = $row['gender'] == "Male" ? "Mr. ": "Ms. ";
        $selected = $row['id'] == $teacher_id ? "selected" : "";
        echo '<option value="'.$row['id'].'" '.$selected.'>'.$prefix.$row['first_name'].' '.$row['last_name'].'</option>';
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
    $sql = "SELECT `t_s`.*,`t_t`.`first_name` AS `t_first_name`,`t_t`.`last_name` AS `t_last_name` FROM `tbl_students` AS `t_s` 
            INNER JOIN `tbl_teacher` AS `t_t` ON `t_s`.`teacher_id` = `t_t`.`id` ORDER BY `t_s`.`id` DESC";
    $rs = $connection->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
        echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['first_name'].'</td>
                <td>'.$row['last_name'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone_number'].'</td>
                <td>'.$row['t_first_name'].' '.$row['t_last_name'].'</td>
                <td>'.$row['date_of_birth'].'</td>
                <td>
                    <img src="assets/profile/'.$row['profile'].'" width="150px" height="200">
                </td>
                <td>
                    <a href="updateStudent.php?id='.$row['id'].'" class="btn btn-warning">Update</a>
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

function updateStudent(){
    global $connection;
    if(isset($_POST['btn-update-student'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $teacher = $_POST['teacher'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone_number = $_POST['phone_number'];
        $profile = $_FILES['profile']['name'];
        $update_id = $_POST['update_id'];

        if(empty($profile)){
            $profile = $_POST['old_profile'];
        }
        else{
            $profile = rand(1,99999).'-'.$profile;
            $path = 'assets/profile/'.$profile;
            move_uploaded_file($_FILES['profile']['tmp_name'],$path);
        }

        if(!empty($first_name) && !empty($last_name) 
            && !empty($gender) && !empty($teacher)
            && !empty($email) && !empty($date_of_birth)
            && !empty($phone_number) && !empty($profile)
        ){
            $sql = "UPDATE `tbl_students` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`email`='$email',`date_of_birth`='$date_of_birth',`phone_number`='$phone_number',`profile`='$profile',`teacher_id`='$teacher' WHERE `id`='$update_id'";
            $rs  = $connection->query($sql);
            if($rs){
                showSweetAlert("Update Success","Student update success fully","success");
            }
        }
        else{
            showSweetAlert("Update Error","Please input all student field","error");
        }
    }
}
updateStudent();

function register(){
    global $connection;
    if(isset($_POST['btn-register'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile = $_FILES['profile']['name'];

        if(!empty($username) && !empty($email) && !empty($password) && !empty($profile)){
            $password = md5($password);
            $profile = rand(1,99999).'-'.$profile;
            $path = 'assets/profile/'.$profile;
            move_uploaded_file($_FILES['profile']['tmp_name'],$path);

            $sql = "INSERT INTO `users`(`user_name`, `email`, `password`, `profile`) VALUES ('$username','$email','$password','$profile')";
            $rs = $connection->query($sql);
            if($rs){
                header('location: login.php');
            }
        }else{
            showSweetAlert('Error','Please input all field','error');
        }
    }
}
register();

function login(){
    global $connection;
    if(isset($_POST['btn-login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT `id` FROM `users` WHERE `email`='$email' AND `password`='$password'";
        $rs = $connection->query($sql);
        $row = mysqli_fetch_assoc($rs);
        if($row){
            setcookie('id',$row['id'],time()+60*60*24,'/');
            header('location: index.php');
        }
        else{
            showSweetAlert('Error','User not found','error');
        }
        
    }
}
login();


function logout(){
    if(isset($_POST['btn-logout'])){
        setcookie('id',0,time(),'/'); //set to expired
        header('location: login.php');
    }
}
logout();