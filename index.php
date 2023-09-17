<?php

	require_once('helper.php');
	require_once('file_manager.php');


	$folder = get_folder_path('folder', '.');
	$path = $folder;

	$folders = FileManager::get_folders(realpath($path));
	$files = FileManager::get_files(realpath($path));

	$count_files = count($files);

	$storage_free = (disk_free_space($path)/disk_total_space($path))*100;

	if(isset($_GET['items'])) {
		$items = $_GET["items"];
		$path = $_GET["path"];
		$itemsArr = explode(',',$items);
		echo "OK req!";

		foreach($itemsArr as $item) {
			rename($item, realepath($path).basename($item));
			echo "OK!";
		}
	}


	// rename("C:/xampp/htdocs/File Manager/sample2.txt", "sample/".basename("C:/xampp/htdocs/File Manager/sample2.txt"));

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="assets/css/style.css">
		<title><?= $config->appname." V".$config->version?></title>
	</head>
	<body>
		<main>
			<section class="row row-1">
				<section class="col col-left">
					<h2>Folders</h2>
					<br/>
					<p class="path"><?= $path?></p>
					<div class="folders">
						<?php
							foreach($folders as $folder) {
								?>
								<a href="?folder=<?= $folder['path']?>" class="folder">
									<i class='bx bxs-folder'></i>
									<span><?= $folder['content']?></span>
								</a>
								<?php
							}

						?>
					</div>
				</section>
				<section class="col col-right">
					<div class="toolbar">
						<a class="btn rename" href="#">Rename</a>
						<a class="btn delete" href="#">Delete</a>
						<a class="btn delete-folder" href="#" data-path="<?php echo $path?>">Delete Folder</a>
						<a class="btn create-folder" href="#" data-path="<?php echo $path?>">Create Folder</a>
						<a class="btn cut" href="#">Cut</a>
						<a class="btn upload" href="upload_file.php?path=<?= $path?>" target="_blank">Upload</a>
					</div>
					<div class="files">
						<?php
							foreach($files as $file) {
								$file_info = file_info($file['name']);

								$icon = "bx bxs-file";
								?>

								<div class="file" data-path="<?= $file['path']?>">
									<i class="<?= $icon?>"></i>
									<span><?= $file['name']?></span>
									<span><?= get_file_size($file['path'])?> Kb</span>
								</div>
								<?php
							}
						?>
					</div>
					<div class="status">
						<div class="storage">
							<i class="bx bxs-hdd"></i>
							<div class="space">
								<span>Free Space: <?= substr(diskfreespace($path)/1073741824, 0, 5)?>Gb</span>
								<div class="bar" style="width: <?=$storage_free?>%"></div>
							</div>
						</div>
						<div class="count">
							<div class="count-files">
								<span>Files: <?= $count_files?></span>
							</div>
						</div>
					</div>
				</section>
			</section>
		</main>
		<script src="./assets/js/script.js"></script>
	</body>
</html>