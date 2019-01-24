<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'karol92');
define('DB_NAME', 'nauka');

class User
{
	private $salt = '4543k098hg34jb5k344b542b3bk35j6h568j8908kjb09b7b894b6';
	private $sql_log = "SELECT idu, login, password FROM users WHERE login=:login";

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
	public function getLogin(string $name, string $surname)
	{
		$name = ucwords($name);
		$name = substr($name, 0, 1);
		$surname = ucwords($surname);
		$sum = $name . $surname;

		return $sum;
	}

	public function registration(string $login, string $name, string $surname, string $password, string $password2, string $email)
	{
		$regEx = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';

		if(mb_strlen($login, 'UTF-8') < 4) { throw new Exception("Wygenerowany Login jest za któtki, sprawdź czy jest dobrze wpisane nazwisko :)", 101); }
		if(!preg_match($regEx, $email)) { throw new Exception("Ten email jest zły, wpisz poprawny", 102); }
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
			$crypt = hash_hmac('sha256', $password, $this->salt);

				$stmt = $this->dbo->prepare($sql);
				$stmt->bindValue(':login', $login);
				$stmt->bindParam(':password', $crypt);
				$stmt->bindValue(':name', $name);
				$stmt->bindValue(':surname', $surname);
				$stmt->bindValue(':email', $email);
				$stmt->execute();
		
				return true;
	}

	public function login(string $login, string $password)
	{
		if(!$this->dbo) { throw new Exception("Błąd podczas połączenia z bazą danych", 121); }

				$stmt = $this->dbo->prepare($this->sql_log);
				$stmt->bindValue(':login', $login);
				$stmt->execute();
				$data = $stmt->fetch();
				$stmt->closeCursor();

					if($login !== $data['login']) { throw new Exception("Błędne dane logowania!!", 122); }
						
						$crypt = hash_hmac('sha256', $password, $this->salt);
						// sprawdzamy czy hasła są identyczne
						if(!hash_equals($crypt, $data['password'])) { throw new Exception("Błędne dane logowania!!", 122); }

							return $data['idu'];

	}

	public function changePassword(string $login, string $password, string $newPassword, string $newPasswordRepeat)
	{
		if(!$this->dbo) { throw new Exception("Błąd podczas połączenia z bazą danych", 131); }

			$stmt = $this->dbo->prepare($this->sql_log);
			$stmt->bindValue(':login', $login);
			$stmt->execute();
			$data = $stmt->fetch();
			$stmt->closeCursor();

				$crypt = hash_hmac('sha256', $password, $this->salt);
				// sprawdzamy czy hasła są identyczne
					if(!hash_equals($crypt, $data['password'])) { throw new Exception("Błędne obecne hasło!!", 132); }
					if($newPassword !== $newPasswordRepeat) { throw new Exception("Wprowadzone nowe hasła nie sa takie same", 133); }
					if(mb_strlen($newPassword, 'UTF-8') < 6) { throw new Exception("Wprowadzone nowe hasła są za krótkie", 134); }

						$sql = "UPDATE users SET password = :password";
						$crypt = hash_hmac('sha256', $newPassword, $this->salt);

							$stmt = $this->dbo->prepare($sql);
							$stmt->bindParam(':password', $crypt);
							$stmt->execute();

							return true;
		
	}

	public function delete(string $login)
	{
		if(!$this->dbo) { throw new Exception("Błąd podczas połączenia z bazą danych", 141); }

			$stmt = $this->dbo->prepare($this->sql_log);
			$stmt->bindValue(':login', $login);
			$stmt->execute();
			$data = $stmt->fetch();
			$stmt->closeCursor();

				if($login !== $data['login']) { throw new Exception("Nie ma takiego loginu!!", 142); }

					$sql = "DELETE FROM users WHERE login = :login";

						$stmt = $this->dbo->prepare($sql);
						$stmt->bindValue(':login', $login);
						$stmt->execute();

						return true;
	}	
}

?>