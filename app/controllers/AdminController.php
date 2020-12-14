<?
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;
use app\lib\Pagination;


class AdminController extends Controller{

	public function listAction(){
		if(isset($_SESSION['ADMIN_FLAG'])){
			$vars = [
				'adminFlag' => $_SESSION['ADMIN_FLAG'],
				'adminName' => $_SESSION['ADMIN_NAME'],
			];
		}

		
		$pagination = new Pagination($this->route,  $this->model->getPageCount());

		$vars['userPerPage'] = $pagination->userPerPage;
		$vars['current_page'] = $pagination->current_page;

		
		$renderPagination = $pagination->getPagination();		

		if (!empty($_POST))	{
			$_SESSION['SORT_BY'] = $_POST['sort-by'];
			$_SESSION['SORT_DIRECTION'] = $_POST['sort-direction'];
			$sortParams['SORT_BY'] =  $_SESSION['SORT_BY'];
			$sortParams['SORT_DIRECTION'] = $_SESSION['SORT_DIRECTION'];

			$newSortderData = $this->model->getList($this->route, $pagination->userPerPage, $sortParams);
			$this->view->renderNew($newSortderData, $renderPagination);
		}

		$sortParams['SORT_BY'] =  $_SESSION['SORT_BY'] ?? 'name';
		$sortParams['SORT_DIRECTION'] = $_SESSION['SORT_DIRECTION'] ?? 'ASC';

		$users = $this->model->getList($this->route, $pagination->userPerPage, $sortParams);

		$vars['users'] = $users;
		$vars['pagination'] = $renderPagination;

		$this->view->render("User's  list", $vars);
	}
	
	public function detailAction(){

		$user = $this->model->getUser($this->route);
		$vars['user'] = $user[0];
		$this->view->render('User '.$user[0]['login'], $vars);
	}

	public function addAction(){
		if (!empty($_POST)){ 

			$empty = $this->checkEmptyFields($_POST);			
			if($empty)
				$this->view->message($empty, 404);

			$_POST['login'] = htmlspecialchars($_POST['login']);
			$_POST['pwd'] = htmlspecialchars($_POST['pwd']);
			$_POST['name'] = htmlspecialchars($_POST['name']);
			$_POST['second_name'] = htmlspecialchars($_POST['second_name']);
			$is_admin = isset($_POST['is_admin']) ? 1 : 0; 

			$this->model->add($_POST['login'], $_POST['pwd'], $_POST['name'],$_POST['second_name'],$_POST['date_of_birth'], $is_admin, $_POST['gender']);
			$this->view->location('/admin/list');
		}
		$this->view->render('Add new user');
	}

	public function editAction(){
		if(!empty($_POST)){
			$empty = $this->checkEmptyFields($_POST);
			
			if($empty)
				$this->view->message(404, $empty);

			$_POST['login'] = htmlspecialchars($_POST['login']);
			$_POST['pwd'] = htmlspecialchars($_POST['pwd']);
			$_POST['name'] = htmlspecialchars($_POST['name']);
			$_POST['second_name'] = htmlspecialchars($_POST['second_name']);

			$this->model->editUser($this->route['id'], $_POST);
			$this->view->message("User's  data has been changed", 200);
		}
	}

	public function deleteAction(){
		$this->model->deleteUser($this->route);

		$pagination = new Pagination($this->route,  $this->model->getPageCount());
		$vars['id'] = $this->route['id'];
		$vars['userPerPage'] = $pagination->userPerPage;
		$vars['current_page'] = $pagination->current_page;
		
		$sortParams['SORT_BY'] =  $_SESSION['SORT_BY'] ?? 'name';
		$sortParams['SORT_DIRECTION'] = $_SESSION['SORT_DIRECTION'] ?? 'ASC';
		
		$replacerBy = $this->model->replaceBy($this->route, $vars, $sortParams);
		$newPagination = $pagination->getPagination();
		$this->view->renderNew($replacerBy, $newPagination ); //
	}

	public function logoutAction() {
		unset($_SESSION['ADMIN_FLAG']);
		unset($_SESSION['ADMIN_NAME']);
		$this->view->redirect('/');
	}

}
?>