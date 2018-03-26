<?php
//***********************************************************
//    File: dbc.php
//    Connect Read-only to MySQL database via PHP
//***********************************************************

    $host = "localhost";
    $userName = "scerrito_410rdo";
    $passWord = "April287";
    $dataBase = "scerrito_gameSite";

    $con = mysqli_connect($host, $userName, $passWord, $dataBase);

    $connection_error = mysqli_connect_error();
    if($connection_error != null)
    {
        echo "<p>Error connecting to database: $connection_error </p>";
    }
?>