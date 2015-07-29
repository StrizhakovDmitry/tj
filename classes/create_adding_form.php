<?php //require_once '../autoload.php';?>
<? //new header();?>
<?// session_start();?>
<?
if (!$_SESSION['user']) {exit;}



class create_adding_form
	{
	static function create_form()
		{
		echo '<div class="create_block">'."\r\n";
		echo '<form id="add_form" action="javascript:void(null);">';
		echo '<table>'."\r\n";
		echo '<tbody>'."\r\n";
		echo '<tr>'."\r\n";
		echo '<td>'.'Раздел'.'</td>'."\r\n";
		echo '<td>'.'Логин'.'</td>'."\r\n";
		echo '<td>'.'Телефон (9...)'.'</td>'."\r\n";
		echo '<td id="add_form_reason">'.'Причина'.'</td>'."\r\n";
		echo '<td>'.'Комментарий'.'</td>'."\r\n";
		echo '<td>'.''.'</td>'."\r\n";
		echo '</tr>'."\r\n";
///////////////////////////
		echo '<tr>'."\r\n";
		echo '<td>'.create_select_projects::add_input().'</td>'."\r\n";
		echo '<td>'.create_add_user_login_input::add_input().'</td>'."\r\n";
		echo '<td>'.create_add_telnum_input::add_input().'</td>'."\r\n";
		echo '<td>'.create_add_reason_input::add_input().'</td>'."\r\n";
		echo '<td>'.create_add_commentary_input::add_input().'</td>'."\r\n";
		echo '<td>'.'<input type="submit" value="Добавить запись"></input>'.'</td>'."\r\n"; 
		echo '</tr>'."\r\n";
		echo '</tbody>'."\r\n";
		echo '</table>'."\r\n";
		echo '</form>';
		echo '</div>'."\r\n";
		
		}
		
	

	
	
	
	}
//create_adding_form::create_form()
?>