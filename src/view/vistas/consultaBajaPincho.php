<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$pincho = $view->getVariable("pincho");
$currentuser = $view->getVariable("currentusername");
?>
<!--AQUI EMPIEZA LA VENTANA MODAL DE AÑADIR ALBUM -->
<div class="margensup" >
	<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1" >
		<div class="modalbox movedown">
			<div class="row">
				<h2 class="alineado">Consulta de Pincho</h2>
			</div>
			<div class="row separacion" >
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
					<form class="form-horizontal separarformulario" role="form">
						<div class="form-group alineado ">
							<center><img src= "<?=$pincho->getFotoPi()?>" alt="Imagen del pincho" class="img-thumbnail" width= "20%" heigth= "20%"></center>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Identificador del pincho: </label>
							<label class=" control-label"><?=$pincho->getIdPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Nombre: </label>
							<label class=" control-label"><?=$pincho->getNombrePi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Precio: </label>
							<label class=" control-label"><?=$pincho->getPrecioPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Cocinero: </label>
							<label class=" control-label"><?=$pincho->getCocineroPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Ingredientes: </label>
							<label class=" control-label"><?=$pincho->getIngredientesPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Numero de votos dado por J.Popular: </label>
							<label class=" control-label"><?=$pincho->getNumVotosPopPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Numero de votos dado por J.Profesional: </label>
							<label class=" control-label"><?=$pincho->getNumVotosProfPi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Numero de codigos de voto: </label>
							<label class=" control-label"><?=$pincho->getNumVotePi()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Estado: </label>
							<label class=" control-label"><?=$pincho->getEstadoPi()?></label>
						</div>
					</form>
				</div>
			</div>


			<?php if ($currentuser != null){?>
				<div class="form-group alineado ">
				<?php if ($currentuser->getTipoU() == 'A') { ?>
					<a href="index.php?controller=pincho&action=validarPincho&idPi= <?=$pincho->getIdPi();?>" ><button type="button" class="btn btn-primary " >Validar pincho</button></a>
					<a href="index.php?controller=pincho&action=bajaPincho&idPi= <?=$pincho->getIdPi();?>" ><button type="button" class="btn btn-primary col-md-offset-2" >Eliminar pincho</button></a>
					<?php if ($pincho->getEstadoPi() == '1') { ?>
						<a href="index.php?controller=pincho&action=generarVotos&idPi= <?=$pincho->getIdPi();?>" ><button type="button" class="btn btn-primary col-md-offset-2" >Generar Codigos de Voto</button></a>
					<?php }
			 	}
				if ( ( ($currentuser->getTipoU() == 'P') && ( $currentuser->getEmailU() == $pincho->getParticipanteEmail() ) ) ){ ?>
					<a href="index.php?controller=pincho&action=modificacionPincho&idPi= <?=$pincho->getIdPi();?>" type="button" class="btn btn-primary " >Modificar pincho</a>
					<?php if ($pincho->getEstadoPi()==1){ ?>
						<a href="index.php?controller=pincho&action=bajaPincho&idPi= <?=$pincho->getIdPi();?>" ><button type="button" class="btn btn-primary col-md-offset-2" >Eliminar pincho</button></a>
					<?php }?>
				<?php }?>
				</div>
			<?php }?>

		</div>
	</div>
</div>
<!--AQUI TERMINA LA VENTANA MODAL DE AÑADIR ALBUM -->
<?php
include(__DIR__."../../layouts/pie.php");
?>
