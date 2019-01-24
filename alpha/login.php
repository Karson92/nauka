<?php

session_start();

if (isset($_POST['submit']))
{
	if(empty($_POST['login']) || empty($_POST['password']))
	{
		echo 'Musisz podać login oraz hasło aby się zalogować';
	}
	else
	{
		$array = array($_POST['login'], $_POST['password']);

		include 'classes/CleanForm.php';	
		include 'classes/User.php';

		$validation = new CleanForm();

		for($i=0; $i<2; $i++)
		{
			$user[$i] = $validation->Validation($array[$i]);
		}

		$employee = new User();

		try
		{
			$operator = $employee->login($user[0], $user[1]);
			$_SESSION['idu'] = $operator;
			$_SESSION['login'] = $user[0];

			echo 'Pomyslnie zalogowano użytkownika o loginie: ' .$user[0]. ' oraz id: ' .$operator;
		}
		catch(Exception $e)
		{
			echo 'treść komunikatu: ' . $e->getMessage() . '<br>';
			echo 'kod błędu:' . $e->getCode() . '<br>';
		}

	}
}




?>