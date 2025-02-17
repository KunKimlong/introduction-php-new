<?php

    $profile = $_FILES['profileName']['name'];
    $profile = rand(1,99999).'_'.$profile;
    $path = 'Image/'.$profile;
    move_uploaded_file($_FILES['profileName']['tmp_name'],$path);
    echo $profile;