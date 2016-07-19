<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$concurso = $view->getVariable("concu");
?>
<div class="margensup" >
  <div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
    <div class="modalbox movedown">
      <div class="row " >
        <h2 class="alineado">Modificar Concurso</h2>
      </div>
      <div class="row separacion">
        <div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
          <form class="form-horizontal" method="POST" action="index.php?controller=concurso&action=modificarConcurso" enctype="multipart/form-data">
			<div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-bold"></span></span>
					<input class="form-control" placeholder="<?=$concurso->getNombreC()?>" 
					value="<?= isset($_POST["nombreC"])?$_POST["nombreC"]:$concurso->getNombreC() ?>" name="nombreC">
				</div>
				<div class="tab"><?= isset($errors["nombreC"])?$errors["nombreC"]:"" ?><br></div>
            </div>
            <div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Ciudad</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
					<input class="form-control" placeholder="<?=$concurso->getCiudadC()?>" 
					value="<?= isset($_POST["ciudadC"])?$_POST["ciudadC"]:$concurso->getCiudadC() ?>" name="ciudadC">
              </div>
			  <div class="tab"><?= isset($errors["ciudadC"])?$errors["ciudadC"]:"" ?><br></div>
            </div>
            <div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Inicio</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<input class="form-control" type="date" placeholder="<?=$concurso->getFechaInicioC()?>" 
					value="<?= isset($_POST["fechaInicioC"])?$_POST["fechaInicioC"]:$concurso->getFechaInicioC() ?>" name="fechaInicioC">
				</div>
				<div class="tab"><?= isset($errors["fechaInicioC"])?$errors["fechaInicioC"]:"" ?><br></div>
            </div>
			<div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Finalización</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<input class="form-control" type="date" placeholder="<?=$concurso->getFechaFinalC()?>" 
					value="<?= isset($_POST["fechaFinalC"])?$_POST["fechaFinalC"]:$concurso->getFechaFinalC() ?>" name="fechaFinalC">
              </div>
			  <div class="tab"><?= isset($errors["fechaFinalC"])?$errors["fechaFinalC"]:"" ?><br></div>
            </div>
			<div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fecha de Finalistas</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					<input class="form-control" type="date" placeholder="<?=$concurso->getFechaFinalistasC()?>" 
					value="<?= isset($_POST["fechaFinalistasC"])?$_POST["fechaFinalistasC"]:$concurso->getFechaFinalistasC() ?>" name="fechaFinalistasC">
              </div>
			  <div class="tab"><?= isset($errors["fechaFinalistasC"])?$errors["fechaFinalistasC"]:"" ?><br></div>
            </div>
            <div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Premio</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
					<input class="form-control" placeholder="<?=$concurso->getPremioC()?>" 
					value="<?= isset($_POST["premioC"])?$_POST["premioC"]:$concurso->getPremioC() ?>" name="premioC">
				</div>
				<div class="tab"><?= isset($errors["premioC"])?$errors["premioC"]:"" ?><br></div>
            </div>
            <div class="form-group separarformulario">
				<label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Patrocinador</label>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
					<input class="form-control" placeholder="<?=$concurso->getPatrocinadorC()?>" 
					value="<?= isset($_POST["patrocinadorC"])?$_POST["patrocinadorC"]:$concurso->getPatrocinadorC() ?>" name="patrocinadorC">
			  </div>
			  <div class="tab"><?= isset($errors["patrocinadorC"])?$errors["patrocinadorC"]:"" ?><br></div>
			</div>
        <div class="form-group separarformulario">
          <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Bases</label>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <input type="file" id="archivo_1" name="basesC">
			<?= isset($errors["basesC"])?$errors["basesC"]:"" ?><br>
          </div>
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
