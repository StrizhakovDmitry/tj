<?php
class auth //проверяет наличие пользователя в базе, запускает сессию, если он есть
	{
	public static function check_reg($log,$pass)
		{
		if (check_bd_user::chek_user($log,$pass))
			{
			session_start();
			$_SESSION['user'] = $log;
			return true;
			}
		else 
			{
			return false;
			}
		}
	public function login()//принимает данные, отправляет данные классу chek_reg
		{
		if (($_SERVER["REQUEST_METHOD"]=="GET") and ($_GET['login'])and($_GET['password']))
			{
			if (!self::check_reg($_GET['login'],$_GET['password']))
				{
				return "неверные логин/пароль";
				}
			}
		else
			{
			return "не заполнены поля";
			}
		}

	}
?>