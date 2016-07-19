<!DOCTYPE html>
<?php
include(__DIR__."/../layouts/cabecera.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
?>
<body>
  <!--login modal-->
  <div id="registroModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <!--<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Registro</h1>
        </div>
        <div class="modal-body">-->


<div class="container">
	<div class="row">
		<div class=" col-md-4 col-lg-4 text-center col-md-offset-4 col-lg-offset-4" id="registrar">

		<div class="modal-body">
			<form class="form col-md-12 center-block" method="POST" action="index.php?controller=users&action=registro">
				<div class="form-group">
				  <input type="text" class="form-control input-lg" placeholder="Email" name="emailU">
				  <?= isset($errors["emailU"])?$errors["emailU"]:"" ?><br>
				</div>
				<div class="form-group">
				  <input type="text" class="form-control input-lg" placeholder="Nombre y apellidos" name="nombreU">
				  <?= isset($errors["nombreU"])?$errors["nombreU"]:"" ?><br>
				</div>
				<div class="form-group">
				  <input type="password" class="form-control input-lg" placeholder="Contraseña" name="contrasenaU">
				  <?= isset($errors["contrasenaU"])?$errors["contrasenaU"]:"" ?><br>
				</div>
				<div class="form-group">
				  <input type="password" class="form-control input-lg" placeholder="Repetir Contraseña" name="contrasenaU2">
				  <?= isset($errors["contrasenaU2"])?$errors["contrasenaU2"]:"" ?><br>
				</div>
				<div class="form-group">
					  <select class="form-control" name="tipoU">
							<option value="N">Selecciona un tipo...</option>
							<option value="J">Jurado Popular</option>
							<option value="P">Participante</option>
					  </select>
				  <?= isset($errors["tipoU"])?$errors["tipoU"]:"" ?><br>
				</div>
				<div class="form-group">
				  <input type="submit" class="btn btn-primary btn-lg btn-block, btn2" value="Registrate">
				  <a href="index.php?controller=users&action=portada" class="btn btn-primary btn-lg" class="inicio">Inicio</a>
				</div>
          </form>
		</div>

		</div> <!-- /col -->
	</div> <!-- /row -->
</div>

  </div>
</body>
</html>
