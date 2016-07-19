<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$contrasenaGenerada = $view->getVariable("contrasenaGenerada");
?>
<div class="margensup" >
  <div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
    <div class="modalbox movedown">
      <div class="row" >
        <h2 class="alineado">Crear Jurado Profesional</h2>
      </div>
      <div class="row separacion">
        <div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
          <form class="form-horizontal" method="POST" action="index.php?controller=profesional&action=registrarProfesional">
            <div class="separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Email</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-registration-mark"></span></span>
					<input class="form-control" placeholder="Introduce un email..." name="emailU">
				</div>
				<div class="tab"><?= isset($errors["emailU"])?$errors["emailU"]:"" ?><br></div>
            </div>
            <div class="separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input class="form-control" placeholder="Introduce Nombre y Apellidos..." name="nombreU">
				</div>
				<div class="tab"><?= isset($errors["nombreC"])?$errors["nombreC"]:"" ?><br></div>
            </div>
            <div class="separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Contraseña</label>
				<a href="index.php?controller=profesional&action=generarContrasena"><button type="button" class="btn btn-primary" >Generar contraseña</button></a>
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-copyright-mark"></span></span>
						<input class="form-control" placeholder="Generar contraseña..." name="contrasenaU"
						value="<?= isset($contrasenaGenerada)?$contrasenaGenerada:""?>">
					</div>
					<div class="tab"><?= isset($errors["contrasenaU"])?$errors["contrasenaU"]:"" ?><br></div>
				</div>
			</div>
				<input type="submit" class="btn btn-primary col-md-offset-6" value="Añadir">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
