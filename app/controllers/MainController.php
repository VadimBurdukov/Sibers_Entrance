<?
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

/* In the Controller class we load the following models,
 * Check the access rights
 * Or check the POST array on emptyness
 */

class MainController extends Controller{	

	public function loginAction(){
		if (!empty($_POST))	{

			/* checkEmptyFields - is a Controller's class method.
			 * takes POST arr as input and if some of it's elements is empty
			 *returns the folowing message
			 */
			$empty = $this->checkEmptyFields($_POST);			
			if($empty)
				/* message - is a View's class method.
				 * takes text of message and it's status as input 
				 * exit's, creating a foloowing JSON for AJAX method
				 */
				$this->view->message($empty, 404);

			$_POST['login'] = htmlspecialchars($_POST['login']);
			$_POST['pwd'] = htmlspecialchars($_POST['pwd']);

			//If the login and password a correct
			$adminValidate = $this->model->adminValidate($_POST['login'], $_POST['pwd']);
			if ($adminValidate){
				$_SESSION['ADMIN_FLAG'] = true;
				$_SESSION['ADMIN_NAME'] = $_POST['login'];
				$this->view->location('admin/list');
			}
			else 
				$this->view->message('Wrong login or password', 404);
		}
		/* render - is a View's class method.
		 * takes text of title as input 
		 * and render the corresponding to the URL template
		 */
		$this->view->render('Enter'); 
	}
}
?>