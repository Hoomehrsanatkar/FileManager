<?php

	$folder_name = $_GET['name'];
	$path = $_GET['path'];

	mkdir($path."/$folder_name");

?>