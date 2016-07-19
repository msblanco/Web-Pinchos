<?php
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Voto.php");
require_once(__DIR__."/../model/Pincho.php");
require_once(__DIR__."/../model/Concurso.php");
require_once(__DIR__."/../controller/DBController.php");
require_once(__DIR__."/../core/ViewManager.php");

class ProfesionalController extends DBController {

  /*Variable que representa el objeto User*/
  private $user;
  private $voto;
  private $concurso;

  /*Constructor*/
  public function __construct() {
    parent::__construct();

	if(!$_SESSION["currentuser"]){
		  echo "<script>window.location.replace('index.php');</script>";
	}

	//Inicializa la variable
    $this->user = new User();
	$this->voto = new Voto();
	$this->concurso = new Concurso();
  }

  /*Metodo que genera la contraseña para e jurado profesional*/
  public function generarContrasena(){

	//Calcula la contraseña
    $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $longpalabra=8;
    for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
      $x = rand(0,$n);
      $pass.= $caracteres[$x];
    }
	//permite que la contraseña creada se pueda utilizar en la vista
    $this->view->setVariable("contrasenaGenerada", $pass);
	//renderiza la vista view/vistas/altaJProf.
	$this->view->render("vistas", "altaJProf");
  }


  /*Metodo que permite el registro del jurado profesional*/
  public function registrarProfesional() {

    $profesional= new User();

    if (isset($_POST["emailU"])){

		/*Guarda los datos introducidos en el objeto*/
      $profesional->setEmailU($_POST["emailU"]);
      $profesional->setContrasenaU($_POST["contrasenaU"]);
      $profesional->setTipoU('S');
      $profesional->setEstadoU('1');
      $profesional->setNombreU($_POST["nombreU"]);
      $profesional->setConcursoId('1');

	  if($this->concurso->existConcurso()){
      try{

	    /*Comprueba que los datos introducidos son validos*/
        $profesional->checkIsValidForRegisterProf();

        // comprueba si el correo ya existe en la base de datos
        if (!$profesional->usernameExists()){

          // guarda el objeto  en la base de datos
          $profesional->save();

		  //mensaje de confirmación y redirige al metodo consultarConcurso del controlador ConcursoCotroller
		  echo "<script> alert('Usuario creado correctamente'); </script>";
		  echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";

		 //si el correo existe muestra un mensaje de error
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
	else{
		$errors = array();
        $errors["emailU"] = "No hay ningun concurso al que asociar este jurado";
        $this->view->setVariable("errors", $errors);
	}
	}
	/*Permite visualizar: view/vistas/altaJProf.php */
    $this->view->render("vistas", "altaJProf");


 }

  /*Este método hace la primera parte de la votación del jurado profesional,
  en la que cada uno puede votar un pincho con una puntuacion de 0 a 5
  y con estas votaciones se obtendrán los finalistas.*/
  public function votar() {

  $currentuser = $_SESSION["currentuser"];

	$errors = array();

    $votoPincho= new Voto();

    if (isset($_POST["codigoP"])){

	  //Comprueba que la valoración introducida es correcta
	  $votoPincho->checkIsValidForVoto();

	  /*Guarda los datos introducidos en el formulario en el objeto, más el
	  email del usuario actual que es el que realiza la votacion*/
	  $votoPincho->setUsuarioEmailU($currentuser->getEmailU());
	  $votoPincho->setCodigoPinchoV($_POST["codigoP"]);
	  $votoPincho->setValoracionV($_POST["valoracionP"]);

	  /*Comprueba si el codigo introducido es correcto y lo introduce en el objeto*/
	  if(!$votoPincho->isCorrectCode()){
		 $errors["codigoP"] = "El código introducido no pertenece a ningun pincho";
	  }

	  if($votoPincho->isPinchoVotado($currentuser->getEmailU())){
		 $errors["codigoP"] = "Este codigo pertenece a un pincho que ya has votado";
	  }

	  try{

		// comprueba si el código del pincho introducido ya forma parte de un voto anterior
		if ((!$votoPincho->votoExist())){

		  //continua solo si no se ha producido ningun error

		 $concu = $this->concurso->ver_datos();

		 /*En el caso de que ya sea la fecha en la que ya se deben saber los finalistas,
		 apartir de ese momento el jurado profesional solamenre podra votar a los pinchos
		 que sean finalistas (los que esten en la tabla premiados con el valor del
		 atributo "ronda=1")*/
		 if($concu->getFechaFinalistasC() <= date("Y-m-d")){
			  if(!$votoPincho->esPinchoFinalista()){
				$errors["codigoP"] = "Este pincho no pertenece a la lista de finalistas";
			  }
		  }

		  if (!sizeof($errors)>0){

			  $votoPincho->updateNumVotosProf();

			  /*Si no es asi, guarda las votaciones en la base de datos*/
			  $votoPincho->save();

			  //mensaje de confirmación y redirige al metodo verPerfil del controlador profesionalCotroller
			  echo "<script> alert('Voto registrado correctamente'); </script>";
			  echo "<script>window.location.replace('index.php?controller=profesional&action=verPerfil');</script>";

		  }else{ $this->view->setVariable("errors", $errors);}

		  /*Si ya existe en la base de datos muestra un mensaje de error*/
		} else {
		  $errors["codigoP"] = "Este código ya esta registrado";
		  $this->view->setVariable("errors", $errors);
		}

	  }catch(ValidationException $ex) {
		$errors = $ex->getErrors();
	  }

    }

	/*Permite visualizar: view/vistas/votarJPopu.php */
    $this->view->render("vistas", "votarJProf");
  }



  /*Este metodo permite desactivar la cuenta del usuario*/
  public function desactivarCuenta() {

	/*Recoge el usuario actual*/
	$currentuser = $_SESSION["currentuser"];

	/*Actualiza el estado del usuario a inactivo=0 */
	$this->user->updateEstado($currentuser->getEmailU());

	//mensaje de confirmación y redirige al método login del UsersController.php
	echo "<script> alert('Cuenta eliminada correctamente'); </script>";
	echo "<script>window.location.replace('index.php');</script>";

	// renderiza la vista (/view/vistas/consultaJprof.php)
	$this->view->render("vistas", "consultaJprof");
}

  /*Este metodo permite ver los datos del usuario actual, ademas de ver sus votos*/
  public function verPerfil(){

	$currentuser = $_SESSION["currentuser"];

	// find the Post object in the database
	$votos = $this->voto->getDatosVotos($currentuser->getEmailU());

	$this->view->setVariable("votos", $votos);

	$nombrePincho = array();
	foreach ($votos as $voto) {
		$nombrePincho_valor = $voto->getNombrePincho();
		$nombrePincho[$voto->getCodigoPinchoV()] = $nombrePincho_valor;

	}

	$this->view->setVariable("nombrePincho", $nombrePincho);

	$this->view->render("vistas", "consultaJProf");
  }

  /*Este metodo permite modificar los datos del usuario*/
   public function verModificacion(){

	$currentuser = $_SESSION["currentuser"];
	$usuario= new User();

    if (isset($_POST["nombreU"])){

		/*Guarda en el objeto los datos introducidos*/
        $usuario->setContrasenaU($_POST["contrasenaU"]);
        $usuario->setNombreU($_POST["nombreU"]);

        try{

		  /*Comprueba que los datos introducidos son validos*/
          $usuario->checkIsValidForModificacionJPopu($_POST["contrasenaU2"]);

          // gActualiza los datos en la base de datos
          $usuario->update($currentuser->getEmailU());

		   //Actualiza la sesión con los datos modificados
		  $_SESSION["currentuser"] = $this->user->ver_datos($currentuser->getEmailU());

		  //mensaje de confirmación y redirige al método verPerfil del ProfesionalController.php
		  echo "<script> alert('Usuario modificado correctamente'); </script>";
		  echo "<script>window.location.replace('index.php?controller=profesional&action=verPerfil');</script>";

        }catch(ValidationException $ex) {
          $errors = $ex->getErrors();
          $this->view->setVariable("errors", $errors);
        }
    }

	/*Recupera los datos del usuario*/
    $usuario = $this->user->ver_datos($currentuser->getEmailU());

    /* Guarda el valor de la variable $usuario en la variable user accesible
	desde la vista*/
    $this->view->setVariable("user", $usuario);

	/*Permite visualizar: view/vistas/modificacionJProf.php */
    $this->view->render("vistas", "modificacionJProf");

  }
}
