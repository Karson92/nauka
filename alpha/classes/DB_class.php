<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'karol92');
define('DB_NAME','nauka');

class DB_class {

	public $dbo = null;

	function __construct() 
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
		 //return $dbo;
	}

	/*public function query()
    {
    	global $dbo;
    	return $this->dbo->query();
    }
     */
}

$test = new DB_class();
var_dump($test);


?>