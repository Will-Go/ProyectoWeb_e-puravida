<?php
session_start();


if (isset($_SESSION['userLoggedin'])) {
    if ($_SESSION['userLoggedin'] == true) {
        if (isset($_SESSION['cliente'])) {
            $cliente = $_SESSION['cliente'];
            // echo ($cliente['correo']);s
        }
    }



}
?>