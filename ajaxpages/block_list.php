<?php require_once '../autoload.php';?>
<?php
//echo get_block_area::get_block_list();
//new _vardump($_GET);
//echo (get_to_sql_where::get_to_query($_GET));

//echo (get_to_sql_where::return_fullquery($_GET));
echo get_block_area::get_block_list(get_to_sql_where::get_to_query($_GET));
//echo get_block_area::get_block_list((get_to_sql_where::return_fullquery($_GET)));

//new _vardump(get_to_sql_where::get_to_query($_GET));
?>