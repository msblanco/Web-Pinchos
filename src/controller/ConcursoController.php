<?php

require_once(__DIR__."/../controller/DBController.php");
require_once(__DIR__."/../model/Concurso.php");
require_once(__DIR__."/../core/ViewManager.php");

class ConcursoController extends DBController {

	/*Variable que representa el objeto Concurso*/
	private $concurso;

	/*Constructor*/
	public function __construct() {
		parent::__construct();

		//Inicializa la variable concurso
		$this->concurso = new Concurso();
	}


	/*Este método hace que se muestren en la vista de consultar
	concurso los datos del propio concurso*/
	public function consultarConcurso() {

		/*Metodo de la clase Concurso que devuelve los datos del concurso*/
		$concu = $this->concurso->ver_datos();

		/* Guarda el valor de la variable $concu en la variable concu accesible
		desde la vista*/
		$this->view->setVariable("concu", $concu);

		/*Permite visualizar: view/vistas/consultaConcurso.php */
		$this->view->render("vistas", "consultaConcurso");
	}


	/* Este metodo hace que se muestren los valores actuales del concurso y
	permite que el usuario administrador los modifique*/
	public function modificarConcurso() {

		if(!$_SESSION["currentuser"]){
			echo "<script>window.location.replace('index.php');</script>";
		}

		$concu= new Concurso();

		if (isset($_POST["nombreC"])){
			/*Metodo de la clase concurso que devuelve un boolean indicando si
			el concurso existe en la base de datos*/
			$existe=$concu->existConcurso();

			/*Si el concurso no existe devuelve un mensaje de error*/
			if(!$existe){
				$errors = array();
				$errors["nombreC"] = "Este concurso no existe, por lo que no se puede modificar";
				$this->view->setVariable("errors", $errors);
				/*Si el concurso si que existe, se guardan los valores introducidos en la
				modificacion en la clase concurso*/
			}else{
				$concu->setIdC('1');
				$concu->setNombreC($_POST["nombreC"]);

				$ruta="./resources/bases/";//ruta carpeta donde queremos copiar las imagenes
				$basesCTemp=$_FILES['basesC']['tmp_name'];//guarda el directorio temporal en el que se sube la imagen
				$basesC=$ruta.$_FILES['basesC']['name'];//indica el directorio donde se guardaran las imagenes
				move_uploaded_file($basesCTemp, $basesC);

				$concu->setBasesC($basesC,$basesCTemp);
				$concu->setCiudadC($_POST["ciudadC"]);
				$concu->setFechaInicioC($_POST["fechaInicioC"]);
				$concu->setFechaFinalC($_POST["fechaFinalC"]);
				$concu->setFechaFinalistasC($_POST["fechaFinalistasC"]);
				$concu->setPremioC($_POST["premioC"]);
				$concu->setPatrocinadorC($_POST["patrocinadorC"]);

				try{
					/*Comprueba si los datos introducidos son validos*/
					$concu->checkIsValidForRegister();

					// Actualiza los datos del concurso
					$concu->update();

					//mensaje de confirmación y redirige al metodo consultarConcurso del controlador ConcursoCotroller
					echo "<script> alert('Modificación realizada correctamente'); </script>";
					echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";

				}catch(ValidationException $ex) {

					$errors = $ex->getErrors();
					$this->view->setVariable("errors", $errors);
				}
			}
		}

		/*Devuelve los datos del concurso para mostrarlos en la vista*/
		$concu = $this->concurso->ver_datos();

		/* Guarda el valor de la variable $concu en la variable concu accesible
		desde la vista*/
		$this->view->setVariable("concu", $concu);

		/*Permite visualizar: view/vistas/modificacionConcurso.php */
		$this->view->render("vistas", "modificacionConcurso");
	}


	/*Funcion para crear un nuevo concurso*/
	public function registro() {

		if(!$_SESSION["currentuser"]){
			echo "<script>window.location.replace('index.php');</script>";
		}

		$concu= new Concurso();
		if (isset($_POST["nombreC"])){
			/*Comprueba si ya existe un concurso en la base de datos*/
			$existe=$concu->existConcurso();
			/*Si existe muestra un mensaje de error ya que solo puede existir un concurso
			en la base de datos*/
			if($existe){
				$errors = array();
				$errors["nombreC"] = "Ya existe un concurso registrado, no puede haber más";
				$this->view->setVariable("errors", $errors);

				/*Si no existe guarda los datos introducidos.*/
			}else{
				$concu->setIdC('1');
				$concu->setNombreC($_POST["nombreC"]);

				$ruta="./resources/bases/";//ruta carpeta donde queremos copiar las imagenes
				$basesCTemp=$_FILES['basesC']['tmp_name'];//guarda el directorio temporal en el que se sube la imagen
				$basesC=$ruta.$_FILES['basesC']['name'];//indica el directorio donde se guardaran las imagenes
				move_uploaded_file($basesCTemp, $basesC);

				$concu->setBasesC($basesC,$basesCTemp);
				$concu->setCiudadC($_POST["ciudadC"]);
				$concu->setFechaInicioC($_POST["fechaInicioC"]);
				$concu->setFechaFinalC($_POST["fechaFinalC"]);
				$concu->setFechaFinalistasC($_POST["fechaFinalistasC"]);
				$concu->setPremioC($_POST["premioC"]);
				$concu->setPatrocinadorC($_POST["patrocinadorC"]);

				try{
					/*Comprueba si los datos son validos*/
					$concu->checkIsValidForRegister();

					// guarda el objeto en la base de datos
					$concu->save();

					//mensaje de confirmación y redirige al metodo consultarConcurso del controlador ConcursoCotroller
					echo "<script> alert('Concurso registrado correctamente'); </script>";
					echo "<script>window.location.replace('index.php?controller=concurso&action=consultarConcurso');</script>";

				}catch(ValidationException $ex) {

					$errors = $ex->getErrors();
					$this->view->setVariable("errors", $errors);
				}
			}
		}
		// renderiza la vista (/view/vistas/altaConcurso.php)
		$this->view->render("vistas", "altaConcurso");

	}
}
