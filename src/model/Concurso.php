<?php
/* Hacemos los requires de las clases que necesitamos para que el código que contienen sea heredados en esta clase */
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");


/* Creamos la clase Concurso que contiene toda la información relevenate acerca del mismo */
class Concurso {

  //private $db;

  /* El id del Concurso */

  private $idC;

  /* El nombre del Concurso */

  private $nombreC;

  /* Las bases del Concurso */

  private $basesC;

  private $basesCTemp;

  /* La ciudad del Concurso */

  private $ciudadC;

  /* La fecha del Concurso */

  private $fechaInicioC;

   /* La fecha del Concurso */

  private $fechaFinalC;

   /* La fecha del Concurso */

  private $fechaFinalistasC;

  /* El premio del Concurso */

  private $premioC;

  /* El premio del Concurso */

  private $patrocinadorC;

  /* Creamos el constructor de la clase Concurso al que se le pasan los distintos parametros en relacion a la base de datos */
  public function __construct($idC=NULL, $nombreC=NULL, $basesC=NULL, $ciudadC=NULL, $fechaInicioC=NULL, $fechaFinalC=NULL, $fechaFinalistasC=NULL, $premioC=NULL, $patrocinadorC=NULL) {

    $this->idC = $idC;
    $this->nombreC = $nombreC;
    $this->basesC = $basesC;
    $this->ciudadC = $ciudadC;
    $this->fechaInicioC = $fechaInicioC;
	$this->fechaFinalC = $fechaFinalC;
	$this->fechaFinalistasC = $fechaFinalistasC;
    $this->premioC = $premioC;
	$this->patrocinadorC = $patrocinadorC;
  }


  /* Devuelve el id del Concurso */
  public function getIdC() {
    return $this->idC;
  }

  /* Pone el id del Concurso */
  public function setIdC($idC) {
    $this->idC = $idC;
  }

  /* Devuelve la contraseña del Concurso */
  public function getNombreC() {
    return $this->nombreC;
  }

  /* Pone la contraseña del Concurso */
  public function setNombreC($nombreC) {
    $this->nombreC = $nombreC;
  }

  /* Devuelve las bases del Concurso */
  public function getBasesC() {
    return $this->basesC;
  }

  public function setbasesC($basesC,$basesCTemp) {
    $this->basesC = $basesC;
    $this->basesCTemp = $basesCTemp;
  }


  /* Devuelve la ciudad del Concurso */
  public function getCiudadC() {
    return $this->ciudadC;
  }

  /* Pone la fecha del Concurso */
  public function setCiudadC($ciudadC) {
    $this->ciudadC = $ciudadC;
  }

  /* Devuelve la fecha del Concurso */
  public function getFechaInicioC() {
    return $this->fechaInicioC;
  }

  /* Pone la fecha del Concurso */
  public function setFechaInicioC($fechaInicioC) {
    $this->fechaInicioC = $fechaInicioC;
  }

  /* Devuelve la fecha del Concurso */
  public function getFechaFinalC() {
    return $this->fechaFinalC;
  }

  /* Pone la fecha del Concurso */
  public function setFechaFinalC($fechaFinalC) {
    $this->fechaFinalC = $fechaFinalC;
  }

  /* Devuelve la fecha del Concurso */
  public function getFechaFinalistasC() {
    return $this->fechaFinalistasC;
  }

  /* Pone la fecha del Concurso */
  public function setFechaFinalistasC($fechaFinalistasC) {
    $this->fechaFinalistasC = $fechaFinalistasC;
  }

  /* Devuelve el premio del Concurso */
  public function getPremioC() {
    return $this->premioC;
  }

  /* Pone el premio del Concurso */
  public function setPremioC($premioC) {
    $this->premioC = $premioC;
  }

  /* Devuelve el premio del Concurso */
  public function getPatrocinadorC() {
    return $this->patrocinadorC;
  }

  /* Pone el premio del Concurso */
  public function setPatrocinadorC($patrocinadorC) {
    $this->patrocinadorC = $patrocinadorC;
  }

