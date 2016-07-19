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
				<h2 class="alineado">Crear Concurso</h2>
			</div>
			
			<div class="row separacion">
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
					<form class="form-horizontal" method="POST" action="index.php?controller=concurso&action=registro" enctype="multipart/form-data">
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-bold"></span></span>
								<input type="text" class="form-control" placeholder="Introduce un Nombre..." name="nombreC"> 
							</div>
							<div class="tab"><?= isset($errors["nombreC"])?$errors["nombreC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Ciudad</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
								<input type="text" class="form-control" placeholder="Introduce una Ciudad..." name="ciudadC"> 
							</div>
							<div class="tab"><?= isset($errors["ciudadC"])?$errors["ciudadC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Inicio</label>
							<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input class="form-control" type="date" name="fechaInicioC">
							</div>
							<div class="tab"><?= isset($errors["fechaInicioC"])?$errors["fechaInicioC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Finalización</label>
							<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input class="form-control" type="date" name="fechaFinalC">
							</div>
							<div class="tab"><?= isset($errors["fechaFinalC"])?$errors["fechaFinalC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Finalistas</label>
							<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input class="form-control" type="date" name="fechaFinalistasC">
							</div>
							<div class="tab"><?= isset($errors["fechaFinalistasC"])?$errors["fechaFinalistasC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Premio</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
								<input type="text" class="form-control" placeholder="Introduce un Premio..." name="premioC"> 
							</div>
							<div class="tab"><?= isset($errors["premioC"])?$errors["premioC"]:"" ?><br></div>
						</div>
						<div class="separarformulario">
							<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Patrocinador</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
								<input type="text" class="form-control" placeholder="Introduce un Patrocinador..." name="patrocinadorC"> 
							</div>
							<div class="tab"><?= isset($errors["patrocinadorC"])?$errors["patrocinadorC"]:"" ?><br></div>
						</div>
				<div class="form-group separarformulario">
					<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Bases</label>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
						<input type="file" id="archivo_1" name="basesC">
						<?= isset($errors["basesC"])?$errors["basesC"]:"" ?><br></div>
					</div>
				</div>
				<input type="submit" class="btn btn-primary col-md-offset-7" value="Crear">
			</form>
		</div>
	</div>
</div>
</div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
