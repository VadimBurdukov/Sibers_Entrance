<?
namespace app\core;

class Router{

	protected  $routes = [];
	protected  $params = [];

	//Read file with routes
	//Construct the route array
	public function __construct(){
		$routesAr = require 'app/config/routes.php';
		foreach ($routesAr as $key => $value) {
			$this->addRoute($key, $value);
		}
	}

	public function addRoute($route, $params){
		//Regular expressions for the case, if we have to send ID of element
		//For example /admin/edit/{id:2}
		$route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
		$route = '#^'.$route.'$#';
		$this->routes[$route] = $params;
	}

	//Searching the URL in route array
	//If there are soma params in the URL => write them in the class property
	public function matchRoute(){
		$url = trim($_SERVER['REQUEST_URI'], '/');
		foreach ($this->routes as $route => $params) {	
			if (preg_match($route, $url, $matches)) {
				foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
				$this->params = $params;
				return true;
			}
		}
		return false;
	}

	//Check the URL with matchRoute method. 
	//If route exists - Use the following class and method
	//Redirect to 404 page otherwise  
	public function RunRouter(){
		if($this->matchRoute()){
			$path = 'app\controllers\\'.ucfirst($this->params['CONTROLLER']).'Controller';
			if (class_exists($path)){
				$action = $this->params['ACTION'].'Action';	
				if(method_exists($path, $action)){
					$controller = new $path($this->params);
					$controller -> $action();

				} else {
					View::errorCode(404);
				}
			} else {
				View::errorCode(404);
			}
		} else {
			View::errorCode(404);
		}			
	}
}

?>