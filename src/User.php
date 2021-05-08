<?php
namespace CF;
use CF\Db\Db;

interface IUser {

	public function getRole():int;
}

class User implements Iuser {

	private $login;
	private $roleId;
	private $db;

	const USER_SALT='1213130';

	public function __construct(Db $db) {
		$this->db = $db;
	}

	public function setRole(int $roleId) {
		$thi->roleId = $roleId;
	}

	public function getRole():int {
		return $this->roleId;
	}

	public function getLogin():string {
		return $this->login;
	}

	public function setLogin(string $login) {
		$this->login = $login;
	}

	public function isCredentialsRight(string $password):bool {
		
		$result = $this->db->exec('
			SELECT u1.user_id, u1.role_id, u1.login
			  FROM users u1
			 WHERE u1.login = "s:login"
			   AND u1.password = "s:password"
		', [
			'login'		=> $this->getLogin(),
			'password'	=> sha1($password.User::USER_SALT),
		]);
		

		return $result->num_rows;
	}
}