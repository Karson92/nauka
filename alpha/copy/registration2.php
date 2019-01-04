<?php

header('Content-type: text/html; charset=utf-8');

if (isset($_POST['submit'])) {

	if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2']))
	{
		echo 'Weź podaj wszytkie dane, jo?';
	}
	else
	{

		$array = array($_POST['imie'], $_POST['nazwisko'], $_POST['password'], $_POST['password2'], $_POST['email']);


include 'classes/CleanForm.php';	
include 'classes/User.php';

	$validation = new CleanForm();

	for($i=0; $i <5; $i++)
	{
		$user[$i] = $validation->Validation($array[$i]);
	}



	$employee = new User();
	$login = $employee->getLogin($user[0], $user[1]);
	$operator = $employee->registration($login, $user[0], $user[1], $user[2], $user[3], $user[4]);

//print_r($cleanForm);



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