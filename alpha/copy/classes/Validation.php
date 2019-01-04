<?php

class Validation {

	private $regEx = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/'; 

	public function validLogin($login) {
		if (mb_strlen($login, 'UTF-8') > 5) {
			$ok = 'jest zajebiście';
			return $ok;
		} else {
			return false;
		}
	}

	public function validEmail($email) {
		if (preg_match($regEx, $email)){
			return true;
		} else {
			return false;
		}
	}

	public function validPass($password) {
		if (mb_strlen($password, 'UTF-8') > 5) {
			return true;
		} else {
			return false;
		}
	}

	public function compaPass($password, $password2) {
		if ($password == $password2) {
			return true;
		} else {
			return false;
		}
		}
	}



?>