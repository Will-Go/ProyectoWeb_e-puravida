<?php

function eleguirLugar($lugar)
{
    include("db.php");
    $query = "SELECT p.id_paquete
        FROM paquete p 
        JOIN lugar l ON  p.id_lugar = l.id_lugar
        WHERE l.ubicación = '$lugar'";

    $result = mysqli_query($con, $query);
    if ($result) {
        $paquetes = mysqli_fetch_all($result);
        $randNum = array_rand($paquetes);
        return $paquetes[$randNum][0];
    }
}

?>