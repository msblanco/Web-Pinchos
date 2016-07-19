<?php
/* Hacemos los requires de las clases que necesitamos para que el código que contienen sea heredadod en esta clase */
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

/* Creamos la clase User que contiene toda la información relevenate acerca de los usuarios */
class User {

  //private $db;

  /* El email del User */

  private $emailU;

  /* La contraseña del User */

  private $contrasenaU;

  /* El tipo del User */

  private $tipoU;

  /* La estado del User */

  private $estadoU;

  /* El nombre del User */

  private $nombreU;

  /* La concurso del User */

  private $concursoId;

  /* Creamos el constructor de la clase User al que se le pasan los distintos parametros en relacion a la base de datos */
  public function __construct($emailU=NULL, $contrasenaU=NULL, $tipoU=NULL, $estadoU=NULL, $nombreU=NULL, $concursoId=NULL) {

    $this->emailU = $emailU;
    $this->contrasenaU = $contrasenaU;
    $this->tipoU = $tipoU;
    $this->estadoU = $estadoU;
    $this->nombreU = $nombreU;
    $this->concursoId = $concursoId;
  }


  /* Devuelve el email del User */
  public function getEmailU() {
    return $this->emailU;
  }

  /* Pone el email del User */
  public function setEmailU($emailU) {
    $this->emailU = $emailU;
  }

  /* Devuelve la contraseña del User */
  public function getContrasenaU() {
    return $this->contrasenaU;
  }

  /* Pone la contraseña del User */
  public function setContrasenaU($contrasenaU) {
    $this->contrasenaU = $contrasenaU;
  }

  /* Devuelve el tipo del User */
  public function getTipoU() {
    return $this->tipoU;
  }

  /* Pone el tipo del User */
  public function setTipoU($tipoU) {
    $this->tipoU = $tipoU;
  }

  /* Devuelve el estado del User */
  public function getEstadoU() {
    return $this->estadoU;
  }

  /* Pone el estado del User */
  public function setEstadoU($estadoU) {
    $this->estadoU = $estadoU;
  }

  /* Devuelve el nombre del User */
  public function getNombreU() {
    return $this->nombreU;
  }

  /* Pone el nombre del User */
  public function setNombreU($nombreU) {
    $this->nombreU = $nombreU;
  }

  /* Devuelve el concurso del User */
  public function getConcursoId() {
    return $this->concursoId;
  }

  /* Pone el concurso del User */
  public function setConcursoId($concursoId) {
    $this->concursoId = $concursoId;
  }

