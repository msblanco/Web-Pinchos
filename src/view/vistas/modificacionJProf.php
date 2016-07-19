<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$currentuser = $view->getVariable("currentusername");
?>
<div class="margensup" >
	<div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
		<div class="modalbox movedown">
			<div class="row " >
				<h2 class="alineado">Modificar Jurado Profesional</h2>
			</div>
			<div class="row separacion">
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
					<form class="form-horizontal" method="POST" action="index.php?controller=popular&action=verModificacion">
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input class="form-control" placeholder="<?=$currentuser->getNombreU()?>" name="nombreU"
									value="<?= isset($_POST["nombreU"])?$_POST["nombreU"]:$currentuser->getNombreU() ?>">
							</div>
							<div class="tab"><?= isset($errors["nombreC"])?$errors["nombreC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Contraseña</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-copyright-mark"></span></span>
								<input class="form-control" placeholder="<?=$currentuser->getContrasenaU()?>" name="contrasenaU"
									value="<?= isset($_POST["contrasenaU"])?$_POST["contrasenaU"]:$currentuser->getContrasenaU() ?>">
							</div>
							<div class="tab"><?= isset($errors["contrasenaU"])?$errors["contrasenaU"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Repetir Contraseña</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-copyright-mark"></span></span>
								<input class="form-control" placeholder="<?=$currentuser->getContrasenaU()?>" name="contrasenaU2"
									value="<?= isset($_POST["contrasenaU2"])?$_POST["contrasenaU2"]:$currentuser->getContrasenaU() ?>">
							</div>
							<div class="tab"><?= isset($errors["contrasenaU2"])?$errors["contrasenaU2"]:"" ?><br></div>
						</div>
						<input type="submit" class="btn btn-primary col-md-offset-5" value="Guardar modificación">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
