<?php
class create_select_projects
	{
	static  $string='';
	public function add_input()
		{
		 
		$sql = connect_bd::connect();
		$query="SELECT id, name from `projects` WHERE active=1 AND name!=\"-\"";
		$result=$sql->query($query);
		
		if ($_COOKIE["sel_proj_value"])
			{
			$sel_proj_value=$_COOKIE["sel_proj_value"];
			}
			else
			{
			$sel_proj_value = 2;
			}
		self::$string.= '<select name="project" id="select_projects">'."\r\n";
		while ($row = $result->fetch_assoc())
			{
			if ($row['id']==$sel_proj_value)
				{
				$ins='selected';
				}
				else
				{
				$ins='';
				}
			self::$string.='<option '.$ins.' value='.$row['id'].'>'.$row['name'].'</option>'."\r\n";
			}
		self::$string.= '</select>'."\r\n";
		$sql->close();
		return self::$string;
		}
	}
?>