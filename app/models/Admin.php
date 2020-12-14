<?
namespace app\models;
use app\core\Model;

class Admin extends Model{

	public function getPageCount(){
 		return $this->db->column('SELECT COUNT(id) FROM users');
	}

	public function getUser($route){
		$params = [
			'id' => $route['id']
		];
		return $this->db->parseQueryResult('SELECT * FROM users WHERE id= :id', $params);
	}


	public function getList($route, $userPerPage, $sortParams){
		$params = [
			'limit' => $userPerPage,
			'offset' => $userPerPage*(($route['page'] ?? 1)-1),
		];
		$result = $this->db->parseQueryResult('SELECT * 
											   FROM users
											   ORDER BY '.$sortParams['SORT_BY'].' '.$sortParams['SORT_DIRECTION'].'
											   LIMIT :limit 
											   OFFSET :offset',
											   $params
											 );
		return $result;
	}

	public function add($login,$pwd,$name,$second_name,$date_of_birth,$is_admin, $gender){

		$params = [
			'login' => $login,
			'pwd' => $pwd,
			'name' => $name,
			'second_name' => $second_name,
			'date_of_birth' => $date_of_birth,	
			'is_admin' => $is_admin,
			'gender' => $gender
		];
		
		$this->db->query('INSERT INTO users (login, pwd, name,second_name,date_of_birth,is_admin, gender) 
						  VALUES (:login, :pwd, :name, :second_name,:date_of_birth,:is_admin, :gender)',
						  $params
						);
	}


	public function deleteUser($route){
		$params = [
			'id' => $route['id']
		];
		$this->db->query('DELETE FROM users WHERE id = :id', $params);
	}

	public function replaceBy($route, $vars =[], $sortParams){
		$params = [
			'id' => $route['id'],
			'limit' => $vars['userPerPage'],
			'offset' => $vars['userPerPage']*(($vars['current_page'] ?? 1)-1),
		];

		$replaceBy = $this->db->parseQueryResult('SELECT * 
												  FROM users			 
												  EXCEPT 
												  SELECT * 
												  FROM users  
												  where id = :id  
												  ORDER BY '.$sortParams['SORT_BY'].' '.$sortParams['SORT_DIRECTION'].'
												  LIMIT :limit 
												  OFFSET :offset', 
												  $params
												);

		return $replaceBy;
	}

	public function editUser($id, $values =[]){
		$params = [
			'id' => $id,
			'login' => $values['login'],
			'name' => $values['name'],
			'pwd' => $values['pwd'],
			'second_name' => $values['second_name'],
			'gender' => $values['gender'],
			'date_of_birth' => $values['date_of_birth']
		];
		$this->db->query('UPDATE users SET login = :login, name = :name, second_name = :second_name, gender = :gender, date_of_birth = :date_of_birth, pwd = :pwd WHERE id = :id', $params);
	}
}
?>