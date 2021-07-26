<?php
namespace Ijdb\Controllers;

class Login {
	private $authentication;

	public function __construct(\Hanbit\Authentication $authentication) {
		$this->authentication = $authentication;
	}

	public function loginForm() {
		return ['template' => 'login.html.php', 'title' => 'LOGIN'];
	}

	public function processLogin() {
		if ($this->authentication->login($_POST['email'], $_POST['password'])) {
			header('location: /login/success');
		}
		else {
			return ['template' => 'login.html.php',
					'title' => 'LOGIN',
					'variables' => [
							'error' => 'USER NAME/PASSWORD NOT VAILD'
						]
					];
		}
	}

	public function success() {
		return ['template' => 'loginsuccess.html.php', 'title' => 'LOGIN SUCCESS'];
	}

	public function error() {
		return ['template' => 'loginerror.html.php', 'title' => 'LOGIN FAIL'];
	}

	public function logout() {
		unset($_SESSION);
		session_destroy();
		return ['template' => 'logout.html.php', 'title' => 'LOGOUT. GOOD BYE.'];
	}
}
