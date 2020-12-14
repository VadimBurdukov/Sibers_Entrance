<?
namespace app\core;
use app\core\View;


abstract class Controller{
	public $route;
	public $view;
	public $model;
	public $acl;

	public function __construct($route){
		//Initialising route
		$this->route = $route;
		//Initialising view
		$this->view = new View($route);
		//Checking the access rights. 
		//If user doesn't have the following rights - redirect him on the 403 page
		if(!$this->checlAcl()){
			$this->view->errorCode(403);
		}
		//Load model
		$this->model = $this->loadModel($route['CONTROLLER']);
	}

	public function loadModel($name){
		$path = 'app\models\\'.ucfirst($name);
		if(class_exists($path)){
			return new $path;
		}
		else
			exit('no model');
	}

	//Check required fileds on emptyness
	//Returns false if all fields are filled
	//Strings with the foloowing errors otherwise 
	public function checkEmptyFields($post){

		$erFlag = false;
		$errors = null;
		foreach ($post as $key=>$value) {
			//debug($post[$key]);
			if(empty($post[$key])){
				$errors.= "Field ".$key. " should be filled!\n";
				$erFlag = true;
			}
		}

		if($erFlag)
			return $errors;

		return $erFlag;
	}

	public function checlAcl(){
		$this->acl = require 'app/acl/'.$this->route['CONTROLLER'].'.php';
		$this->acl;
		if($this->isAcl('all')){
			return true;
		}
		elseif(isset($_SESSION['ADMIN_FLAG']) && $this->isAcl('admin')){
			return true;
		}
		return false;
	}

	public function isAcl($key){
		return in_array($this->route['ACTION'], $this->acl[$key]);
	}
}
?>