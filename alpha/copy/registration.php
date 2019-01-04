<?php

header('Content-type: text/html; charset=utf-8');

if (isset($_POST['submit'])) {

$name = trim($_POST['imie']);
$surname = trim($_POST['nazwisko']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password2 = trim($_POST['password2']);


if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($password2))
{
	echo 'Weź podaj wszytkie dane, jo?';
}
else
{



function getLogin($name, $surname)
{
	$name = ucwords($name);
	$name = substr($name, 0, 1);
	$surname = ucwords($surname);
	$sum = $name . $surname;

	return $sum;
}


$login = getLogin($name, $surname);
	
include 'classes/User.php';

	$user = new User();
	$operator = $user->registration($login, $email, $password, $password2, $name, $surname);

echo '<br>';


			switch($operator)
			{
				case 1:
					echo 'Jest git!!';
					break;
				case 2:
					echo 'Niepoprawny adres email';
					break;
				case 3:
					echo 'Wprowadzone hasła nie są identyczne';
					break;
				case 4:
					echo 'Hasło musi mieć conajmniej 6 znaków';
					break;
				case 5:
					echo 'Błąd połączenia z bazą danych';
					break;
				case 6:
					echo 'Taki użytkownik już istnieje';
					break;
				case 7:
					echo 'Ktos juz ma taki email';
					break;
				case 8:
					echo 'Login musi składać z conajmniej 4 znaków';
					break;

			}

		}

}



?>