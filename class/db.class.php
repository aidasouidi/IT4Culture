<?php
use PDOException;

class db{

	protected $connection;
	public $isConnected = false;
	private $errors = true;

	function __construct($db_host, $db_username, $db_password, $db_database){
		try{
			// Create DB connection
			$this->connection = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_database, $db_username, $db_password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			$this->isConnected = true;
		}
		catch(PDOException $e){
			$this->isConnected = false;
		}
	}

	public function close(){
		$this->isConnected = false;
		$this->connection = null;
	}

	public function fetch($query, $parameters = array()){
		if($this->isConnected === true){
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $query->fetch();
			}
			catch(PDOException $e){
				throw new PDOException($e->getMessage());
			}
		}else{
			return false;
		}
	}

	public function fetchAll($query, $parameters = array()){
		if($this->isConnected === true){
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
				return $query->fetchAll();
			}
			catch(PDOException $e){
				throw new PDOException($e->getMessage());
			}
		}else{
			return false;
		}
	}

	
	public function runQuery($query, $parameters = array()){
		if($this->isConnected === true){
			try{
				$query = $this->connection->prepare($query);
				$query->execute($parameters);
			}
			catch(PDOException $e){
				throw new PDOException($e->getMessage());
			}
		}else{
			return false;
		}
	}

	public function tableExists($table){
		if($this->isConnected === true){
			// Try a select statement against the table
			try {
				$result = $this->connection->query("SELECT 1 FROM $table LIMIT 1");
			} catch (PDOException $e) {
				// We got an exception (table not found)
				return false;
			}

			// Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
			return $result !== false;
		}else{
			return false;
		}
	}

	public function dump($file) {
		if($this->isConnected === true){
			try{
				if (! preg_match_all("/('(\\\\.|.)*?'|[^;])+/s", file_get_contents($file), $m)) {
					return;
				}
				
				foreach ($m[0] as $sql) {
					if (strlen(trim($sql))) {
						$query = $this->connection->prepare($sql);
						$query->execute();
					}
				}
				
				return true;
			} catch(PDOException $e){
				throw new PDOException($e->getMessage());
			}
		}
	}
}