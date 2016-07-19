<?php
/* Hacemos los requires de las clases que necesitamos para que el código que contienen sea heredados en esta clase */
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Pincho.php");
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

/* Creamos la clase Voto que contiene toda la información relevenate acerca del mismo */
class Voto {

  //private $db;

   /* El email del Usuario */

  private $usuarioEmailU;

  /* El Id del Pincho */

  private $pinchoIdPi;

  /* El codigo del Pincho */

  private $codigoPinchoV;

  /* La valoracion del Pincho */

  private $valoracionV;


 /* Creamos el constructor de la clase Voto al que se le pasan los distintos parametros en relacion a la base de datos */
 public function __construct($usuarioEmailU=NULL, $pinchoIdPi=NULL, $codigoPinchoV=NULL, $valoracionV=NULL) {

    $this->usuarioEmailU = $usuarioEmailU;
    $this->pinchoIdPi = $pinchoIdPi;
	$this->codigoPinchoV = $codigoPinchoV;
    $this->valoracionV = $valoracionV;
  }


    /* Devuelve el email del User */
  public function getUsuarioEmailU() {
    return $this->usuarioEmailU;
  }

  /* Pone el email del User */
  public function setUsuarioEmailU($usuarioEmailU) {
    $this->usuarioEmailU = $usuarioEmailU;
  }

   /* Devuelve el id del Pincho */
  public function getPinchoIdPi() {
    return $this->pinchoIdPi;
  }

  /* Pone el id del Pincho */
  public function setPinchoIdPi($pinchoIdPi) {
    $this->pinchoIdPi = $pinchoIdPi;
  }

   /* Devuelve el codigo del Pincho */
  public function getCodigoPinchoV() {
    return $this->codigoPinchoV;
  }

  /* Pone el codigo del Pincho */
  public function setCodigoPinchoV($codigoPinchoV) {
    $this->codigoPinchoV = $codigoPinchoV;
  }

   /* Devuelve la valoracion del Pincho */
  public function getValoracionV() {
    return $this->valoracionV;
  }

  /* Pone la valoracion del Pincho */
  public function setValoracionV($valoracionV) {
    $this->valoracionV = $valoracionV;
  }
  
 
  /* Comprueba si la valoracion del Voto es válida para registrarse en la base de datos,si no lo es devuelve un mensaje de error */
  public function checkIsValidForVoto(){
	
	$errors = array();//Se inializa un array errors con los distintos errores que posteriormente serán mostrados si estos se producen
	/*Error en la seleccion de la valoracion*/
    if ($this->valoracionV ==  'N') {
      $errors["valoracionV"] = "Se debe seleccionar una valoracion";
    }
    /*Si hay algún error en la anterior comprobacion muestra un mensaje*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "La votacion no es válida");
    }
	
  }
  
  /* Guarda en la tabla Voto los distintos valores que contendrá el propio voto*/
  public function save() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("INSERT INTO voto values (?,?,?,?)");
    $stmt->execute(array($this->usuarioEmailU, $this->pinchoIdPi, $this->codigoPinchoV, $this->valoracionV));
  }
  
  /* Comprueba si ya existe previamente el voto en la base de datos*/
  public function votoExist(){
  
	$db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(*) FROM voto where codigoPinchoV=?");/*Se cuenta si el numero de codigoPinchoV que sean iguales al que estamos introduciendo de la tabla voto y si este es mayor a 0
															                 indica que ya esta el voto registrado*/
	
    $stmt->execute(array($this->codigoPinchoV));

	
    if ($stmt->fetchColumn() > 0) {
      return true;
    }else return false;
  }
  
  /* Comprueba si el codigo del voto es correcto*/
  public function isCorrectCode(){
  
	$db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(*) FROM codVoto where idCV=?");
    $stmt->execute(array($this->codigoPinchoV));
	
    if ($stmt->fetchColumn()==0) {
        return false;
    }else {
		$stmt = $db->prepare("SELECT pinchoId FROM codVoto where idCV=?");
		$stmt->execute(array($this->codigoPinchoV));
		$codigo=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->pinchoIdPi = $codigo["pinchoId"];
		return true;
	}
	
  }
  
