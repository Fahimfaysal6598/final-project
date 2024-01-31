<?php

    $database= new mysqli("localhost","root","","list");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>