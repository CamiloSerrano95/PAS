<?php 
    include('Conexion.php');
    $sql = "SELECT * FROM ControlAsistencia";

    $result = $Con->query($sql);
    echo'
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="images/favicon.jpeg" type="image/jpeg">
        <link rel="stylesheet" href="cs.css">
        <title>Reportes Entrada</title>
    </head>
    
    <body>
        <div class="container">
            <ul class="header-nav">
                <div class="nav-one">
                    <li class="nav-one-item">
                        <a class="item-one" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-one-item">
                        <a class="item-one" href="reportes.html">Reportes</a>
                    </li>
                </div>
                <li class="nav-two">
                    <a class="item-two" href="#about">Checking Parking Lot</a>
                </li>
            </ul>
            <div class="content-footer-two">
                <div class="content-footer-two-contentTable">
                    <h1 class="content-footer-two-title">Reportes</h1>
                    <div class="content-footer-two-table">
                        <div class="content-footer-two-table-input-center">
                            <div class="content-footer-two-table-input-around">
                                <input type="date" />
                                <button type="button">Buscar</button>
                                <!--<form action="Reporte.php" method="post">
                                    <input type="date" />
                                    <button type="button">Buscar</button>
                                </form>-->
                            </div>
                        </div>
        ';
    
        
        $sql = "SELECT * FROM ControlAsistencia";

        $result = $Con->query($sql);
        echo '
        <table class="content-footer-two-table-table">
        <tr>
            <th>N°</th>
            <th>Tarjeta</th>
            <th>Nombre Profesor</th>
            <th>Fecha</th>
        </tr>
            ';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>". $row["Id"] ."</td>
                            <td>". $row["IdTarjeta"] ."</td>
                            <td>". $row["NombreProfesor"] ."</td>
                            <td>". $row["Fecha"] ."</td>
                        </tr>
                    ";
            }
        }

    echo '
        </table>
        </div>
            </div>
                <footer class="footer">
                    <div class="emblema">
                        Made with &hearts; by Cheking Parking Lot; in Montería
                    </div>
                </footer>
            </div>
        </div>
    </body>
    </html>
    ';

    $Con->close();
?>