<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container bg-dark text-center p-3">
        <h1 class="text-light">Ajax Employee Crud</h1>
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Employee
        </button>
        <table class="table table-hover table-dark align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('get.php');
                ?>
            </tbody>
        </table>
    </div>





    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="txt-name">Name:</label>
                        <input type="text" name="" class="form-control my-2" id="txt-name" placeholder="Name">
                        <label for="txt-gender">Gender:</label>
                        <select name="" class="form-select my-2" id="txt-gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="txt-phone-number">Phone Number:</label>
                        <input type="text" name="" class="form-control my-2" id="txt-phone-number" placeholder="Phone Number">
                        <label for="profile">Profile</label>
                        <input type="file" name="profileName" id="profile" class="form-control my-2">
                        <label for="profile">
                            <img src="Image/default.jpg" alt="" id="show-profile" style="max-width: 120px;cursor:pointer;">
                        </label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn-save" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
      
        function clear(){
            $('#txt-name').val('');
            $('#txt-gender').val('Male');
            $('#txt-phone-number').val('');
            $('#profile').val('');
            $('#show-profile').attr('alt','');
            $('#show-profile').attr('src','Image/default.jpg');
        }

        // $('#show-profile').click(function(){
        //     $('#profile').click();
        // });
        $('#profile').change(function(){
            var formData = new FormData();
            var profile = $('#profile')[0].files[0];
            formData.append('profileName',profile)
            
            $.ajax({
                url:'move-upload.php',
                data:formData,
                contentType:false,
                processData:false,
                cache:false,
                method:'POST',
                success:function(response){
                    $('#show-profile').attr('src','Image/'+response);
                    $('#show-profile').attr('alt',response);
                    // console.log(response);                    
                }
            });
        });

        $('#btn-save').click(function(){
           var Name = $('#txt-name').val();
           var gender = $('#txt-gender').val();
           var phone_number = $('#txt-phone-number').val();
           var profile = $('#show-profile').attr('alt');

           $.ajax({
                url: 'save.php',
                method:'POST',
                // data:{
                //     Name:Name,
                //     gender:gender,
                //     phone_number:phone_number,
                //     profile:profile,
                // }
                data:{
                    Name,
                    gender,
                    phone_number,
                    profile,
                },
                success:function(response){
                    console.log(response);
                    
                    if(response){
                        var  text = `
                            <tr>
                                <td>${response}</td>
                                <td><img src="Image/${profile}" alt="" style="max-width: 120px;"></td>
                                <td>${Name}</td>
                                <td>${gender}</td>
                                <td>${phone_number}</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                        
                        `;
                        $('tbody').append(text);
                        clear();
                        $('#btn-close').click();    
                        Swal.fire({
                            title: "Succes",
                            text: "That thing is still around?",
                            icon: "success",
                            timer: 3000, // 3s
                        });
                        
                    }
                    
                }
           });
        });

    })
</script>
</html>