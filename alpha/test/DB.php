<?php


class DB
{
	private $server = 'localhost';
	private $user = 'root';
	private $password = 'karol92';
	private $dbName = 'nauka';
	private $conn = null;
	private $query = null;
	public $execute = null;

		public function __construct()
		{
			try
			{
				$this->conn = new PDO('mysql:host=localhost;dbname=nauka', 'root', 'karol92');
				echo 'połaczenie nawiązano';

			}
			catch(PDOException $e)
			{
				throw new PDOException($e->getMessage());
			}
		}

		public function query($query)
		{
			return $this->query;
		}
		public function execute($execute)
		{
			return $this->execute;
		}

}

$DB = new DB();

class User
{
	private $DB = null;

	public function __construct(DB $DB)
	{
		$this->DB = $DB;
	}

	public function register($test1, $test2)
	{
		$this->DB->execute("INSERT INTO test(test1, test2) VALUES ('$test1', '$test2')");
	}


}

$user = new User($DB);
$user->register('karol', 'kulik');

?>