<?php
require_once(__DIR__."/../model/Concurso.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/DBController.php");

class UsersController extends DBController {

  /*Variable que representa el objeto User*/
  private $user;
  private $concurso;

  /*Constructor*/
  public function __construct() {
    parent::__construct();

    //Inicializa la variable
    $this->user = new User();
    //Inicializa la variable
    $this->concurso = new Concurso();
  }

  /*Metodo que loguea al usuario*/
  public function login() {

    if (isset($_POST["email"])){

      /*Comprueba que los datos introducidos son validos*/
      if ($this->user->isValidUser($_POST["email"], $_POST["password"])) {

        /*Recupera los datos del usuario que se esta logueando*/
        $user_db=$this->user->ver_datos($_POST["email"]);

        /*Si el estado de ese usuario no es inactivo continua*/
        if (!$user_db->getEstadoU() == '0') {

          /*Guarda en sesion el objeto usuario*/
          $_SESSION["currentuser"]=$user_db;

          //Redirige al método consultarConcurso del ConcursoController.php
          $this->view->redirect("concurso", "consultarConcurso");

          /*Si el estado de ese usuario es inactivo muestra un mensaje de error*/
        }else{
          $errors = array();
          $errors["email"] = "Este usuario esta inactivo ";
          $this->view->setVariable("errors", $errors);
        }

        /*Si los datos introducidos no son validos devuelve mesaje de error*/
      }else{
        $errors = array();
        $errors["email"] = "El email no se encuentra registrado";
        $this->view->setVariable("errors", $errors);
      }
    }
	$this->view->render("vistas","portada");
  }

  /*Este metodo permite el registro de usuarios*/
  public function registro() {

    $usuario= new User();

    if (isset($_POST["emailU"])){

      /*Guarda los datos en el objeto*/
      $usuario->setEmailU($_POST["emailU"]);
      $usuario->setContrasenaU($_POST["contrasenaU"]);
      $usuario->setTipoU($_POST["tipoU"]);
      $usuario->setEstadoU('1');
      $usuario->setNombreU($_POST["nombreU"]);
      $usuario->setConcursoId('1');

      try{
        /*Comprueba si los datos son validos para el registro*/
        $usuario->checkIsValidForRegister($_POST["contrasenaU2"]);

        // comprueba si el correo ya existe en la base de datos
        if (!$usuario->usernameExists()){

          // guarda el objeto  en la base de datos
          $usuario->save();

          //mensaje de confirmación y redirige al método login del UsersController.php
          echo "<script> alert('Usuario creado correctamente'); </script>";
          echo "<script>window.location.replace('index.php');</script>";

          /*Si el correo ya existe muestra un mensaje de error*/
        } else {
          $errors = array();
          $errors["emailU"] = "El email ya se encuentra registrado";
          $this->view->setVariable("errors", $errors);
        }
      }catch(ValidationException $ex) {

        $errors = $ex->getErrors();
        $this->view->setVariable("errors", $errors);
      }
    }
    $this->view->render("vistas","portada");
  }


  /*Este metodo selecciona una vista según el tipo de usuario que es */
  public function seleccionarVotacion() {
	
    if(!$_SESSION["currentuser"]){
      echo "<script>window.location.replace('index.php');</script>";
    }
    /*Datos del usuario actual*/
    $currentuser = $_SESSION["currentuser"];

    $concu = $this->concurso->ver_datos();
	$valido=true;
	
    if($concu->getFechaInicioC() > date("Y-m-d")){
		echo "<script> alert('La fecha de votaciones todavia no ha empezado'); </script>";
		echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";
		$valido=false;
    }
    if($concu->getFechaFinalC() < date("Y-m-d")){
		echo "<script> alert('La fecha de votaciones ya ha terminado'); </script>";
		echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";
		$valido=false;
    }

    if($currentuser->getTipoU() == 'J'  && $valido){
      $this->view->redirect("popular", "votar");
    }
    if($currentuser->getTipoU() == 'S' && $valido){
      $this->view->redirect("profesional", "votar");
    }
    /*Si no es ninguno de los jurados muestra una excepcion*/
    if(($currentuser->getTipoU() != 'S') and ($currentuser->getTipoU() != 'J')){
		echo "<script> alert('Solo puede votar el jurado'); </script>";
		echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";
    }
  }

  /*Este metodo selecciona una vista según el tipo de usuario que es */
  public function seleccionarPerfil() {

    if(!$_SESSION["currentuser"]){
      echo "<script>window.location.replace('index.php');</script>";
    }

    /*Datos del usuario actual*/
    $currentuser = $_SESSION["currentuser"];

    if($currentuser->getTipoU() == 'J'){
      $this->view->redirect("popular", "verPerfil");
    }
    if($currentuser->getTipoU() == 'S'){
      $this->view->redirect("profesional", "verPerfil");
    }
    if($currentuser->getTipoU() == 'P'){
      echo "<script>window.location.replace('index.php?controller=participante&action=consultaParticipante&di=di');</script>";
    }
  }

  /*Este metodo selecciona una vista según el tipo de usuario que es */
  public function seleccionarModificacion() {

    if(!$_SESSION["currentuser"]){
      echo "<script>window.location.replace('index.php');</script>";
    }

    /*Datos del usuario actual*/
    $currentuser = $_SESSION["currentuser"];

    if($currentuser->getTipoU() == 'J'){
      $this->view->redirect("popular", "verModificacion");
    }
    if($currentuser->getTipoU() == 'S'){
      $this->view->redirect("profesional", "verModificacion");
    }
    if($currentuser->getTipoU() == 'P'){
      echo "<script>window.location.replace('index.php?controller=participante&action=consultaParticipante&di=di');</script>";
    }
  }


  //Este metodo cierra la sesion y devuelve a login
  public function logout() {
    if(!$_SESSION["currentuser"]){
      echo "<script>window.location.replace('index.php');</script>";
    }
    session_destroy();
    $this->view->redirect("users", "login");
  }

  /*Este metodo redirige a la portada de la web*/
  public function portada(){
    $this->view->render("vistas","portada");
  }

  /*Este metodo redirige al menú de registro*/
  public function registroPortada(){
    $errors["tipoU"] = "";
    $this->view->setVariable("errors", $errors);
    $this->view->render("vistas","portada");
  }
}
