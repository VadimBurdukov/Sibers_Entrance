<?
namespace app\models;
use app\core\Model;


class Main extends Model{

	public function adminValidate($login, $pwd){
		$params = [
			'login' => $login,
			'pwd' => (int)$pwd,
		];

		$result = $this->db->column('SELECT * 
									 FROM users 
									 WHERE login = :login AND
									       pwd = :pwd AND
									       is_admin = 1',
									 $params
									);
		if ($result){
			return true;		
		} 				
		return false;		
	}
}
?>