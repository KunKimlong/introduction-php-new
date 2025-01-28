<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        ul{
            list-style-type: none;
        }
        ul li{
            background-color: pink;
            display: inline-block;
            padding: 10px;
            margin: 0 10px;
            border-radius: 10px;
            cursor: pointer;
        }
        a{
            text-decoration: none !important;
            color: black;
        }
    </style>
</head>

<body>
    <?php
        include('function.php');
    ?>
    <div class="container bg-dark p-3">
        <h1 class="text-center text-light">Employee CRUD</h1>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" id="btn-open-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add
            </button>
            <form action="" class="d-flex" method="POST">
                <input type="text" name="search" id="" class="form-control" placeholder="Search">
                <button name="btn-search" class="btn btn-outline-success">Search</button>
                <button class="btn btn-outline-danger">Back</button>
            </form>
        </div>
        <table class="table table-hover table-dark text-center text-light">
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
            <?php if(isset($_POST['btn-search'])){
                    searchEmployee();
                }
                else{
                    getEmployee();
                }
            ?>
        </table>
        <div class="text-light">
            <ul>
                <?php getPagination(); ?>
            </ul>
        </div>
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
                    <input type="hidden" name="update_id" id="update_id_txt">
                        <div class="row">
                            <div class="col-6 mt-2">
                                <label for="">First name</label>
                                <input type="text" name="first_name" id="first_name_txt" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Last name</label>
                                <input type="text" name="last_name" id="last_name_txt" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="">Gender</label>
                                <select id="gender_txt" name="gender" class="form-select">
                                    <option value="" disabled selected>--- Select Gender ---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Position</label>
                                <select name="position" id="position_txt" class="form-select">
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
                                <input type="text" class="form-control" id="salary_txt" name="salary" placeholder="Salary" aria-label="Salary">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn-save" id="btn-save" class="btn btn-success">Save</button>
                    <button type="submit" name="btn-update" id="btn-update" class="btn btn-warning">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</body>

<script>
    $(document).ready(function(){
        $('#btn-open-add').click(function(){
            $('#btn-update').addClass('d-none')
            $('#btn-save').removeClass('d-none')

            $('#first_name_txt').val('');
            $('#last_name_txt').val('');
            $('#gender_txt').val('');
            $('#position_txt').val('');
            $('#salary_txt').val('');
            $('.modal-title').text('Insert Employee')
        });
        $('body').on('click','#btn-open-update',function(){
            $('#btn-save').addClass('d-none')
            $('#btn-update').removeClass('d-none')
            $('.modal-title').text('Update Employee')

            var row = $(this).parents('tr').find('td');
            console.log(row);
            var id = $(this).parents('tr').find('td').eq(0).text();
            var first_name = $(this).parents('tr').find('td').eq(1).text();
            var last_name = $(this).parents('tr').find('td').eq(2).text();
            var gender = $(this).parents('tr').find('td').eq(3).text();
            var position = $(this).parents('tr').find('td').eq(4).text();
            var salary = $(this).parents('tr').find('td').eq(5).text();
            
            console.log(id+" "+first_name+" "+last_name+" "+gender+" "+position+" "+salary);

            $('#update_id_txt').val(id);
            $('#first_name_txt').val(first_name);
            $('#last_name_txt').val(last_name);
            $('#gender_txt').val(gender);
            $('#position_txt').val(position);
            $('#salary_txt').val(salary);
                
        })
    });
</script>
</html>
