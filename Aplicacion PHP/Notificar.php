<?php
    include ('Conexion.php');

    $sql = "SELECT * FROM ControlAsistencia WHERE Estado = 0 ORDER BY Id DESC ";
    $Result = mysqli_query($Con,$sql);
    $Notificacion = '';

    while ($Data = mysqli_fetch_assoc($Result)){
        $Notificacion = '
            <style type="text/css">
                .invisible{
                    visibility: hidden;
                }
            </style> 

            <div>
                <textarea class="invisible" id="Texto">'. $Data["Mensaje"] .'</textarea>
                <textarea class="invisible" id="Fecha">'. formatearFecha($Data["Fecha"]) .'</textarea>
            </div>

            <script>
                var Texto = document.getElementById("Texto").value;
                var Fecha = document.getElementById("Fecha").value;
                swal(Texto, Fecha, "success");
            </script>

        ';
    }

    $sql = "UPDATE ControlAsistencia SET Estado = 1 WHERE Estado = 0";
    mysqli_query($Con,$sql);
    echo $Notificacion;
?>