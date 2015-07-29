<?php
class update_notes
{
public static function comment ($id,$text)
	{
	$id=$id*1;
	$text = trim(strip_tags($text));
	$sql = connect_bd::connect();
	$query="UPDATE `notes` SET `commentary`=\"$text\" WHERE `id`=$id";
	$sql->query($query);
	$sql->close();
	}


















}

























?>