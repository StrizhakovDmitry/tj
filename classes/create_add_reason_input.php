<?php// require_once '../autoload.php';?>
<?php
class create_add_reason_input 
	{
	static $string='';
	static $project_num = 1;
	function add_input($ajax_project_num)
		{
		if (isset($ajax_project_num))
			{
			
			self::$project_num=($ajax_project_num);
			}
		else
			{
			if ($_COOKIE["sel_proj_value"])
				{
				self::$project_num=$_COOKIE["sel_proj_value"];
				}
				else
				{
				self::$project_num = 1;
				}
			}
		self::$project_num=(self::$project_num)*1;
		$sql = connect_bd::connect();
		$query="SELECT id,description FROM `reason` WHERE project_id=".self::$project_num." ORDER BY priority";
		$result=$sql->query($query);
		$i=0;
		self::$string.='<select name="reason" id="select_reasons">'.'\r\n';
		while ($row = $result->fetch_assoc())
			{
			self::$string.='<option value='.$row["id"].'>'.$row["description"].'</option>'.'\r\n';
			}
			return self::$string;
		}
	}

?>