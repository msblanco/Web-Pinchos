<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$currentuser = $view->getVariable("currentusername");
$votos = $view->getVariable("votos");
$nombrePincho = $view->getVariable("nombrePincho");
?>
<!--AQUI EMPIEZA LA VENTANA MODAL DE AÑADIR ALBUM -->
<div class="margensup" >
	<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1" >
		<div class="modalbox movedown">
			<div class="row">
				<h2 class="alineado">Mi Perfil</h2>
			</div>
			<div class="row separacion" >
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
					<form class="form-horizontal separarformulario" role="form">
						<div class="form-group alineado ">
							<label class="control-label">Nombre: </label>
							<label class=" control-label"><?=$currentuser->getNombreU()?></label>
						</div>
						<div class="form-group alineado ">
							<label class="control-label">Email: </label>
							<label class=" control-label"><?=$currentuser->getEmailU()?></label>
						</div>

					</form>
				</div>
			</div>
			<div class="row separartabla" >
				<div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
					<table class="table alineado ">
						<!-- Aplicadas en las filas -->
						<tr class="activa">
							<td>Nombre</td>
							<td>Id</td>
							<td>Código</td>
							<td>Puntuación</td>
						</tr>
						<?php foreach ($votos as $voto): ?>
							<tr class="tablehover">
								<td><?=$nombrePincho[$voto->getCodigoPinchoV()]->getNombrePi() ?></td>
								<td><?=$voto->getPinchoIdPi()?></td>
								<td><?=$voto->getCodigoPinchoV()?></td>
								<td><?=$voto->getValoracionV()?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
			<a href="index.php?controller=profesional&action=desactivarCuenta"><button type="button" class="btn btn-primary col-md-offset-4" >Eliminar cuenta</button></a>
			<a href="index.php?controller=users&action=seleccionarModificacion"><button type="button" class="btn btn-primary " >Modificar mi perfil</button></a>
		</div>
	</div>
</div>
<!--AQUI TERMINA LA VENTANA MODAL DE AÑADIR ALBUM -->
<?php
include(__DIR__."../../layouts/pie.php");
?>
