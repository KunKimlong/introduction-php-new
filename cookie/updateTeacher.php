<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_teacher WHERE `id`=$id";
    $rs = $connection->query($sql);
    $row = mysqli_fetch_assoc($rs);
    

?>
      <div class="container-fluid">
       <div class="row">
        <div class="col-12">
            <h1>Update Teacher</h1>
        </div>
        <div class="col-12">
            <div class="col-8 mx-auto bg-light p-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_update" value="<?php echo $id ?>" id="">
                    <input type="hidden" name="old_profile" value="<?php echo $row['profile'] ?>" id="">
                    <label for="">First name</label>
                    <input type="text" name="first_name" value="<?php echo $row['first_name'] ?>" id="" class="my-2 form-control" placeholder="First Name">
                    <label for="">Last name</label>
                    <input type="text" name="last_name" value="<?php echo $row['last_name'] ?>" id="" class="my-2 form-control" placeholder="Last Name">
                    <label for="">Gender</label>
                    <select name="gender" id="" class="my-2 form-select">
                        <option value="Male" <?php if($row['gender']=="Male") echo "selected" ?>>Male</option>
                        <option value="Female" <?php if($row['gender']=="Female") echo "selected" ?>>Female</option>
                    </select>
                    <label for="">Department</label>
                    <select name="department" id="" class="my-2 form-select">
                        <option value="IT" <?php echo $row['department']=="IT"?"selected":''  ?>>IT Department</option>
                        <option value="ITE" <?php echo $row['department']=="ITE"?"selected":''  ?>>ITE Department</option>
                        <option value="CS" <?php echo $row['department']=="CS"?"selected":''  ?>>CS Department</option>
                    </select>
                    <label for="">Profile</label>
                    <input type="file" name="profile" id="" class="my-2 form-control">
                    <div class="my-2">
                        <img src="assets/profile/<?php echo $row['profile'] ?>" alt="">
                    </div>
                    <button class="btn btn-success" name="btn-update-teacher">Update</button>
                    <a class="btn btn-danger" href="viewTeacher.php">Back</a>
                </form>
            </div>
        </div>
       </div>
      </div>
    <?php 
        include('footer.php')
    ?>