<?php
    define('DB_NAME','db-ajax');
    define('USER','root');
    define('PASSWORD','');
    const HOST = "localhost" ;    

    $connection = new mysqli(HOST,USER,PASSWORD,DB_NAME);
    // if($connection){
    //     echo "Success";
    // }