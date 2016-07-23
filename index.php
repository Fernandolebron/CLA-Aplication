<!DOCTYPE html>
<html lang="en">
<head>
  <title>RCM Application</title>
  <meta charset="utf-8">
<!-- <meta name="csrf-token" content="{!!csrf_token() !!}">
 -->  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  
  <!--- end of script --> 
</head>
 
<body>
    <div class="container">
     <div class="panel panel-default">
    <div class="panel-heading">
        <p>
             <a href="create.php" class="btn btn-success">Crear Comercio</a>
        </p>

    </div>
    <div class="panel-body">
     
        <table class="table table-hover">
            <caption>Información de Comercios</caption>
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>RNC</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            	<?php
            	include 'database.php';
            	$pdo = Database::connect();
            	$sql = 'SELECT * FROM comercios ORDER BY id'; 
                foreach($pdo->query($sql) as $comercio){
                    echo '<tr>';
                    echo '<td>'.$comercio['id'].'</td>';
                    echo '<td>'.$comercio['nombre'].'</td>';
                    echo '<td>'.$comercio['rnc'].'</td>';
                    echo '<td>'.$comercio['telefono'].'</td>';
                    echo '<td>'.$comercio['direccion'].'</td>';
                    echo '<td width=250>';
                                echo '<a class="btn btn-default" href="read.php?id='.$comercio['id'].'">Ver</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$comercio['id'].'">Actualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$comercio['id'].'">Eliminar</a>';
                                echo '</td>';
                                echo '</tr>';
                   }
                   Database::disconnect();     
               
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
        <hr>
        <h4>Ubicación de Comercios</h4>
        <div id="map" style="width: 800px; height: 450px">

        </div>

    </div>
  </div>
    </div> <!-- /container -->
  <!-- Añadiendo google Maps --> 
    <script>
   function initMap(){
    var map = new google.maps.Map(document.getElementById("map"),{
        center: new google.maps.LatLng(18.4682315, -69.9353514),
        zoom: 15,
    });
   }
  </script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApuY4JfD2BGkajnfLxFyu2WdRfvUzTyJY&callback=initMap" async defer></script>

  </body>
</html>