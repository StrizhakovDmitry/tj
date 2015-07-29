<?
class get_to_sql_where//пробразудет GET запрос к ajax/block_list в WHERE строку для get_block_area::get_block_list, возращает его ajax/block_list
	{
	public static $trigger=false;
	public static $where='WHERE ';
	public static $where_arr;
	
	
	
	public function get_to_query($get)
		{

		
		if ($get['moderator_id']!='-')
			{
			$trigger=true;
			self::$where_arr[]='`u`.id='.$get['moderator_id'];
			}
		if ($get['user_login']!='')
			{
			$trigger=true;
			self::$where_arr[]='user_login LIKE "%'.$get['user_login'].'%"';
			}
		if ($get['user_telnum']!='')
			{
			$trigger=true;
			self::$where_arr[]='user_telnum="'.$get['user_telnum'].'"';
			}
		if ($get['project_id']!='')
			{
			$trigger=true;
			self::$where_arr[]='`p`.id='.$get['project_id']; 
			}
		if ($get['reason_id']!='')
			{
			$trigger=true;
			self::$where_arr[]='`reason`.id='.$get['reason_id']; 
			}
		if ($get['start_date']!='dd-mm-yy')
			{
			$trigger=true;
			$sqldate = date("Y-m-d", strtotime($get['start_date']));
			self::$where_arr[]='`data_time` > "'.$sqldate.'"'; 
			}
		if ($get['end_date']!='dd-mm-yy')
			{
			$trigger=true;
			$sqldate = date("Y-m-d", strtotime($get['end_date']));
			self::$where_arr[]='`data_time` < "'.$sqldate.'"'; 
			}
		if ($get['note_id']!='')
			{
			$trigger=true;
			self::$where_arr[]='`n`.id="'.$get['note_id'].'"'; 
			}
		if ($get['commentary']!='')
			{
			$trigger=true;
			self::$where_arr[]='`n`.commentary LIKE "%'.$get['commentary'].'%"'; 
			}
		
			
		self::$where.=implode(" AND ",self::$where_arr);
		if ($trigger==true)
			{
			return self::$where;
			}
			else
			{
			return '';		
			}
		}
		public function return_fullquery($get)
			{
			$where=self::get_to_query($get);
			$query="SELECT `u`.name as moderator, user_login, user_telnum, `p`.name as project, description as reason, commentary, data_time as date, `n`.id FROM `notes` n JOIN `projects` p ON `n`.`project_id`=`p`.`id` JOIN `reason` ON `n`.`reason_id`=`reason`.`id` JOIN `users` u ON `n`.`moderator_id`=`u`.`id` $where ORDER BY `n`.id DESC LIMIT 11";
			return $query;
			}
	
	}







?>