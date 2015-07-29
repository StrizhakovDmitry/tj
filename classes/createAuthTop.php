<?php
class createAuthTop 
	{
	public function __construct()
		{
		if ($_SESSION['user'])
			{
			$user_login=$_SESSION['user'];
			$text_button="выход"; 
			echo '<div class="auth_block">'."\r\n";
			echo '<ul class="auth_elements_list">'."\r\n";
			echo '<li>'.'<div class="user_login">'.'Ваш логин: '.$user_login.'</div>'.'</li>'."\r\n";
			echo '<li>'.'<div class="button_log"><button id="logoff_button">'.$text_button.'</button></div>'.'</li>'."\r\n";
			echo '</ul>'."\r\n";
			echo'</div>'."\r\n";
			}
		else 
			{
			$text_button="войти"; 
			echo '<div class="auth_block">'."\r\n";
			echo '<ul class="auth_elements_list">'."\r\n";
			echo '<li>'.'<div class="user_login">'.'<input id="login" placeholder="логин"></input>'.'</div>'.'</li>'."\r\n";
			echo '<li>'.'<div class="user_login">'.'<input type="password" id="password" placeholder="пароль"></input>'.'</div>'.'</li>'."\r\n";
			echo '<li>'.'<div class="button_log" ><button id="auth_button">'.$text_button.'</button></div>'.'</li>'."\r\n";
			echo '</ul>'."\r\n";
			echo'</div>'."\r\n";
			}
		}
	}
?>