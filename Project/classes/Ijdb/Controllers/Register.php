<?php
namespace Ijdb\Controllers;
use \Hanbit\DatabaseTable;

class Register {
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function registrationForm() {
		return ['template' => 'register.html.php', 
				'title' => 'USER REGISTRATION'];
	}


	public function success() {
		return ['template' => 'registersuccess.html.php', 
			    'title' => 'REGISTER SUCCESS'];
	}

	public function registerUser() {
		$author = $_POST['author'];

		// 데이터는 처음부터 유효하다고 가정
		$valid = true;
		$errors = [];

		// 하지만 항목이 빈 값이면 $valid에 false 할당
		if (empty($author['name'])) {
			$valid = false;
			$errors[] = 'NAME PLAESE';
		}

		if (empty($author['email'])) {
			$valid = false;
			$errors[] = 'EMAIL PLEASE';
		}
		else if (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'NOT VALID EMAIL';
		}
		else { // 이메일 주소가 빈 값이 아니고 유효하다면
			// 이메일 주소를 소문자로 변환
			$author['email'] = strtolower($author['email']);

			// $author['email']을 소문자로 검색
			if (count($this->authorsTable->find('email', $author['email'])) > 0) {
				$valid = false;
				$errors[] = 'ALREADY EXIST EMAIL';
			}
		}


		if (empty($author['password'])) {
			$valid = false;
			$errors[] = 'PASSWORD PLEASE';
		}

		// $valid가 true라면 빈 항목이 없으므로
		// 데이터를 추가할 수 있음
		if ($valid == true) {
			// 데이터베이스에 저장하기 전에 비밀번호를 해시화
			$author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

			// 폼이 전송되면 $author 변수는
			// 소문자 메일과 비밀번호 해시값을 포함
			$this->authorsTable->save($author);

			header('Location: /author/success');
		}
		else {
			// 데이터가 유효하지 않으면 폼을 다시 출력
			return ['template' => 'register.html.php', 
				    'title' => 'USER REGISTER',
				    'variables' => [
				    	'errors' => $errors,
				    	'author' => $author
				    ]
				   ]; 
		}
	}
}