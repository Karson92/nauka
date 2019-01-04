<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'karol92');
define('DB_NAME', 'nauka');

class User
{

	public function __construct()
	{
		try 
		{
			$this->dbo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
			echo 'połaczenie nawiązano';
		 
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		} 
		 
	}
	public function getLogin($name, $surname)
	{
		$name = ucwords($name);
		$name = substr($name, 0, 1);
		$surname = ucwords($surname);
		$sum = $name . $surname;

		return $sum;
	}

	public function registration($login, $name, $surname, $password, $password2, $email)
	{
		$regEx = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';

		if(mb_strlen($login, 'UTF-8') < 4) { throw new Exception("Wygenerowany Login jest za któtki, sprawdź złotko czy jest dobrze wpisane nazwisko :)", 101); }
		if(!preg_match($regEx, $email)) { throw new Exception("Ten email jest z dupy, wpisz poprawny", 102); }
		if($password !== $password2) { throw new Exception("Hasła nie sa takie same", 103); }
		if(mb_strlen($password, 'UTF-8') < 6) { throw new Exception("hasła są za krótkie", 104); }
		
		if(!$this->dbo) { throw new Exception("Brłąd podczas połączenia z bazą danych", 105); }  

		$query = $this->dbo->query("SELECT login, email FROM users WHERE login='$login' OR email='$email'");
		$data = $query->fetch();
		$query->closeCursor();

		if($login == $data['login']) { throw new Exception("Ktoś taki już istnieje!!", 106); }
		if($email == $data['email']) { throw new Exception("taki email już ktoś posiada", 107); }

		$this->dbo->exec("INSERT INTO users VALUES (0, '$login', '$password', '$name', '$surname', '$email')");
		
		return true;
	}

	public function login($login, $password)
	{




	}

	public function logout($login)
	{


	}

	public function changePass($login, $password, $passwordNew, $passwordNewRepeat)
	{

		
	}

	public function delete($login)
	{


	}
	


}





?>