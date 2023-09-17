<?php

	define('CONFIG_PATH', 'config.json');
	$config = getConfig(CONFIG_PATH);

	function getConfig($path) {
		$content = json_decode(file_get_contents($path));
		return $content;// => RETURN OBJECT TYPE
	}

	function file_info($file) {
		return pathinfo($file);
	}

	function get_file_size($file) {
		return substr(filesize($file)/1024, 0, 4);
	}

	
	function get_folder_path($folder, $default){
		return empty($_GET[$folder]) ? $default : $_GET[$folder];
	}

?>