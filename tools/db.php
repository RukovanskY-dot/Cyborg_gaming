<?php
function getDatabaseCennection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cyborg";

    $connection = new mysqli($servername,$username,$password,$database);
    if($connection ->connect_error){
        die("Error failed to connect to MYSQL:" . $connection ->connect_error);
    }

    return $connection;

}
?>