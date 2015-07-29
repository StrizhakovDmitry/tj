<?php require_once '../autoload.php';?>
<? session_start();?>
<?php
$sql = connect_bd::connect();

$query='SELECT `id` FROM `users` WHERE name=\''.$_SESSION['user'].'\'';
$result=$sql->query($query);
$exist = $result->fetch_assoc();
$_SESSION['user_id']=$exist["id"];
//var_dump ($_GET);
//echo $_SESSION['user_id'];
$sql->close();
function create_array_note()
	{
	$note_array['moderator_id']=$_SESSION['user_id']*1;
	$note_array['project_id']=($_GET['project'])*1;
	$note_array['reason_id']=($_GET['reason'])*1;
	$note_array['user_login']=$_GET['user'];
	$note_array['user_telnum']=$_GET['telnum']*1;
	$note_array['commentary']=$_GET['comment'];
	$note_array['date_time']=date("Y-m-d H:i:s");
	add_note_bd::add_note($note_array);
	//echo 1;
	//return $note_array;
	}
create_array_note();
//var_dump (create_array_note());


?>