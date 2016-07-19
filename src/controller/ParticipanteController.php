<?php
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Participantes.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/FileManager.php");
require_once(__DIR__."/../controller/DBController.php");

/**
*
* Clase a la que realizar llamadas desde frontend realizando el procesado
* necesario y conectado al modelo para obetener/insertar datos
*
*/

class ParticipanteController extends DBController {

  /**
  *
  * Variable para el modelo (singleton)
  *
  */

  private $participante;

  /**
  *
  * Constructor en el que se crea la instancia del participante (singleton)
  *
  */

  public function __construct() {
    parent::__construct();
    $this->participante = new Participantes();
  }

  /**
  *
  * Funcion que obtiene el listado de participantes que cumplen un requisito,
  * en caso de no haber, lanza una excepcion y notifica del problema,
  * en caso de haber devuelve el array con los datos necesarios a la vista.
  * @access public
  */

  public function busquedaParticipante(){
    $participantes_array = array();
    if (isset($_POST["datosBusqueda"])){
      $participantes_array = $this->participante->busquedaParticipante($_POST["datosBusqueda"]);
    } else {
      $participantes_array = $this->participante->listarParticipantes();
    }
    $this->view->setVariable("participantes", $participantes_array);
    $this->view->render("vistas", "buscarPart");
  }

  /**
  *
  * Funcion que devuelve los datos de un participante definido por su email.
  * @access public
  *
  */

  public function consultaParticipante(){
    if (isset($_GET["id"])){
      $userEmail = $_GET["id"];
    }
    if (isset($_GET["di"])){
      $userEmail = $_SESSION["currentuser"];
      $userEmail = $userEmail->getEmail();
    }
    $participanteData = array();
    $participanteData = $this->participante->consultaParticipante($userEmail);
    if ($participanteData == NULL) {
      throw new Exception("No existe participante");
    }
    $participanteDataPinchos = array();
    $participanteDataPinchos = $this->participante->pinchosAsoc($userEmail);
    if ($participanteDataPinchos != NULL) {
      $this->view->setVariable("participantePinchos", $participanteDataPinchos);
    }
    $this->view->setVariable("participante", $participanteData);
    $this->view->render("vistas", "consultaPart");
  }

  /**
  *
  * Funcion que modifca los datos de un participante en base a su email.
  * Pimero parte comprueba que el usuario existe.
  * Segundo actualiza los datos de su tabla usuario, con las funciones del modelo User.
  * Finalmente modifica los datos de su tabla participante con el modelo Participantes
  * y redirecciona con los nuevos datos
  * @access public
  *
  */

  public function modificarParticipante(){
    if (isset($_GET["id"])){
      $userEmail = $_GET["id"];
      $participanteData = array();
      $participanteData = $this->participante->consultaParticipante($userEmail);
      if ($participanteData == NULL) {
        throw new Exception("No existe participante");
      }
      $this->view->setVariable("participante", $participanteData);
      $this->view->render("vistas", "modificacionPart");
    }
    if (isset($_GET["di"])){
      $userEmail = $_SESSION["currentuser"];
      $userEmail = $userEmail->getEmail();
      $participanteData = array();
      $participanteData = $this->participante->consultaParticipante($userEmail);
      if ($participanteData == NULL) {
        throw new Exception("No existe participante");
      }
      $this->view->setVariable("participante", $participanteData);
      $this->view->render("vistas", "modificacionPart");
    }

    if (isset($_POST["nombreU"])){
      $usuario= new User();
      $participante = new Participantes();
      $usuario->setContrasenaU($_POST["contrasenaU"]);
      $usuario->setNombreU($_POST["nombreU"]);
      try{
        $usuario->checkIsValidForModificacionJPopu($_POST["contrasenaU2"]);
        $usuario->update($_GET["did"]);
        $participante->modificarParticipante($_GET["did"],$_POST["direccionP"],$_POST["telefonoP"],$_POST["nombreLocalP"],$_POST["horarioP"],$_POST["paginaWebP"]);
        $ruta="./resources/img/participantes/";//ruta carpeta donde queremos copiar las imagenes
        $fotoPi = $ruta.md5($_POST["nombreLocalP"]).".jpg";
        $fotoPiTemp = $_FILES['fotoPi']['tmp_name'];
        move_uploaded_file($fotoPiTemp,$fotoPi);//pasa la foto de la carpeta temporal a la del servidor web

        echo "<script> alert('Usuario modificado correctamente'); </script>";
      }catch(ValidationException $ex) {
        $errors = $ex->getErrors();
        $this->view->setVariable("errors", $errors);
      }
      $this->busquedaParticipante();
    }
  }

  /**
  *
  * Da de baja un participante definido por su email.
  * @access public
  *
  */

  public function bajaParticipante(){
    if (isset($_GET["id"])){
      $userEmail = $_GET["id"];
    }
    $this->participante->bajaParticipante($userEmail);
    $this->busquedaParticipante();
  }
}
