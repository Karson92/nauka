<?php

session_start();

include 'classes/User.php';


if (isset($_POST['changePassword']))
{
	if(empty($_POST['password']) || empty($_POST['newPassword']) || empty($_POST['newPasswordRepeat']))
	{
		echo 'Musisz wpisać wszystkie 3 pozycje';
	}
	else
	{
		$array = array($_POST['password'], $_POST['newPassword'], $_POST['newPasswordRepeat']);

		include 'classes/CleanForm.php';	

		$validation = new CleanForm();

		for($i=0; $i<3; $i++)
		{
			$user[$i] = $validation->Validation($array[$i]);
		}

		$employee = new User();

		try
		{
			$operator = $employee->changePassword($_SESSION['login'], $user[0], $user[1], $user[2]);

			echo 'Pomyslnie zmieniono hasło';
		}
		catch(Exception $e)
		{
			echo 'treść komunikatu: ' . $e->getMessage() . '<br>';
			echo 'kod błędu:' . $e->getCode() . '<br>';
		}

	}
}

if (isset($_POST['delete']))
{
	$employee = new User();

		try
		{
			$operator = $employee->delete($_SESSION['login']);

			echo 'Pomyslnie usunięto użytkownika';
		}
		catch(Exception $e)
		{
			echo 'treść komunikatu: ' . $e->getMessage() . '<br>';
			echo 'kod błędu:' . $e->getCode() . '<br>';
		}
}





?>