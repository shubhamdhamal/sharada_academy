<?php
	echo admin_view('header');
	echo admin_view($module_name.'/'.$page_name.'.php');
	echo admin_view('footer');
?>