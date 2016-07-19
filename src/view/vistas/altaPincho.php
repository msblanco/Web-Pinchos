<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$pincho = $view->getVariable("pincho");
?>
<div class="margensup" >
	<div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
		<div class="modalbox movedown">
			<div class="row" >
				<h2 class="alineado">Crear Pincho</h2>
			</div>
			<div class="row separacion">
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
					<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="index.php?controller=pincho&action=altaPincho">
						<div class="form-group separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<span class="input-group-addon"><span class="glyphicon glyphicon-bold"></span></span>
								<input class="form-control" placeholder="Introduce un nombre..." name="nombrePi" id="nombrePi">
								<?= isset($errors["nombrePi"])?$errors["nombrePi"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Precio</label>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
								<input class="form-control" placeholder="Introduce un precio..." name="precioPi">
								<?= isset($errors["precioPi"])?$errors["precioPi"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Cocinero</label>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input class="form-control" placeholder="Introduce un cocinero..." name="cocineroPi">
								<?= isset($errors["cocineroPi"])?$errors["cocineroPi"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Ingredientes</label>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<span class="input-group-addon"><span class="glyphicon glyphicon-cutlery"></span></span>
								<textarea class="form-control" placeholder="Introduce algunos de los ingredientes..." rows="3" name="ingredientesPi"></textarea>
								<?= isset($errors["ingredientesPi"])?$errors["ingredientesPi"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fotografia</label>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<span class="input-group-addon"><span class="glyphicon glyphicon-camera"></span></span>
								<input type="file" id="fotoPi" name="fotoPi">
								<?= isset($errors["fotoPi"])?$errors["fotoPi"]:"" ?>
							</div>
							<div class=" input-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
								<p class="help-block">El tamano maximo permitido es de 2Mb</p><br>
							</div>
						</div>
						<input type="submit" class="btn btn-primary col-md-offset-6" value = "Confirmar Alta">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
