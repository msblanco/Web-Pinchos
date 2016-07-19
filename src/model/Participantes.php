<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

/**
 *
 * En esta clase se maneja todo lo relacionado con el enlace participante
 *
 */
class Participantes {

  /**
  *
  * Devuelve un array con los datos necesarios al listar participantes
  * @return string[][] $users_db array por cada participante representados con
  * arrays conteniendo el nombre, la url de la foto y el email
  * @access public
  *
  */

  public function listarParticipantes(){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT `participante`.`nombreLocalP`, `participante`.`fotoP`, `participante`.`usuarioEmail` FROM participante, usuario WHERE ((`usuario`.`tipoU` = 'P') AND (`usuario`.`estadoU` = 1)) GROUP BY `participante`.`usuarioEmail`");
    $stmt->execute();
    $users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users_db;
  }

  /**
  *
  * Devuelve un array con los datos necesarios al buscar participantes
  * @param string $data  Nombre del local para buscar
  * @return string[][] $users_data  Array por cada participante representado con un array de todos sus datos
  * @access public
  *
  */

  public function busquedaParticipante($data){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT `participante`.`nombreLocalP`, `participante`.`fotoP`, `participante`.`usuarioEmail` FROM participante, usuario WHERE ((`participante`.`usuarioEmail` = `usuario`.`emailU`) AND (`usuario`.`estadoU` = 1) AND (`participante`.`nombreLocalP` LIKE ?))");
    $stmt->execute(array("%$data%"));
    $users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users_db;
  }

  /**
  *
  * Devuelve un array con los datos de un participante en específico
  * @param string $email Se buscará el usuario en la base de datos en base a su email
  * @return string[] $users_data  Array con todos los datos del participante
  * @access public
  *
  */

  public function consultaParticipante($email){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT `participante`.*, `usuario`.* FROM usuario, participante  WHERE ((`usuario`.`emailU` = `participante`.`usuarioEmail`) AND (`participante`.`usuarioEmail` = ?))");
    $stmt->execute(array($email));
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user_data;
  }

  /**
  *
  * Devuelve un array con los pinchos asociados a un participante
  * @param string $email Se buscará el pincho con el email de su participante asociado
  * @return string[] $pincho_data  Array conteniendo todos los datos del pincho
  * @access public
  *
  */

  public function pinchosAsoc($email){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT * FROM pincho where participanteEmail=?");
    $stmt->execute(array($email));
    $pincho_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $pincho_data;
  }

  /**
  *
  * Modifica el estado de un participante a desactivado en base a su email
  * @param string $email Se buscará el participante a eliminar con este email
  * @access public
  *
  */

  public function bajaParticipante($email){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE usuario SET estadoU='0' WHERE emailU=?");
    $stmt->execute(array($email));
  }

  /**
  *
  * Modifica los datos de un participante en base a su email
  * @param string $email Clave del usuario
  * @param string $direccion Direccion del local
  * @param string $telefono Numero del local
  * @param stirng $nombreLocal Nombre que tiene el local
  * @param string $horario Horario de apertura y cierre
  * @param string $paginaWeb Url con la página
  * @access public
  *
  */

  public function modificarParticipante($email,$direccion,$telefono,$nombreLocal,$horario,$paginaWeb){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("UPDATE participante SET fotoP=?, direccionP=?, telefonoP=?, nombreLocalP=?, horarioP=?, paginaWebP=? WHERE usuarioEmail=?");
    $stmt->execute(array(md5($nombreLocal),$direccion,$telefono,$nombreLocal,$horario,$paginaWeb,$email));
  }
}
