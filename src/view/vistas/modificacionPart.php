<?php
include(__DIR__."/../layouts/inicio.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$participante = $view->getVariable("participante");
$errors = $view->getVariable("errors");
?>
<div class="margensup" >
  <div class="column col-lg-9 col-md-9 col-sm-12 col-xs-12 col-md-offset-2" >
    <div class="modalbox movedown">
      <div class="separa" >
        <h2 class="alineado">Modificar Participante</h2>
      </div>
      <div class="separacion">
        <div class="column col-lg-10 col-md-10 col-sm-12 col-xs-12 ">
          <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="index.php?controller=participante&action=modificarParticipante&did=<?=$participante[0]["emailU"]?>">
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["nombreU"]?>"
                value="<?= isset($_POST["nombreU"])?$_POST["nombreU"]:$participante[0]["nombreU"] ?>" name="nombreU">
                <?= isset($errors["nombreU"])?$errors["nombreU"]:"" ?><br>
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Contraseña</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["contrasenaU"]?>"
                value="<?= isset($_POST["contrasenaU"])?$_POST["contrasenaU"]:$participante[0]["contrasenaU"] ?>" name="contrasenaU">
                <?= isset($errors["contrasenaU"])?$errors["contrasenaU"]:"" ?><br>
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Repetir Contraseña</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["contrasenaU"]?>"
                value="<?= isset($_POST["contrasenaU2"])?$_POST["contrasenaU2"]:$participante[0]["contrasenaU"] ?>" name="contrasenaU2">
                <?= isset($errors["contrasenaU2"])?$errors["contrasenaU2"]:"" ?><br>
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Dirección</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["direccionP"]?>"
                value="<?= isset($_POST["Dirección"])?$_POST["Dirección"]:$participante[0]["direccionP"] ?>" name="direccionP">
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Telefono</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["telefonoP"]?>"
                value="<?= isset($_POST["telefonoP"])?$_POST["telefonoP"]:$participante[0]["telefonoP"] ?>" name="telefonoP">
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Nombre Local</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["nombreLocalP"]?>"
                value="<?= isset($_POST["nombreLocalP"])?$_POST["nombreLocalP"]:$participante[0]["nombreLocalP"] ?>" name="nombreLocalP">
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Horario</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["horarioP"]?>"
                value="<?= isset($_POST["horarioP"])?$_POST["horarioP"]:$participante[0]["horarioP"] ?>" name="horarioP">
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Pagina Web</label>
              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                <input class="form-control" placeholder="<?=$participante[0]["paginaWebP"]?>"
                value="<?= isset($_POST["paginaWebP"])?$_POST["paginaWebP"]:$participante[0]["paginaWebP"] ?>" name="paginaWebP">
              </div>
            </div>
            <div class="form-group separarformulario">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label">Fotografia</label>
              <input type="file" id="ejemplo_archivo_1"
              value="<?= isset($_POST[$participante[0]["fotoP"]])?$_POST[$participante[0]["fotoP"]]:$participante[0]["fotoP"] ?>" name="fotoPi">
              <?= isset($errors["fotoPi"])?$errors["fotoPi"]:"" ?><br>
              <p class="help-block">El tamano maximo permitido es de 3Mb</p></center>
            </div>
            </div>
            <h2 class="alineado"><div><img src="./resources/img/participantes/<?php echo $participante[0]["fotoP"]; ?>.jpg" alt="./resources/img/participantes/<?php echo $participante[0]["fotoP"]; ?>.jpg" class="img-thumbnail" height="200" width="200"></div></h2>
            <input type="submit" class="btn btn-primary col-md-offset-5" value="Guardar modificación">
            <a href="index.php?controller=participante&action=consultaParticipante&id=<?=$participante[0]["usuarioEmail"];?>" type="button" class="btn btn-primary " >Cancelar</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include(__DIR__."../../layouts/pie.php");
?>
