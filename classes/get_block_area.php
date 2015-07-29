<?php //require_once '../autoload.php';?>
<?php
class get_block_area //возращает список блокировок с меню
	{
	static private $num_project;
	static public function get()
		{
		$string.='<form id="search_form" action="javascript:void(null);">';
		$string.= '<table id="notes_table">';
		$string.='<thead>';
		
		$string.='<tr>';
		
		$string.='<th id="search_form_moderator">Модератор</th>';
		$string.='<th id="search_form_login">Логин</th>';
		$string.='<th id="search_form_telnum">Телефон</th>';
		$string.='<th id="search_form_project">Проект</th>';
		$string.='<th id="search_reason">Причина</th>';
		$string.='<th id="search_form_comment">Комментарий</th>';
		$string.='<th id="data_search_form">Дата</th>';
		$string.='<th id="id_search_form">id</th>';
		$string.='<th id="search_form_button"><input id="search_submit" type="submit" value=" " rowspan="2"></th>';
		
		$string.=self::get_search_form();
		$string.='</tr>';
		$string.='</thead>';
		$string.='<tbody id="notes_body">';
		$string.=self::get_block_list();
		$string.='</tbody>';
		$string.= '</table>';
		$string.='</form>';
		return $string;
		}
	static public function get_block_list($where='')//возращает список блокировок без меню
		{
		$sql = connect_bd::connect();
		$query="SELECT `u`.name as moderator, user_login, user_telnum, `p`.name as project, description as reason, commentary, data_time as date, `n`.id FROM `notes` n JOIN `projects` p ON `n`.`project_id`=`p`.`id` JOIN `reason` ON `n`.`reason_id`=`reason`.`id` JOIN `users` u ON `n`.`moderator_id`=`u`.`id` $where ORDER BY `n`.id DESC LIMIT 11";
		$result=$sql->query($query);
		while ($row = $result->fetch_assoc())
			{
			if ($row['user_telnum']=='0')
				{
				$row['user_telnum']='-';
				}
			$block_list_array[]=$row;
			}
		$sql->close();
		$block_array_long=count($block_list_array);
		for ($i=0;$i<$block_array_long;$i++)
			{
			$string.='<tr>';
			$string.='<td>'.$block_list_array[$i]['moderator'].'</td>';
			$string.='<td>'.$block_list_array[$i]['user_login'].'</td>';
			$string.='<td>'.$block_list_array[$i]['user_telnum'].'</td>';
			$string.='<td>'.$block_list_array[$i]['project'].'</td>'."\r\n";
			$string.='<td>'.$block_list_array[$i]['reason'].'</td>'."\r\n";
			$string.='<td id="comm_id_'.$block_list_array[$i]['id'].'" class="block_list_comment">'.$block_list_array[$i]['commentary'].'</td>'."\r\n";
			$string.='<td>'.$block_list_array[$i]['date'].'</td>'."\r\n";
			$string.='<td>'.$block_list_array[$i]['id'].'</td>'."\r\n";
			$string.='<td>'.'<img string_id="'.$block_list_array[$i]['id'].'" src="img/delete.png" class="del_button"/>'.'</td>'."\r\n";
			$string.='</tr>';
			}
		return $string;
		}
	static public function get_search_form() //создает форму поиска
			{
			
			$string.='<tr>';
			
			$string.='<th>'.self::select_moderator().'</th>';
			
			$string.='<th>'.self::input_blocked_user_login().'</th>';
			$string.='<th>'.self::input_blocked_user_telnum().'</th>';
			$string.='<th>'.self::select_project().'</th>';
			$string.='<th id="search_form_reason_select"></th>';//select_reason($num)
			$string.='<th>'.self::input_blocked_commentary().'</th>';
			$string.='<th>'.self::select_blocked_date().'</th>';
			$string.='<th>'.self::input_blocked_id().'</th>';
			$string.='<th></th>';
			
			$string.='</tr>';
			//return $query;
			return $string;
			
			}
	static private function select_moderator()//добавляет в форму поиска выбор модератора
			{
			$sql = connect_bd::connect();
			$query="SELECT id,name FROM `users`";
			$result=$sql->query($query);
			//$string.='<select name="moderator_id"><option>-</option>';
			$string.='<select name="moderator_id"><option value="-">-</option>';
			while ($row = $result->fetch_assoc())
				{
				//$string.='<option>'.$row['name'].'</option>';
				$string.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			$string.='</select>';
			return $string;
			$sql->close();
			}
	static private function select_project()//добавляет в форму поиска выбор проекта
			{
			$sql = connect_bd::connect();
			$query="SELECT id,name FROM `projects`";
			$result=$sql->query($query);
			$string.='<select name="project_id" id="search_form_project_select"><option value=""></option>';
			$trigger=false;
			while ($row = $result->fetch_assoc())
				{
				if ($trigger) 
					{
					self::$num_project = $row['id']*1;
					}
				$string.='<option value="'.$row['id'].'">'.$row['name'].'</option>';
				$trigger=true;
				}
			$string.='</select>';
			return $string;
			$sql->close();
			}
	static public function select_reason($num)//добавляет в форму поиска выбор причины блокировки
			{
			$sql = connect_bd::connect();
			$query="SELECT id,description as name FROM `reason` WHERE project_id=$num ORDER BY `priority`";
			$result=$sql->query($query);
			$string.='<select id="search_form_select_reason" name="reason_id"><option class="search_form_select_reason_option" value=""></option>';
			while ($row = $result->fetch_assoc())
				{
				$string.='<option class="search_form_select_reason_option" value="'.$row['id'].'">'.$row['name'].'</option>';
				}
			$string.='</select>';
			return $string;
			$sql->close();
			}
	static public function input_blocked_user_login()
		{
		$string='<input name="user_login"></input>';
		return $string;
		}
	static public function input_blocked_user_telnum()
		{
		return('<input name="user_telnum" id="search_telnum" pattern="[0-9]{10}"></input>');
		}
	static public function input_blocked_commentary()
		{
		return('<input name="commentary" id="search_form_comment"></input>');
		}
	static public function select_blocked_date()
		{
		return('от <input id="search_start_datetime" name="start_date" type="text" value="dd-mm-yy" onfocus="this.select();lcs(this)"
    onclick="event.cancelBubble=true;this.select();lcs(this)"><br>до <input id="search_end_datetime" name="end_date" type="text" value="dd-mm-yy" onfocus="this.select();lcs(this)"
    onclick="event.cancelBubble=true;this.select();lcs(this)">');
		}
	static public function input_blocked_id()
		{
		return('<input name="note_id" id="search_form_id"></input>');
		}
	}
//echo get_block_area::get_block_list();
		
?>