<?php
    namespace Joeybab3\Database;
	use PDO;
	
    class Wrapper {	 
	    
	    //Database wrapper
		private $dbhost = "localhost";
		private $dbport = "";
		private $dbuser;
		private $dbpass;
		private $dbname;
		private $dbh;
		public $db = false;
		public $set = false;
		private $version = "Database - v0.1";
		private $debug = false;
	   
	    public function __construct($username, $password, $dbname)
	    {
			$this->dbuser = $username;
			$this->dbpass = $password;
			$this->dbname = $dbname;
	    }
		
		public function setDebug($debug = true)
		{
			$this->debug = $debug;	
		}
		
		public function getConnection()
		{
			return $this->dbh;	
		}
		
		public function setConnection($conn)
		{
			$this->dbh = $conn;	
		}
		
		public function init($source=null)
		{
			try
			{
	      		$this->dbh = new PDO("mysql:dbname={$this->dbname};host={$this->dbhost};port={$this->dbport}", $this->dbuser, $this->dbpass);
				$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	     		$this->db = true;
			}
			catch(PDOException $e) {
				$this->error = $e;
	      		return false;
	    	}
		}
		
		public function getVersion()
		{
			return $this->version;
		}
		
		public function getDatabaseName()
		{
			return $this->dbname;	
		}
		
		public function query($query)
		{
			return $this->dbh->query($query);
		}
		
		public function prepare($query)
		{
			return $this->dbh->prepare($query);
		}
		
		public function tableExists($table) {
			try 
			{
				$result = $this->dbh->query("SELECT 1 FROM $table LIMIT 1");
			}
			catch (\PDOException $e) 
			{
				return false;
			}
			
			return $result !== true;
		}
    }
?>