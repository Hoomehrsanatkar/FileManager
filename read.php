<?php

	header("content-type: text/plain");

	$content = file_get_contents($_GET['path']);

	echo "$content"


?>