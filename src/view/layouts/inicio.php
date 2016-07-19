<html lang="es">

<?php
include(__DIR__."/cabecera.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$currentuser = $view->getVariable("currentusername");
//Para que muestre debug
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<body class="fondo">
	<div class="wrapper">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">

				<?php if ($currentuser == null) $currentuser = new User();?>
				<!-- sidebar -->
				<div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">

					<ul class="nav">
						<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
					</ul>

					<ul class="nav hidden-xs" id="lg-menu">

						<div class="nombreuser">-- <?=$currentuser->getNombreU() ?> --</div>

						<li class="nav-header">
							<a href="#" data-toggle="collapse" data-target="#menu1">
								<h5>Concurso <i class="glyphicon glyphicon-chevron-right"></i></h5>
							</a>
							<ul class="list-unstyled collapse" id="menu1">
								<?php if ($currentuser->getTipoU() == 'A') { ?>
									<li class="desplegable"><a href="index.php?controller=concurso&action=registro">Crear concurso</a></li>
									<li class="desplegable"><a href="index.php?controller=concurso&action=modificarConcurso">Modificar concurso</a></li>
									<?php } ?>
									<li class="desplegable "><a href="index.php?controller=concurso&action=consultarConcurso">Consultar concurso</a></li>
								</ul>
							</li>

							<li class="nav-header">
								<a href="#" data-toggle="collapse" data-target="#menu2">
									<h5>Participantes <i class="glyphicon glyphicon-chevron-right"></i></h5>
								</a>
								<ul class="list-unstyled collapse" id="menu2">
									<li class="desplegable"><a href="index.php?controller=participante&action=busquedaParticipante">Búsqueda</a></li>
								</ul>
							</li>
							<li class="nav-header">
								<a href="#" data-toggle="collapse" data-target="#menu3">
									<h5>Pinchos <i class="glyphicon glyphicon-chevron-right"></i></h5>
								</a>
								<ul class="list-unstyled collapse" id="menu3">
									<?php if ( ($currentuser->getTipoU() == 'A') ) { ?>
										<li class="desplegable"><a href="index.php?controller=pincho&action=listadoPincho">Listado Activos</a></li>
										<li class="desplegable"><a href="index.php?controller=pincho&action=listadoPinchoInact">Listado Inactivos</a></li>
										<?php }?>
										<?php if (($currentuser->getTipoU() == 'P') ) { ?>
											<li class="desplegable"><a href="index.php?controller=pincho&action=listadoPincho">Listado</a></li>
											<?php }?>
											<li class="desplegable"><a href="index.php?controller=pincho&action=busquedaPincho">Búsqueda</a></li>
										</ul>
									</li>

									<?php if ($currentuser->getTipoU() == 'A') { ?>
										<li class="nav-header">
											<a href="#" data-toggle="collapse" data-target="#menu5">
												<h5>Jurado Profesional <i class="glyphicon glyphicon-chevron-right"></i></h5>
											</a>
											<ul class="list-unstyled collapse" id="menu5">
												<li class="desplegable "><a href="index.php?controller=profesional&action=registrarProfesional">Crear J.Profesional</a></li>
											</ul>
										</li>
										<?php } ?>
									</ul>

								</div>
								<!-- /sidebar -->

								<!-- main right col -->
								<div class="column col-sm-10 col-xs-11" id="main">

									<!-- top nav -->
									<div class="navbar navbar-blue navbar-static-top">
										<div class="navbar-header">
											<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
												<span class="sr-only">Toggle</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
											<a href="index.php" class="navbar-brand logo">P</a>
										</div>
										<nav class="collapse navbar-collapse" role="navigation">
											<ul class="nav navbar-nav">
												<li>
													<a href="index.php?controller=pincho&action=listarPrem"><i class="glyphicon glyphicon-plus"></i> Premiados</a>
												</li>
												<li>
													<?php if (($currentuser->getTipoU() == 'J') or ($currentuser->getTipoU() == 'S')) { ?>
														<a href="index.php?controller=users&action=seleccionarVotacion"><i class="glyphicon glyphicon-plus"></i> Votar</a>
														<?php } ?>
													</li>
													<li>
														<?php if ($currentuser->getTipoU() == 'A') { ?>
															<a href="index.php?controller=pincho&action=cerrarVotacion"><i class="glyphicon glyphicon-plus"></i> Cerrar concurso</a>
															<?php } ?>
														</li>
													</ul>

													<ul class="nav navbar-nav navbar-right">
														<?php if ($currentuser->getTipoU() != NULL) { ?>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i></a>
																<ul class="dropdown-menu">
																	<?php if ($currentuser->getTipoU() != 'A' && $currentuser->getTipoU() != 'P') { ?>
																		<li><a href="index.php?controller=users&action=seleccionarPerfil">Mi perfil</a></li>
																		<li><a href="index.php?controller=users&action=seleccionarModificacion">Modificar mi perfil</a></li>
																		<?php } ?>
																		<li><a href="index.php?controller=users&action=logout">Salir</a></li>
																	</ul>
																</li>
																<?php } else{ ?>
																	<div class="form-group">
																		<a href="index.php?controller=users&action=registroPortada" class="whitebtn" >Registrate</a>
																	</div>
																	<?php } ?>
																</ul>

															</nav>
														</div>
														<!-- /top nav -->
