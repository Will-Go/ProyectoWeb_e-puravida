<?php
try{
    $con = mysqli_connect("localhost","root", "root", "e-puravida");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
}catch(mysqli_sql_exception){}
    
?>