<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nombreError = null;
        $rncError = null;
        $telefonoError = null;
        $direccionError = null;
         
        // keep track post values
        $nombre = $_POST['name'];
        $rnc = $_POST['rnc'];
        $telefono = $_POST['mobile'];	
        $direccion = $_POST['direccion'];	

         
        // validate input
        $valid = true;
        if (empty($nombre)) {
            $nombreError = 'Por favor digite su nombre';
            $valid = false;
        }
         
        if (empty($rnc)) {
            $rncError = 'Por favor introduzca un número de RNC';
            $valid = false;
        } 
         
        if (empty($telefono)) {
            $telefonoError = 'Por favor introduzca un número de telefono';
            $valid = false;
        }

        if (empty($direccion)) {
            $direccionError = 'Por favor introduzca una dirección valida';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO comercios (nombre,rnc,telefono,direccion) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$rnc,$telefono,$direccion));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>
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
</head>
 
<body>
    <div class="container">
		<div class="span10 offset1">
                    <div class="row">
                        <h3>Crear Comercio</h3>
                        <hr>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($nombre)?$nombre:'';?>">
                            <?php if (!empty($nombreError)): ?>
                                <span class="help-inline"><?php echo $nombreError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($rncError)?'error':'';?>">
                        <label class="control-label">RNC</label>
                        <div class="controls">
                            <input name="rnc" type="text" placeholder="RNC" value="<?php echo !empty($rnc)?$rnc:'';?>">
                            <?php if (!empty($rncError)): ?>
                                <span class="help-inline"><?php echo $rncError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($telefonoError)?'error':'';?>">
                        <label class="control-label">Teléfono</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Número de Teléfono" value="<?php echo !empty($telefono)?$telefono:'';?>">
                            <?php if (!empty($telefonoError)): ?>
                                <span class="help-inline"><?php echo $telefonoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($direccionError)?'error':'';?>">
                        <label class="control-label">Dirección</label>
                        <div class="controls">
                            <input name="direccion" id="autocomplete" type="text"  placeholder="Direccion" value="<?php echo !empty($direccion)?$direccion:''; ?>">
                            <?php if (!empty($direccionError)): ?>
                                <span class="help-inline"><?php echo $direccionError;?></span>
                            <?php endif; print(direccion);?>

                        </div>
                      </div>
                      <div class="form-actions">
                      	<hr>
                          <button type="submit" class="btn btn-success">Crear</button>
                          <a class="btn  btn-default" href="index.php">Atrás</a>
                        </div>
                    </form>
                </div>
                 
	</div> <!-- /container -->

    <script>

    var autocomplete; 
    //Funcion para autocompletado de la direccion 
    function initAutocomplete(){
      autocomplete = new google.maps.places.Autocomplete(
          (document.getElementById('autocomplete')),
          {types:['geocode']

        });
      autocomplete.addListener('placed_changed', fillInAddress);
      console.log(autocomplete);




    }

    function fillInAddress(){
      var place = autocomplete.getPlace();
        var lugar = place.geometry.value;
      console.log(lugar);
      for (var component in componenForm) {
        document.getElementById(component).value='';
        document.getElementById(component).disabled = false; 
      };
    }


    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApuY4JfD2BGkajnfLxFyu2WdRfvUzTyJY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
</html>