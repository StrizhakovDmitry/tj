<?php
class deactivate_note
	{
	public static function get_note_id($note_id)
		{
		$sql = connect_bd::connect();
		$query="DELETE FROM `notes` WHERE id=$note_id";
		$sql->query($query);
		
		
		
		}
	
	
	
	}





?>