  /* Comprueba si el codigo del voto es igual al codigo del pincho*/
  public function isPinchoEquals($votoPincho){
  
	if($this->getPinchoIdPi()==$votoPincho->getPinchoIdPi()){
		return true;
	}else{
		return false;
	}
	
  }
  
  /* Devuelve todos los datos de los votos realizados que se encuentran en la base de datos asociados al usuario en uso*/
  public function getDatosVotos($currentuserEmail) {
  
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM voto WHERE usuarioEmailU=? ");
    $stmt->execute(array($currentuserEmail));
    $voto_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$votos=array();
	
	foreach ($voto_db as $voto) {
		array_push($votos, new Voto($voto["usuarioEmailU"], $voto["pinchoIdPi"], $voto["codigoPinchoV"], $voto["valoracionV"]));
    }   
    return $votos;
	
  }
  /* Devuelve el nombre del pincho de la base de datos*/
  public function getNombrePincho(){
  
	$db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT pincho.nombrePi FROM voto,pincho WHERE voto.pinchoIdPi=pincho.idPi and voto.codigoPinchoV=?");
    $stmt->execute(array($this->codigoPinchoV));
    $nombre_db=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if(sizeof($nombre_db)==0){
      return null;

    }else{
      return new Pincho(null,$nombre_db["nombrePi"]);
    }
  }
  /* Actualiza el numero de votos(lo incrementa en 1) que tiene un pincho despues de realizarse un nuevo voto*/
  public function updateNumVotos(){
	
	$db = PDOConnection::getInstance();
	$stmt = $db->prepare("SELECT numvotosPopPi FROM pincho where idPi=?");
    $stmt->execute(array($this->pinchoIdPi));
	$numVotos=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$numVotos["numvotosPi"]++;
	
    $stmt = $db->prepare("UPDATE pincho SET numvotosPopPi=? WHERE IdPi=?");
    $stmt->execute(array($numVotos["numvotosPopPi"], $this->pinchoIdPi));
  }
  /* Comprueba si el pincho ya ha sido votado por el usuario en uso*/
  public function isPinchoVotado($currentuserEmail){
	
	$db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(*) FROM voto where usuarioEmailU=? and pinchoIdPi=?");
    $stmt->execute(array($currentuserEmail,$this->pinchoIdPi));
	
    if ($stmt->fetchColumn() > 0) {
      return true;
    }else return false;
  
  }
  /* Actualiza el numero de votos(hace la media) que tiene un pincho despues de realizar un nuevo voto el jurado profesional*/
   public function updateNumVotosProf(){
	
	$db = PDOConnection::getInstance();
	$stmt = $db->prepare("SELECT numvotosProfPi FROM pincho where idPi=?");
    $stmt->execute(array($this->pinchoIdPi));
	$numVotos=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$stmt1 = $db->prepare("SELECT count(*) FROM voto,usuario where voto.pinchoIdPi=? and usuario.emailU=voto.usuarioEmailU and usuario.tipoU='S'");
    $stmt1->execute(array($this->pinchoIdPi));
	
	if($stmt1->fetchColumn()==0){
		$numVotosTotal=$this->valoracionV;
	}else $numVotosTotal=($numVotos["numvotosProfPi"]+$this->valoracionV)/2;

	
	
    $stmt = $db->prepare("UPDATE pincho SET numvotosProfPi=? WHERE IdPi=?");
    $stmt->execute(array($numVotosTotal, $this->pinchoIdPi));
  }
  
  /*Este metodo comprueba si el pincho al que se esta votando pertenece a la
  lista de finalistas del jurado profesional.*/
  public function esPinchoFinalista(){
    $db = PDOConnection::getInstance();
	$stmt = $db->prepare("SELECT count(*) FROM premiados WHERE ronda='1' and idPrem=?");
    $stmt->execute(array($this->pinchoIdPi));
	
	if($stmt->fetchColumn()==0){
		return false;
	}else{
		return true;
	}
  
  }
  


}
