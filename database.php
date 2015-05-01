<?php
	class Database{
	
		private static $dbName = 'buoy';
		private static $dbHost = 'localhost';
		private static $dbUsername = 'root';
		private static $dbPassword = '';
		
		private static $cont = null;
		
		public function __construct(){
			die('Init function not allowed. Use connect instead');
		}
		
		public static function connect(){
			if(null == self::$cont){
			
				try {
					self::$cont = new PDO(
						"mysql:host=".self::$dbHost.";"."dbname=".self::$dbName.";",
						self::$dbUsername,
						self::$dbPassword);
				}
				catch (PDOException $e){
					die($e->getMessage());
				}
			}
			
			return self::$cont;	
		}
		
		public static function disconnect() {
			self::$cont = null;
		}
	}
?>