<?php 
    include('function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container bg-dark p-3">
        <h1 class="text-center text-light">Employee CRUD</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Add
        </button>
        <table class="table table-hover table-dark text-center">
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Salary</th>
            </tr>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-6 mt-2">
                                <label for="">First name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Last name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="">Gender</label>
                                <select id="" name="gender" class="form-select">
                                    <option value="" disabled selected>--- Select Gender ---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Position</label>
                                <select name="position" id="" class="form-select">
                                    <option value="" disabled selected>--- Select Position ---</option>
                                    <option value="Web Developer">Web Developer</option>
                                    <option value="Mobile Developer">Mobile Developer</option>
                                    <option value="UX-UI Design">UX-UI Design</option>
                                    <option value="Dev Ops">Dev Ops</option>
                                    <option value="Database Administractor">Database Administractor</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Salary</label>
                                <input type="text" class="form-control" name="salary" placeholder="Salary" aria-label="Salary">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn-save" class="btn btn-success">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>