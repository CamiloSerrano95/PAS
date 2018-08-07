<?php     
    $Con = mysqli_connect("localhost", "root", "1067943114", "CPL") or die ("Error en la conexion");
    
    function formatearFecha($fecha){
        return date('g:i a', strtotime($fecha));
    }

?>