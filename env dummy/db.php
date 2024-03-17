<?php

    if(!isset($db)){
        global $db;
        $db = mysqli_connect("hostname", "username", "password", "dbname");
    }


