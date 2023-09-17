<?php

	if(isset($_POST['upload'])) {
		$path = $_GET['path'];
		$file = $_FILES['upload_file'];

		$newFile = $file["tmp_name"];
		$file_name = $file["name"];

		move_uploaded_file($newFile, $path."/".$file["name"]);

		if(isset($_POST['watermark']) && $file['type'] == "image/jpeg" || $file['type'] == "image/png") {
			//Get Image ID

			$image;

			switch ($file['type']) {
				case 'image/jpeg':
					$image = imagecreatefromjpeg( $path."/".$file["name"]);
					break;
				case 'image/png':
					$image = imagecreatefrompng( $path."/".$file["name"]);
					break;
			}

			$watermarkImage = imagecreatefromjpeg('assets/pics/watermark.jpg');

			//Watermarking
			imagecopymerge($image, $watermarkImage, 0, 0, 0,  0, imagesx($watermarkImage), imagesy($watermarkImage), 60);

			//Add Image in Folder
			imagepng($image, $path.'/'.$file_name);

		}
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/upload.css">
		<title></title>
	</head>
	<body>
		<main>
			<section class="row">
				<form action="" method="post" enctype="multipart/form-data">
					<label class="upload-box" for="upload-file">Upload File</label>
					<input hidden type="file" name="upload_file" id="upload-file">

					<div>
						<label for="watermark">Watermarking Image</label>
						<input type="checkbox" name="watermark" id="watermark">
					</div>
					<button name="upload">Uploading!</button>
				</form>
			</section>
		</main>
	</body>
</html>