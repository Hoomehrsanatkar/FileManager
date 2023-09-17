<?php
	$items = $_GET['items'];
	$itemsArr = explode(",",$items);

	foreach($itemsArr as $item) {
		unlink($item);
	}

?>