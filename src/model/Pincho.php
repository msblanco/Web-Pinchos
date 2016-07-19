<?php
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Pincho {

  private $idPi;/* El id del Pincho */
  private $nombrePi;/* La nombre del Pincho */
  private $precioPi;/* El precio del Pincho */
  private $ingredientesPi;/* La ingredientes del Pincho */
  private $cocineroPi;/* El cocinero del Pincho */
  private $numVotosPi;/* El numero de veces que un picho ha sido votado */
  private $fotoPi;//guarda el directorio donde se almacenará la imagen
  private $fotoPiSize;//guarda el tamaño del la imagen
  private $estadoPi;/* El estado del Pincho */
  private $numvotePi;/* Es el numero de votos creados para un Pincho*/
  private $ParticipanteEmail;/* El ParticipanteEmail del Pincho */

  public function __construct($idPi=NULL,
  $nombrePi=NULL,
  $precioPi=NULL,
  $ingredientesPi=NULL,
  $cocineroPi=NULL,
  $numvotosPopPi=NULL,
  $numvotosProfPi=NULL,
  $fotoPi=NULL,
  $fotoPiSize=NULL,
  $estadoPi=NULL,
  $ParticipanteEmail=NULL,
  $numvotePi=NULL) {
    $this->idPi = $idPi;
    $this->nombrePi = $nombrePi;
    $this->precioPi = $precioPi;
    $this->ingredientesPi = $ingredientesPi;
    $this->cocineroPi = $cocineroPi;
    $this->numvotosPopPi = $numvotosPopPi;
    $this->numvotosProfPi = $numvotosProfPi;
    $this->fotoPi = $fotoPi;
    $this->fotoPiSize = $fotoPiSize;
    $this->estadoPi = $estadoPi;
    $this->numvotePi = $numvotePi;
    $this->ParticipanteEmail = $ParticipanteEmail;
  }


  /* Devuelve el id del Pincho */
  public function getIdPi() {
    return $this->idPi;
  }

  /* Pone el id del Pincho */
  public function setIdPi($idPi) {
    $this->idPi = $idPi;
  }

  /* Devuelve el nombre del Pincho */
  public function getNombrePi() {
    return $this->nombrePi;
  }

  /* Pone el nombre del Pincho */
  public function setNombrePi($nombrePi) {
    $this->nombrePi = $nombrePi;
  }

  /* Devuelve el precio del Pincho */
  public function getPrecioPi() {
    return $this->precioPi;
  }

  /* Pone el tipo del Pincho */
  public function setPrecioPi($precioPi) {
    $this->precioPi = $precioPi;
  }

  /* Devuelve la ingredientes del Pincho */
  public function getIngredientesPi() {
    return $this->ingredientesPi;
  }

  /* Pone la ingredientes del Pincho */
  public function setIngredientesPi($ingredientesPi) {
    $this->ingredientesPi = $ingredientesPi;
  }

  /* Devuelve el cocinero del Pincho */
  public function getCocineroPi() {
    return $this->cocineroPi;
  }

  /* Pone el cocinero del Pincho */
  public function setCocineroPi($cocineroPi) {
    $this->cocineroPi = $cocineroPi;
  }

  /* Devuelve el numero de votos del Pincho */
  public function getNumVotosPopPi() {
    return $this->numvotosPopPi;
  }

  /* Pone el numero de votos del Pincho */
  public function setNumVotosPopPi($numvotosPopPi) {
    $this->numvotosPopPi = $numvotosPopPi;
  }

  /* Devuelve el numero de votos del Pincho */
  public function getNumVotosProfPi() {
    return $this->numvotosProfPi;
  }

  /* Pone el numero de votos del Pincho */
  public function setNumVotosProfPi($numvotosProfPi) {
    $this->numvotosProfPi = $numvotosProfPi;
  }

  /* Devuelve la foto del Pincho */
  public function getFotoPi() {
    return $this->fotoPi;
  }

  /* Pone la foto del Pincho */
  public function setFotoPi($fotoPi,$fotoPiSize) {
    $this->fotoPi = $fotoPi;
    $this->fotoPiSize = $fotoPiSize;
  }

  /* Devuelve el estado del Pincho */
  public function getEstadoPi() {
    return $this->estadoPi;
  }

  /* Pone el estado del Pincho */
  public function setEstadoPi($estadoPi) {
    $this->estadoPi = $estadoPi;
  }

  /* Devuelve el ParticipanteEmail del Pincho */
  public function getNumVotePi() {
    return $this->numvotePi;
  }

  /* Pone el ParticipanteEmail del Pincho */
  public function setNumVotePi($numvotePi) {
    $this->numvotePi = $numvotePi;
  }

  /* Devuelve el ultimo codigo de voto asignado a un Pincho */
  public function getParticipanteEmail() {
    return $this->ParticipanteEmail;
  }

  /* Pone el ultimo codigo de voto asignado a un Pincho */
  public function setParticipanteEmail($ParticipanteEmail) {
    $this->ParticipanteEmail = $ParticipanteEmail;
  }

  /**
  *
  * Genera un identificador para un pincho
  * @return int $idPincho. Devuelve el identificador de un pincho
  * @access public
  *
  */

  public function generarIdPi(){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT idPi FROM pincho ");
    $stmt->execute();
    $idPincho = ($stmt->rowCount())+1;
    return $idPincho;
  }

  /**
  *
  * Comprueba si el id ya existe en la base de datos
  * @param string $Participante Clave del usuario
  * @return boolean. Devuelve verdadero si encuentra 1 o mas pinchos de un mismo
  * @access public
  *
  */

  public function pinchoExists($Participante) {
    $estadoPi="1";
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where ParticipanteEmail=?");
    $stmt->execute(array($Participante));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /**
  *
  * Comprueba si el id ya existe en la base de datos
  * @param string $Participante Clave del usuario
  * @return boolean. Devuelve verdadero si encuentra 1 o mas pinchos de un mismo
  * participate con estado activo
  * @access public
  *
  */

  public function pinchoExistsAct($Participante) {
    $estadoPi="1";
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where ParticipanteEmail=? AND estadoPi=?");
    $stmt->execute(array($Participante,$estadoPi));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /**
  *
  * Comprueba si alguno de los parametros que vienen de la vista es nulo o menor
  * del tamaño esperado
  * @return Lanza una excepcion
  * @access public
  *
  */

  public function checkInfoIfNullPi(){

    $errors = array();
    if (strlen($this->nombrePi) < 1) {
      $errors["nombrePi"] = "El nombre debe contener al menos 1 caracteres de longitud";
    }
    if (strlen($this->ingredientesPi) < 5) {
      $errors["ingredientesPi"] = "Los ingredientes debe contener al menos 5 caracteres de longitud";
    }
    if (strlen($this->precioPi) < 1) {
      $errors["precioPi"] = "El precio NO puede ser NULO";
    }
    if (strlen($this->cocineroPi) < 1) {
      $errors["cocineroPi"] = "El nombre del cocinero/a debe contener al menos 1 caracteres de longitud";
    }
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El pincho no es válido");
    }
  }

  /**
  *
  * Controla que la foto tenga el tamaño adecuado y el precio el minimo establecido
  * @return Lanza una excepcion
  * @access public
  *
  */

  public function checkInfoPi(){

    $errors = array();

    if($this->fotoPiSize>(2048*1024)){//el archivo no puede ser mayor de 2MB
      $errors["fotoPi"] = "El tamaño de la imagen debe ser INFERIOR a 2MB";
    }
    if($this->precioPi < 1){//el archivo no puede ser mayor de 2MB
      $errors["precioPi"] = "El precio del pincho debe ser al menos de 1€";
    }
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El pincho no es válido");
    }
  }

  /**
  *
  * Inserta un pincho en la base de datos
  * @access public
  *
  */

  public function savePi() {
    $db = PDOConnection::getInstance();

    $stmt = $db->prepare("INSERT INTO pincho values (?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->execute(array($this->idPi,
    $this->nombrePi,
    $this->precioPi,
    $this->ingredientesPi,
    $this->cocineroPi,
    $this->numvotosPopPi,
    $this->numvotosProfPi,
    $this->fotoPi,
    $this->estadoPi,
    $this->ParticipanteEmail,
    $this->numvotePi));
  }

  /**
  *
  * Selecciona la informacion referente a un pincho de la base de datos
  * @param int $idPi Clave del pincho
  * @return devuelve toda la informacion de un pincho
  * @access public
  *
  */

  public function showDatesPi($idPi){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where idPi=?");
    $stmt->execute(array($idPi));
    $pincho_db=$stmt->fetch(PDO::FETCH_ASSOC);

    if(sizeof($pincho_db)==0){
      return null;
    }else{
      return new Pincho($pincho_db["idPi"],
      $pincho_db["nombrePi"],
      $pincho_db["precioPi"],
      $pincho_db["ingredientesPi"],
      $pincho_db["cocineroPi"],
      $pincho_db["numvotosPopPi"],
      $pincho_db["numvotosProfPi"],
      $pincho_db["fotoPi"],
      0,//indica si tiene errores la foto
      $pincho_db["estadoPi"],
      $pincho_db["participanteEmail"],
      $pincho_db["numvotePi"]);

    }
  }

  /**
  *
  * Actualiza la información de un pincho en la base de datos
  * @access public
  *
  */

  public function updatePi($idPi) {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE pincho SET estadoPi=?, nombrePi=?, precioPi=?, ingredientesPi=?, cocineroPi=?, fotoPi=? where idPi=?");
    $stmt->execute(array($this->estadoPi, $this->nombrePi, $this->precioPi, $this->ingredientesPi, $this->cocineroPi, $this->fotoPi, $idPi));
  }

  /**
  *
  * Actualiza la el numero de codigos de un pincho en la base de datos
  * @access public
  *
  */

  public function updateVotoPi($idPi) {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE pincho SET numvotePi=? where idPi=?");
    $stmt->execute(array($this->numvotePi, $idPi));
    //print_r($this->estadoPi);die();
  }

  /**
  *
  * Recoge la infrmacion de todos los pinchos de la base de datos y los introduce en un array
  * @return $pincho[] array.Devuelve un array con toda la iformacion de cada pincho
  * de la base de datos que no esta validado
  * @access public
  *
  */

  public function listarPi(){
    $noactivo = "0";
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where estadoPi=?");
    $stmt->execute(array(($noactivo)));
    $pinchos_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pinchos=array();

    foreach ($pinchos_db as $pincho) {
      array_push($pinchos, new Pincho($pincho["idPi"],
      $pincho["nombrePi"],
      $pincho["precioPi"],
      $pincho["ingredientesPi"],
      $pincho["cocineroPi"],
      $pincho["numvotosPopPi"],
      $pincho["numvotosProfPi"],
      $pincho["fotoPi"],
      0,//indica si tiene errores la foto
      $pincho["estadoPi"],
      $pincho["participanteEmail"],
      $pincho["numvotePi"]));
    }
    return $pinchos;
  }

  /**
  *
  * Recoge la informacion de todos los pinchos con estado activo de
  * la base de datos y los introduce en un array
  * @return $pincho[] array. Devuelve un array con toda la iformacion de cada
  * pincho de la base de datos con estado activo
  * @access public
  *
  */

  public function listarPiActivos(){
    $activo = "1";
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where estadoPi=?");
    $stmt->execute(array(($activo)));
    $pinchos_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pinchos=array();

    foreach ($pinchos_db as $pincho) {
      array_push($pinchos, new Pincho($pincho["idPi"],
      $pincho["nombrePi"],
      $pincho["precioPi"],
      $pincho["ingredientesPi"],
      $pincho["cocineroPi"],
      $pincho["numvotosPopPi"],
      $pincho["numvotosProfPi"],
      $pincho["fotoPi"],
      0,//indica si tiene errores la foto
      $pincho["estadoPi"],
      $pincho["participanteEmail"],
      $pincho["numvotePi"]));
    }
    return $pinchos;
  }

  /**
  *
  * Recoge la informacion de todos los pinchos del participante actual que hay
  * en la base de datos y los introduce en un array
  * @return $pincho[] array. Devuelve un array con toda la informacion de cada
  * pincho de la base de datos que haya creado el participante actual
  * @access public
  *
  */

  public function listarPiPart(){
    $currentuser = $_SESSION["currentuser"];;
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where ParticipanteEmail=?");
    $stmt->execute(array(($currentuser->getEmailU())));
    $pinchos_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pinchos=array();

    foreach ($pinchos_db as $pincho) {
      array_push($pinchos, new Pincho($pincho["idPi"],
      $pincho["nombrePi"],
      $pincho["precioPi"],
      $pincho["ingredientesPi"],
      $pincho["cocineroPi"],
      $pincho["numvotosPopPi"],
      $pincho["numvotosProfPi"],
      $pincho["fotoPi"],
      0,//indica si tiene errores la foto
      $pincho["estadoPi"],
      $pincho["participanteEmail"],
      $pincho["numvotePi"]));
    }
    return $pinchos;
  }

  /**
  *
  * Busca en la base de datos los pinchos que cumplan las condiciones indicadas
  * por el usuario
  * @param string $tipob Tipo de parametro de busqueda. string $param.
  * Parametro de busqueda introducido por el usuario
  * @return $pinchos[][] array. Devuelve un array con los pinchos que
  * cumplen las condiciones de busqueda
  * @access public
  *
  */

  public function searchPi($tipob,$param){
    $db = PDOConnection::getInstance();
    $activo='1';
    if($tipob=='nombrePi'){
      $stmt = $db->prepare("SELECT * FROM pincho where nombrePi=? AND estadoPi=?");
      $stmt->execute(array($param,$activo));
    }else if($tipob=='precioPi'){
      $stmt = $db->prepare("SELECT * FROM pincho where precioPi<=? AND estadoPi=?");
      $stmt->execute(array($param,$activo));
    }else if($tipob=='ingredientesPi'){
      $param = '%'.$param.'%';
      $stmt = $db->prepare("SELECT * FROM pincho where ingredientesPi LIKE ? AND estadoPi=?");
      $stmt->execute(array($param,$activo));
    }else if ($tipob=='N'){
      $stmt = $db->prepare("SELECT * FROM pincho where estadoPi=?");
      $stmt->execute(array($activo));
    }

    $pinchos_db=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pinchos=array();

    foreach ($pinchos_db as $pincho) {
      array_push($pinchos, new Pincho($pincho["idPi"],
      $pincho["nombrePi"],
      $pincho["precioPi"],
      $pincho["ingredientesPi"],
      $pincho["cocineroPi"],
      $pincho["numvotosPopPi"],
      $pincho["numvotosProfPi"],
      $pincho["fotoPi"],
      0,//indica si tiene errores la foto
      $pincho["estadoPi"],
      $pincho["participanteEmail"],
      $pincho["numvotePi"]));
    }
    return $pinchos;
  }

  /**
  *
  * Crea un listado con todos los premiados por el jurado profesional y sus datos
  * @return string[][] $premiados Array compuesto por un arrays, cada uno con
  * los datos de un premiado
  * @access public
  *
  */

  public function listarPremPro(){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT `pincho`.* FROM premiados, pincho WHERE (`premiados`.`idPrem` = `pincho`.`idPi`)");
    $stmt->execute();
    $premiados = $stmt->fetchAll(PDO::FETCH_BOTH);
    return $premiados;
  }

  /**
  *
  * Crea un listado con todos los premiados por el jurado popular y sus datos
  * @return string[][] $premiados Array compuesto por un arrays, cada uno con
  * los datos de un premiado
  * @access public
  *
  */

  public function listarPremPop(){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT `pincho`.*FROM pincho ORDER BY `pincho`.`numvotosPopPi` DESC limit 10");
    $stmt->execute();
    $premiados = $stmt->fetchAll(PDO::FETCH_BOTH);
    return $premiados;
  }

  /**
  *
  * En su ejecucion se cierra el concurso de modo que se crea el listado de participantes
  * que han ganado por el jurado profesional y se reinician sus valorariones de la tabla
  * @access public
  *
  */

  public function crearFin(){
    $db = PDOConnection::getInstance();
    $stmt1 = $db->prepare("SELECT `pincho`.`idPi` FROM pincho ORDER BY `pincho`.`numvotosProfPi` DESC limit 10");
    $stmt1->execute();
    $premiados = $stmt1->fetchAll(PDO::FETCH_BOTH);
    $stmt2 = $db->prepare("DELETE FROM `premiados`");
    $stmt2->execute();
    foreach($premiados as $premiado){
      $stmt3 = $db->prepare("INSERT INTO `premiados`(`idPrem`, `ronda`) VALUES (?,'1')");
      $stmt3->execute(array($premiado['idPi']));
    }
    $stmt4 = $db->prepare("UPDATE `pincho` SET `numvotosProfPi`=0");
    $stmt4->execute();
    $stmt5 = $db->prepare("UPDATE voto, usuario SET `valoracionV`=0 WHERE ((`voto`.`usuarioEmailU` = `usuario`.`emailU`) AND (`usuario`.`tipoU` = ?))");
    $stmt5->execute(array("S"));
  }
}
