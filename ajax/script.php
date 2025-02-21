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

        $('#btn-open-add').click(function() {
            $('#btn-save').show();
            $('#btn-update').hide();
        });
        var id = '';
        var Name = '';
        var gender = '';
        var phone_number = '';
        var image = '';

        $(document).on('click', '#btn-open-update', function() {
            $('#btn-save').hide();
            $('#btn-update').show();

            //get data from table
            id = $(this).closest('tr').find('td').eq(0).text();
            Name = $(this).closest('tr').find('td').eq(2).text();
            gender = $(this).closest('tr').find('td').eq(3).text();
            phone_number = $(this).closest('tr').find('td').eq(4).text();
            // var image = $(this).closest('tr').find('td').eq(1).find('img').attr('alt');
            image = $(this).closest('tr').find('td img').attr('alt');

            //after get data from table we insert into form input
            $('#txt-name').val(Name);
            $('#txt-gender').val(gender);
            $('#txt-phone-number').val(phone_number);
            $('#show-profile').attr('src','Image/'+image);
            $('#id-txt').val(id);
        })
        $('#btn-update').click(function(){
                $.ajax({
                    url:'update.php',
                    method:'POST',
                    data:{
                        id,
                        Name,
                        gender,
                        phone_number,
                        image
                    },
                    success:function(response){
                        console.error(response);
                        
                    }
                });

            })


    })
</script>