  /* Comprueba si el Concurso es válido para registrarse en la base de datos,si no lo es devuelve un mensaje por cada tipo de error encontrado */
  public function checkIsValidForRegister() {

    $errors = array();//Se inializa un array errors con los distintos errores que posteriormente serán mostrados si estos se producen
	/*Error de longitud en el nombre*/
    if (strlen($this->nombreC) < 4) {
      $errors["nombreC"] = "El nombre debe contener al menos 4 caracteres de longitud";
    }
	/*Error de longitud en las bases*/
    if (strlen($this->basesC) < 24) {
      $errors["basesC"] = "Las bases no son correctas";
    }
	/*Error de longitud en la ciudad*/
    if (strlen($this->ciudadC) < 2) {
      $errors["ciudadC"] = "La ciudad debe contener al menos 2 caracteres de longitud";
    }
	/*Error de fecha del concurso inferior a la actual*/
	if ($this->fechaInicioC < date("Y-m-d")) {
      $errors["fechaInicioC"] = "La fecha debe ser posterior al dia de hoy";
    }
	if(!preg_match("/(20[0-9][0-9])[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $this->fechaInicioC)){
		$errors["fechaInicioC"] = "La fecha introducida no tiene el formato correcto (YYYY-MM-DD)";
	}
	if(!preg_match("/(20[0-9][0-9])[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $this->fechaFinalC)){
		$errors["fechaFinalC"] = "La fecha introducida no tiene el formato correcto (YYYY-MM-DD)";
	}
	if(!preg_match("/(20[0-9][0-9])[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/", $this->fechaFinalistasC)){
		$errors["fechaFinalistasC"] = "La fecha introducida no tiene el formato correcto (YYYY-MM-DD)";
	}
	/*Error de fecha del concurso inferior a la actual*/
	if ($this->fechaFinalC < $this->fechaFinalistasC) {
      $errors["fechaFinalC"] = "La fecha debe ser posterior a la de finalistas";
    }
	/*Error de fecha del concurso inferior a la actual*/
	if ($this->fechaFinalistasC < $this->fechaInicioC) {
      $errors["fechaFinalistasC"] = "La fecha debe ser posterior a la de inicio";
    }
	/*Error de longitud en el patrocinador*/
	if (strlen($this->patrocinadorC) < 3) {
      $errors["patrocinadorC"] = "El patrocinador debe contener al menos 3 caracteres de longitud";
    }
	/*Error de longitud en el premio*/
    if (strlen($this->premioC) < 2) {
      $errors["premioC"] = "El valor del premio no es correcto";
    }
	/*Si hay algún error en las anteriores comprobaciones muestra un mensaje*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El concurso no es válido");
    }

  }

  /* Guarda en la tabla Concurso los distintos valores que contendrá el propio concurso*/
  public function save() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("INSERT INTO concurso values (?,?,?,?,?,?,?,?,?)");
    $stmt->execute(array($this->idC, $this->nombreC, $this->basesC, $this->ciudadC, $this->fechaInicioC, $this->fechaFinalC, $this->fechaFinalistasC, $this->premioC, $this->patrocinadorC));
  }

  /* Actualiza el Concurso en la base de datos,para ello se hace un update de los distintos campos que contiene la tabla concurso*/
  public function update() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE concurso SET idC=?, nombreC=?, basesC=?, ciudadC=?, fechaInicioC=?, fechaFinalC=?, fechaFinalistasC=?, premioC=?, patrocinadorC=?");
    $stmt->execute(array($this->idC, $this->nombreC, $this->basesC, $this->ciudadC, $this->fechaInicioC, $this->fechaFinalC, $this->fechaFinalistasC, $this->premioC, $this->patrocinadorC));
  }
  /* Compruebas si existe el concurso en la base de datos */
  public function existConcurso(){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(idC) FROM concurso");  /*Se cuenta el numero de idC de la tabla concurso y si este es mayor a 0
															   indica que ya hay un concurso registrado*/
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
      return true;
    }else return false;
  }

  /* Comprueba si el id xa existe en la base de datos */
  /*
  public function idExists() {

  $stmt = $this->db->prepare("SELECT count(idC) FROM concurso where idC=?");
  $stmt->execute(array($this->idC));

  if ($stmt->fetchColumn() > 0) {
  return true;
}
}
*/
  /* Muestra todos los datos del Concurso,para ello se seleccionan todos los datos de la tabla concurso para posteriormente rellenar un objeto
  de tipo Concurso que contendrá toda la  informacion de los distintos campos encontrados en la base de datos */
  public function ver_datos() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM concurso");
    $stmt->execute();
    $concursos_db=$stmt->fetch(PDO::FETCH_ASSOC);

    if(sizeof($concursos_db)==0){
      return null;
    }else{
      return new Concurso(
      $concursos_db["idC"],
      $concursos_db["nombreC"],
      $concursos_db["basesC"],
      $concursos_db["ciudadC"],
      $concursos_db["fechaInicioC"],
	  $concursos_db["fechaFinalC"],
	  $concursos_db["fechaFinalistasC"],
      $concursos_db["premioC"],
	  $concursos_db["patrocinadorC"]
       );
    }
  }

}
