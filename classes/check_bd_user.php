<?php
class check_bd_user
	{
	public function chek_user($user,$pass)
		{
		$sql = connect_bd::connect();
		$query='select COUNT(0) from `users` WHERE `name`="'.$user.'" AND `password`="'.$pass.'"';
		$result = $sql->query($query);
		$exist[] = $result->fetch_assoc();
		$exist = $exist[0]["COUNT(0)"]*1;
		$exist>0?$exist=true:$exist=false;
		$sql->close();
		return $exist;
		}
	}









?>