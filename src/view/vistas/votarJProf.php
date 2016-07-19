<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
?>
<div class="margensup" >
	<div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
		<div class="modalbox movedown">
			<div class="row" >
				<h2 class="alineado">Votar Jurado Profesional</h2>
			</div>
			<div class="row separacion">
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
					<form class="form-horizontal" role="form" method="POST"  href="index.php?controller=profesional&action=votar">
						<div class="form-group separarformulario">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Código del pincho</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<input class="form-control" placeholder="Introduce un código..." name="codigoP">
								<?= isset($errors["codigoP"])?$errors["codigoP"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Puntuación</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<select class="form-control" name="valoracionP">
									<option value="N">Introduce la puntuación...</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<?= isset($errors["valoracionV"])?$errors["valoracionV"]:"" ?><br>
							</div>
						</div>

						<input type="submit" class="btn btn-primary col-md-offset-5" value="Guardar voto">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
