<?
namespace app\core;

class View{

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route){
		$this->route = $route;
		$this->path = $route['CONTROLLER'].'/'.$route['ACTION'];
	}

	//Render page
	public function render($title, $vars = []){
		extract($vars);
		if(file_exists('app/views/'.$this->path.'.php')){
			ob_start();
			include 'app/views/'.$this->path.'.php';
			$content = ob_get_clean();
			include 'app/views/layouts/'.$this->layout.'.php';
		}
	}

	//Render error page
	public static function errorCode($code){
		http_response_code($code);
		require 'app/views/errors/'.$code.'.php';
		exit;
	}

	//Render some message. For example "The field Name can't be empty!"
 	public function message($message,$status) {
		exit(json_encode(['message' => $message, 'status'=> $status]));
	}

	//In the case of using AJAX on the loaded page
	//For example, sorting data, or deleting some user from the list
	public function renderNew($ar, $pag){
		foreach ($ar as $key => $value) {
			json_encode([$key => $value]);
		}
		exit(json_encode(['ar' => $ar, 'pag' => $pag]));
	}

	//Redirect methods:
	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}

}
?>