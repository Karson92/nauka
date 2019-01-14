<?php


header('Content-type: text/html; charset=utf-8');

if (isset($_POST['submit'])) {

	if (empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2']))
	{
		echo 'Proszę podać wszystkie dane';
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

	try
	{
		$operator = $employee->registration($login, $user[0], $user[1], $user[2], $user[3], $user[4]);
	}
	catch(Exception $e)
	{
		echo 'treść komunikatu: ' . $e->getMessage() . '<br>';
		echo 'kod błędu:' . $e->getCode() . '<br>';
	}

	}

}



?>