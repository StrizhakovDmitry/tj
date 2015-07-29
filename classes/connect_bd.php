<?php
class connect_bd
	{
	public static $sql;
	public static function connect()
		{
		define("DB_HOST", "localhost");
		define("DB_LOGIN", "merk46ru_tj");
		define("DB_PASSWORD", "AAAqqq123");
		define("DB_NAME", "merk46ru_tj");
		self::$sql = new mysqli (DB_HOST,DB_LOGIN,DB_PASSWORD,DB_NAME);
		self::$sql->query("SET NAMES utf8");
		if (mysqli_connect_errno()){echo mysqli_connect_error();exit;};
		return self::$sql;
		}
	public static function close()
		{
		self::$sql->close();
		}
	}







?>