<?php 
    include('sidebar.php');
?>
      <div class="container-fluid">
       <div class="row">
        <div class="col-12">
            <h1>Add Teacher</h1>
        </div>
        <div class="col-12">
            <div class="col-8 mx-auto bg-light p-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">First name</label>
                    <input type="text" name="first_name" id="" class="my-2 form-control" placeholder="First Name">
                    <label for="">Last name</label>
                    <input type="text" name="last_name" id="" class="my-2 form-control" placeholder="Last Name">
                    <label for="">Gender</label>
                    <select name="gender" id="" class="my-2 form-select">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="">Department</label>
                    <select name="department" id="" class="my-2 form-select">
                        <option value="IT">IT Department</option>
                        <option value="ITE">ITE Department</option>
                        <option value="CS">CS Department</option>
                    </select>
                    <label for="">Profile</label>
                    <input type="file" name="profile" id="" class="my-2 form-control">
                    <button class="btn btn-success" name="btn-submit-teacher">Submit</button>
                </form>
            </div>
        </div>
       </div>
      </div>
    <?php 
        include('footer.php')
    ?>