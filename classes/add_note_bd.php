<?php
class add_note_bd
	{
	function add_note ($note_array)
		{
		$sql = connect_bd::connect();
		//var_dump ($note_array);
		$query='INSERT INTO `merk46ru_tj`.`notes` (`id`, `moderator_id`, `project_id`, `reason_id`, `user_login`, `user_telnum`, `commentary`, `data_time`) VALUES (NULL, \''.$note_array['moderator_id'].'\', \''.$note_array['project_id'].'\', \''.$note_array['reason_id'].'\', \''.$note_array['user_login'].'\', \''.$note_array['user_telnum'].'\', \''.$note_array['commentary'].'\', \''.$note_array['date_time'].'\');';
		$sql->query($query);
		echo $query;
		}
	}






?>