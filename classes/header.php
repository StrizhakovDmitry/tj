<?php
class header 
	{
	public function __construct()
		{
		echo "<!DOCTYPE HTML>\r\n";
		echo '<link rel="stylesheet" type="text/css" href="/tj/css.css"></link>'."\r\n";
		echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>'."\r\n";
		echo '<script src="/tj/scripts.js"></script>'."\r\n";
		//echo '<link href="/tj/bootstrap_3.0.2/dist/css/bootstrap.min.css" rel="stylesheet">';
		//echo'<script src="/tj/bootstrap_3.0.2/dist/js/bootstrap.min.js"></script>';
		}
	}
?>