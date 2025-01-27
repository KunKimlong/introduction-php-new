<?php

$hostname = 'localhost'; #127.0.0.1;
$username = 'root';
$password = '';
$database = 'db_company';

$connection = new mysqli($hostname, $username, $password, $database);

// print_r($connection); //test connection

function insertEmployee(){
    global $connection;
    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
    
        $sql = "INSERT INTO `tbl_employee`(`first_name`, `last_name`, `gender`, `position`, `salary`)
                VALUES ('$first_name','$last_name','$gender','$position','$salary')";
    
        $rs = $connection->query($sql); // execute query
        if($rs){
            echo '
                <script>
                $(document).ready(function(){
                    Swal.fire({
                    title: "Success",
                    text: "Employee Insert successfully",
                    icon: "success"
                    });
                })
            </script>
            ';
        }
    }
    
}

insertEmployee();

function getEmployee(){
    global $connection;

    $sql = "SELECT * FROM `tbl_employee`";

    $rs = $connection->query($sql); //rs = result set
    if($rs){
        while($row = mysqli_fetch_assoc($rs)){ // get data from result set
            // print_r($row);
            echo '
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['first_name'].'</td>
                    <td>'.$row['last_name'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['position'].'</td>
                    <td>'.$row['salary'].'</td>
                    <td class="d-flex justify-content-center">

                        <button type="button" class="btn btn-outline-warning me-2" id="btn-open-update" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Update
                        </button>

                        <form action="" method="POST">          
                            <input type="hidden" name="removeId" value="'.$row['id'].'"> 
                            <button class="btn btn-outline-danger" name="btn-delete"> <i class="bi bi-trash3"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            ';
        }
    }
}

function deleteEmployee(){
    global $connection;
    if(isset($_POST['btn-delete'])){
        $removeId = $_POST['removeId'];
        $sql = "DELETE FROM tbl_employee WHERE id = $removeId";
        $rs = $connection->query($sql); // execute query
        if($rs){
            echo '
                <script>
                $(document).ready(function(){
                    Swal.fire({
                    title: "Success",
                    text: "Employee Delete successfully",
                    icon: "success"
                    });
                })
            </script>
            ';
        }
    }
}

deleteEmployee();

function updateEmployee(){
    global $connection;
    if(isset($_POST['btn-update'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $position = $_POST['position'];
        $salary = $_POST['salary'];
        $id = $_POST['update_id'];

        $sql = "UPDATE `tbl_employee` SET `first_name`='$first_name',`last_name`='$last_name',`gender`='$gender',`position`='$position',`salary`='$salary' WHERE `id`='$id'";

        $rs = $connection->query($sql); // execute query
        if($rs){
            echo '
                <script>
                $(document).ready(function(){
                    Swal.fire({
                    title: "Success",
                    text: "Employee Update successfully",
                    icon: "success"
                    });
                })
            </script>
            ';
        }
    }
}

updateEmployee();