  /* Comprueba si el usuario actual es válido para registrarse en la base de datos,si no lo es devuelve un mensaje por cada tipo de error encontrado */
  public function checkIsValidForRegister($contrasenaU2) {

    $errors = array();//Se inializa un array errors con los distintos errores que posteriormente serán mostrados si estos se producen
    /*Error de longitud en el email*/
    if (strlen($this->emailU) < 5) {
      $errors["emailU"] = "El email debe contener al menos 5 caracteres de longitud";
    }
    /*Error en la eleccion del tipo de usuario*/
    if ($this->tipoU == 'N') {
      $errors["tipoU"] = "No has escogido el tipo de usuario";
    }
    /*Error de longitud en el nombre*/
    if (strlen($this->nombreU) < 3) {
      $errors["nombreU"] = "El nombre debe contener al menos 3 caracteres de longitud";
    }
    /*Error de longitud de la contraseña*/
    if (strlen($this->contrasenaU) < 5) {
      $errors["contrasenaU"] = "La contraseña debe contener al menos 5 caracteres de longitud";
    }
    /*Error que se produce cuando la contraseña y la contraseña repetida tienen valores diferentes*/
    if ($this->contrasenaU != $contrasenaU2) {
      $errors["contrasenaU2"] = "Las contraseñas no coinciden";
    }
    /*Si hay algún error en las anteriores comprobaciones muestra un mensaje*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El usuario no es válido");
    }

  }
  /* Comprueba si la modificacion del Jurado Popular es válida,si no lo es devuelve un mensaje por cada tipo de error encontrado */
  public function checkIsValidForModificacionJPopu($contrasenaU2) {

    $errors = array(); //Se inializa un array errors con los distintos errores que posteriormente serán mostrados si estos se producen
    /*Error de longitud en el nombre*/
    if (strlen($this->nombreU) < 3) {
      $errors["nombreU"] = "El nombre debe contener al menos 3 caracteres de longitud";
    }
    /*Error de longitud en la contraseña*/
    if (strlen($this->contrasenaU) < 5) {
      $errors["contrasenaU"] = "La contraseña debe contener al menos 5 caracteres de longitud";
    }
    /*Error que se produce cuando la contraseña y la contraseña repetida tienen valores diferentes*/
    if ($this->contrasenaU != $contrasenaU2) {
      $errors["contrasenaU2"] = "Las contraseñas no coinciden";
    }
    /*Si hay algún error en las anteriores comprobaciones muestra un mensaje*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El usuario no es válido");
    }

  }

  /* Comprueba si el Jurado Profesional es válido para registrarse en la base de datos,si no lo es devuelve un mensaje por cada tipo de error encontrado */
  public function checkIsValidForRegisterProf(){

    $errors = array();//Se inializa un array errors con los distintos errores que posteriormente serán mostrados si estos se producen
    /*Error de longitud en el email*/
    if (strlen($this->emailU) < 5) {
      $errors["emailU"] = "El email debe contener al menos 5 caracteres de longitud";
    }
    /*Error de longitud en el nombre*/
    if (strlen($this->nombreU) < 5) {
      $errors["nombreU"] = "El nombre debe contener al menos 5 caracteres de longitud";
    }
    /*Error de longitud en la contraseña*/
    if (strlen($this->contrasenaU) < 5) {
      $errors["contrasenaU"] = "La contraseña debe contener al menos 5 caracteres de longitud";
    }
    /*Si hay algún error en las anteriores comprobaciones muestra un mensaje*/
    if (sizeof($errors)>0){
      throw new ValidationException($errors, "El usuario no es válido");
    }
  }

  /* Guarda en la tabla User los distintos valores que contendrá el usuario*/
  public function save() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("INSERT INTO usuario values (?,?,?,?,?,?)");
    $stmt->execute(array($this->emailU, $this->contrasenaU, $this->tipoU, $this->estadoU, $this->nombreU, $this->concursoId));
    if($this->tipoU == 'P'){
      $stmt=$db->prepare("INSERT INTO participante values (?,?,?,?,?,?,?)");
      $stmt->execute(array('Vacio','Vacio','Vacio','Vacio','Vacio','Vacio',$this->emailU));
    }
  }

  /* Actualiza el User en la base de datos,para ello se hace un update de los distintos campos que contiene la tabla usuario*/
  public function update($currentuserEmail) {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE usuario SET contrasenaU=?, nombreU=? where emailU=?");
    $stmt->execute(array($this->contrasenaU, $this->nombreU, $currentuserEmail));
  }


  /* Comprueba si el email ya se encuentra en la base de datos,es decir, si ya hay algun usuario regitrado que utilice ese email*/
  public function usernameExists() {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(emailU) FROM usuario where emailU=?");
    $stmt->execute(array($this->emailU));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /* Comprueba si hay algún usuario registrado con el par email/contraseña en la base de datos */

  public function isValidUser($emailU, $contrasenaU) {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT count(emailU) FROM usuario where emailU=? and contrasenaU=?");
    $stmt->execute(array($emailU, $contrasenaU));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /* Muestra todos los datos del User,para ello se seleccionan todos los datos de la tabla usuario para posteriormente rellenar un objeto
  de tipo User que contendrá toda la informacion de los distintos campos encontrados en la base de datos*/

  public function ver_datos($emailU) {
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM usuario where emailU=?");
    $stmt->execute(array($emailU));
    $user_db=$stmt->fetch(PDO::FETCH_ASSOC);

    if(sizeof($user_db)==0){
      return null;

    }else{
      return new User(
      $user_db["emailU"],
      $user_db["contrasenaU"],
      $user_db["tipoU"],
      $user_db["estadoU"],
      $user_db["nombreU"],
      $user_db["concursoId"]
    );
  }
}

/*Sirve para poner un usuario como inactivo,para ello se actualiza el valor del estado a 0 en la base de datos(1 activo,0 inactivo)*/
public function updateEstado($currentuserEmail){
  $db = PDOConnection::getInstance();
  $stmt = $db->prepare("UPDATE usuario set estadoU='0' where emailU=?");
  $stmt->execute(array($currentuserEmail));
}

}
