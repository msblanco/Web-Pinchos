<?php
require_once(__DIR__."/../model/Pincho.php");
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class CodVoto {

  private $idCV;/* El id del Pincho */
  private $pinchoId;/* La nombre del Pincho */
  private $pincho;

  public function __construct($idCV=NULL,$pinchoId=NULL) {

    $this->idCV = $idCV;
    $this->pinchoId = $pinchoId;

    $this->pincho = new Pincho();
  }



  /* Devuelve el id del Codigo del Voto */
  public function getIdCV() {
    return $this->idCV;
  }

  /* Pone el id del Codigo del Voto */
  public function setIdCV($idCV) {
    $this->idCV = $idCV;
  }

  /* Devuelve el id del Pincho */
  public function getPinchoId() {
    return $this->pinchoPi;
  }

  /* Pone el id del Pincho */
  public function setPinchoId($pinchoId) {
    $this->nombrePi = $pinchoPi;
  }


  //

  /**
  *
  * Genera 4 codigos de voto a partir del id de un pincho y los introduce
  * en la base de datos.
  * @param string $IdPi identificador del pincho.
  * @access public
  *
  */

  public function generateCodVote($IdPi){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT idCV FROM codVoto where pinchoId=?");//cuenta los codigos de voto de un pincho
    $stmt->execute(array($IdPi));
    $CV=$stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($vcount);die();
    for ($i = 1; $i <= 4; $i++) {
      $idCVtemp = sizeof($CV)+$i;
      $IdVoto = $IdPi.$idCVtemp;
      //print_r($IdVoto);die();
      $stmt = $db->prepare("INSERT INTO codVoto values (?,?)");
      $stmt->execute(array($IdVoto,$IdPi));

    }
    //print_r($IdPi);die();
  }

  /**
  *
  * Genera 4 codigos de voto mas a partir del id de un pincho y los añade
  * en la base de datos.
  * @param string $tipob es el identificador de un pincho
  *        int $numCV es el numero de codigos de voto asociados a un pincho.
  * @access public
  *
  */

  public function generateMoreCV($IdPi, $numCV){
    $db = PDOConnection::getInstance();
    $stmt = $db->prepare("SELECT idCV FROM codVoto where pinchoId=?");//cuenta los codigos de voto de un pincho
    $stmt->execute(array($IdPi));
    $CV=$stmt->fetch(PDO::FETCH_ASSOC);
    for ($i = 1; $i <= 4; $i++) {
      $idCVtemp = $numCV+$i;
      $IdVoto = $IdPi.$idCVtemp;
      //print_r($IdVoto);die();
      $stmt = $db->prepare("INSERT INTO codVoto values (?,?)");
      $stmt->execute(array($IdVoto,$IdPi));

    }
    //print_r($IdPi);die();
  }

}
