<?php require_once '../autoload.php';?>
<?php
function test_notes()
	{
	$block_list_array[0]['user_login']='fraud@e1.ru';
	$block_list_array[0]['user_telnum']='9666666666';
	$block_list_array[0]['project']='Недвижимость';
	$block_list_array[0]['reason']='Превышение лимита';
	$block_list_array[0]['commentary']='Дубли кабинетов tratata@e1.ru, assasa@e1.ru и ещё много всякой ерунды он сделал, как его, гада земля только носит !!!';
	$block_list_array[0]['date']='2015-04-20 12:48:53';
	$block_list_array[0]['id']='3';
		$block_list_array[1]['user_login']='assa@e1.ru';
	$block_list_array[1]['user_telnum']='9666644666';
	$block_list_array[1]['project']='Авто';
	$block_list_array[1]['reason']='Дубли объявления';
	$block_list_array[1]['commentary']='Дубли объявлений 689934, 703434 он нечего не понимает';
	$block_list_array[1]['date']='2015-04-20 22:48:53';
	$block_list_array[1]['id']='4';
	return $block_list_array;
	}
//echo get_block_list::get(block_tmp_list::get_tmp_block_list());
//echo get_block_list::get();
echo get_block_area::get();
//echo get_block_list::get(test_notes());
?>