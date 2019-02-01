<?php

class Database
{
	private static $dbHost = "localhost";
	private static $dbName = "burger_code";
	private static $dbUser = "Laura";
	private static $dbPassword = "Laura0710*";
	
	private static $connexion = null;
	
	public static function connect()
	{
		try {
			self::$connexion = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPassword, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		}
		catch (PDOException $exception){
			die($exception->getMessage());
		}
		return self::$connexion;
	}
	
	public static function disconnect()
	{
		self::$connexion = null;
	}

}
