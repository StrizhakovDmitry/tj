<?php require_once '../autoload.php';?>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
	{
	$note_id=$_POST['note_id']*1;
	deactivate_note:: get_note_id($note_id);
	}





?>