<?php
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../core/ViewManager.php");

class DBController {

  protected $view;

  protected $currentUser;

  public function __construct() {

    $this->view = ViewManager::getInstance();
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    if(isset($_SESSION["currentuser"])) {

      $this->currentUser = $_SESSION["currentuser"];

      $this->view->setVariable("currentusername", $this->currentUser);
    }
  }
}
