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

		if(mb_strlen($login, 'UTF-8') < 4) { throw new Exception("Wygenerowany Login jest za któtki, sprawdź czy jest dobrze wpisane nazwisko :)", 101); }
		if(!preg_match($regEx, $email)) { throw new Exception("Ten email jest z zły, wpisz poprawny", 102); }
		if($password !== $password2) { throw new Exception("Hasła nie sa takie same", 103); }
		if(mb_strlen($password, 'UTF-8') < 6) { throw new Exception("Hasła są za krótkie", 104); }
		
		if(!$this->dbo) { throw new Exception("Błąd podczas połączenia z bazą danych", 105); }  

			$sql = "SELECT login, email FROM users WHERE login=:login OR email=:email";

				$stmt = $this->dbo->prepare($sql);
				$stmt->bindValue(':login', $login);
				$stmt->bindValue(':email', $email);
				$stmt->execute();
				$data = $stmt->fetch();
				$stmt->closeCursor();

					if($login == $data['login']) { throw new Exception("Ktoś taki już istnieje!!", 106); }
					if($email == $data['email']) { throw new Exception("Taki email już ktoś posiada", 107); }

			$sql = "INSERT INTO users VALUES (0, :login, :password, :name, :surname, :email)";
			$salt = '4543k098hg34jb5k344b542b3bk35j6h568j8908kjb09b7b894b6';
			$crypt = hash_hmac('sha256', $password, $salt);

				$stmt = $this->dbo->prepare($sql);
				$stmt->bindValue(':login', $login);
				$stmt->bindParam(':password', $crypt);
				$stmt->bindValue(':name', $name);
				$stmt->bindValue(':surname', $surname);
				$stmt->bindValue(':email', $email);
				$stmt->execute();
		
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