<?php
include(__DIR__."/../layouts/cabecera.php");
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
?>
<body>
  <script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
  <!--login modal-->
  <div id="loginModal" class="modal show">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-lg-4 text-center col-md-offset-4 col-lg-offset-4" id="login1">
          <div class="modal-body">
            <form class="form col-md-12 center-block" method="POST" action="index.php?controller=users&action=login" id="loginForm">
              <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="Email" name="emailU"> <?= isset($errors["email"])?$errors["email"]:"" ?><br>
              </div>
              <div class="form-group">
                <input type="password" class="form-control input-lg" placeholder="Contraseña" name="password"> <?= isset($errors["email"])?$errors["email"]:"" ?><br>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg" value="Iniciar Sesión">
              </div>
            </form>
            <script>
            $("#loginForm").validate({
              rules: {
                emailU: {
                  required: true,
                  email: true
                },
                password: {
                  required: true,
                  minlength: 4
                }
              },
              messages: {
                emailU: {
                  required: "Campo requerido",
                  email: "Formato de email incorrecto"
                },
                password: {
                  required: "Campo requerido",
                  minlength: "Contraseña incorrecta"
                }
              }
            });
            </script>
          </div>
        </div> <!-- /col -->
      </div> <!-- /row -->
    </div>
  </div>
</body>
