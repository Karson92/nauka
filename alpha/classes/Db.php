<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'karol92');
define('DB_NAME', 'nauka');

class Db
{
	public $Db = null;

	public function DbConn()
	{
		try 
		{
			$this->Db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
			echo 'połaczenie nawiązano';
		 
		}
		catch(PDOException $e)
		{
			throw new PDOException($e->getMessage());
		} 
		 
	}

	    public function query()
        {
        return $this->Db->query();
        }
}



?>