<?php 
	
	class FileManager {


		// READ DIRECTORRY AND RETURN FOLDERS FROM ARRAY
		static function get_folders($path='.') {
			$content = [];

			$dir = opendir($path);
			while($item=readdir($dir)) {
				if(is_dir($path . '/' . $item)) {

					if($item == '.') continue;

					$content[] = ["content" => $item, "path" => $path.'/'.$item];
				}
			}

			return $content;
		}


		// READ DIRECTORY AND RETURN FILES FROM ARRAY
		static function get_files($path = '.') {
			$content = [];

			$dir = opendir($path);
			while($item = readdir($dir)) {
				if(is_file($path.'/'.$item)) {
					$content[] = ['path'=> $path.'/'.$item, 'name'=> $item];
				}
			}

			return $content;
		}




		static function delete_dir($dir_path) {
			$dir_scanned = glob($dir_path.'/*');

			foreach($dir_scanned as $item) {
				if(is_dir($item)) {
					delete_dir($item);
				} else {
					unlink($item);
				}
			}
			rmdir($dir_path);
		}
	}


	if(isset($_GET["delete-folder"])){
		FileManager::delete_dir(realpath($_GET["delete-folder"]));
	}
?>