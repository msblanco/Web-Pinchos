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
				<h2 class="alineado">Votar Jurado Popular</h2>
			</div>
			<div class="row separacion">
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
					<form class="form-horizontal" method="POST"  href="index.php?controller=popular&action=votar">
					
						<div class="form-group separarformulario">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Código del pincho elegido como el mejor</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<input class="form-control" placeholder="Introduce un código..." name="codigoP1">
								<?= isset($errors["codigoP1"])?$errors["codigoP1"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Código del pincho 2</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<input class="form-control" placeholder="Introduce un código..." name="codigoP2">
								<?= isset($errors["codigoP2"])?$errors["codigoP2"]:"" ?><br>
							</div>
						</div>
						<div class="form-group separarformulario">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Código del pincho 3</label>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
								<input class="form-control" placeholder="Introduce un código..." name="codigoP3">
								<?= isset($errors["codigoP3"])?$errors["codigoP3"]:"" ?><br>
							</div>
						</div>

						<input type="submit" class="btn btn-primary col-md-offset-5" value="Guardar votos" >
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include(__DIR__."/../layouts/pie.php");
?>
