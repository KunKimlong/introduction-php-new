<script>
    $(document).ready(function() {

        function clear() {
            $('#txt-name').val('');
            $('#txt-gender').val('Male');
            $('#txt-phone-number').val('');
            $('#profile').val('');
            $('#show-profile').attr('alt', '');
            $('#show-profile').attr('src', 'Image/default.jpg');
        }

        // $('#show-profile').click(function(){
        //     $('#profile').click();
        // });
        $('#profile').change(function() {
            var formData = new FormData();
            var profile = $('#profile')[0].files[0];
            formData.append('profileName', profile)

            $.ajax({
                url: 'move-upload.php',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                method: 'POST',
                success: function(response) {
                    $('#show-profile').attr('src', 'Image/' + response);
                    $('#show-profile').attr('alt', response);
                    // console.log(response);                    
                }
            });
        });

        $('#btn-save').click(function() {
            var Name = $('#txt-name').val();
            var gender = $('#txt-gender').val();
            var phone_number = $('#txt-phone-number').val();
            var profile = $('#show-profile').attr('alt');

            $.ajax({
                url: 'save.php',
                method: 'POST',
                // data:{
                //     Name:Name,
                //     gender:gender,
                //     phone_number:phone_number,
                //     profile:profile,
                // }
                data: {
                    Name,
                    gender,
                    phone_number,
                    profile,
                },
                success: function(response) {
                    console.log(response);

                    if (response) {
                        var text = `
                            <tr>
                                <td>${response}</td>
                                <td><img src="Image/${profile}" alt="${profile}" style="max-width: 120px;"></td>
                                <td>${Name}</td>
                                <td>${gender}</td>
                                <td>${phone_number}</td>
                                <td>
                                    <button id="btn-open-update" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                    <button class="btn btn-danger" id="btn-open-remove" data-bs-toggle="modal" data-bs-target="#removeModal">Remove</button>
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

        $('#btn-open-add').click(function() {
            $('#btn-save').show();
            $('#btn-update').hide();
        });

        $(document).on('click', '#btn-open-update', function() {
            $('#btn-save').hide();
            $('#btn-update').show();

            //get data from table
            var id = $(this).closest('tr').find('td').eq(0).text();
            var Name = $(this).closest('tr').find('td').eq(2).text();
            var gender = $(this).closest('tr').find('td').eq(3).text();
            var phone_number = $(this).closest('tr').find('td').eq(4).text();
            // var image = $(this).closest('tr').find('td').eq(1).find('img').attr('alt');
            var image = $(this).closest('tr').find('td img').attr('alt');
            var table_row = $(this).closest('tr');
            

            //after get data from table we insert into form input
            $('#txt-name').val(Name);
            $('#txt-gender').val(gender);
            $('#txt-phone-number').val(phone_number);
            $('#show-profile').attr('src', 'Image/' + image);
            $('#show-profile').attr('alt', image);
            $('#id-txt').val(id);

            $('#btn-update').click(function() {
                var txt_id = $('#id-txt').val();
                var txt_name = $('#txt-name').val();
                var txt_gender = $('#txt-gender').val();
                var txt_phone_number = $('#txt-phone-number').val();
                var new_image = $('#show-profile').attr('alt');

                $.ajax({
                    url: 'update.php',
                    method: 'POST',
                    data: {
                        id: txt_id,
                        Name: txt_name,
                        gender: txt_gender,
                        phone_number: txt_phone_number,
                        image: new_image,
                    },
                    success: function(response) {
                        if (response) {
                            var text = `
                                <td>${txt_id}</td>
                                <td><img src="Image/${new_image}" alt="${new_image}" style="max-width: 120px;"></td>
                                <td>${txt_name}</td>
                                <td>${txt_gender}</td>
                                <td>${txt_phone_number}</td>
                                <td>
                                    <button id="btn-open-update" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                    <button class="btn btn-danger" id="btn-open-remove" data-bs-toggle="modal" data-bs-target="#removeModal">Remove</button>
                                </td>
                            `;
                            table_row.html(text)
                            clear();
                            $('#btn-close').click();
                            Swal.fire({
                                title: "Succes",
                                text: "Update successfully",
                                icon: "success",
                                timer: 3000, // 3s
                            });
                        }

                    }
                });
            })


        })
    
        var remove_id = 0;
        var remove_table_row = '';

        $(document).on('click','#btn-open-remove',function(){
            remove_id = $(this).closest('tr').find('td').eq(0).text();
            remove_table_row = $(this).closest('tr');
            $('#btn-remove').attr("remove-id",remove_id);
        })
        $('#btn-remove').click(function(){
                $.ajax({
                    url:'remove.php',
                    method:'POST',
                    data:{
                        id:remove_id
                    },
                    success:function(response){
                        if(response){
                            $('#btn-close').click();
                            Swal.fire({
                                title: "Succes",
                                text: "Delete successfully",
                                icon: "success",
                                timer: 3000, // 3s
                            });
                        }
                        remove_table_row.remove();
                        
                    }
                })
            })
    })
</script>