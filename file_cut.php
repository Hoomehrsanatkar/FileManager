<?php

	$items = $_GET["items"];
	$path = $_GET["path"];
	$itemsArr = explode(',',$items);

	foreach($itemsArr as $item) {

		$item_path = pathinfo($item);
		rename($item, $item_path['dirname'].'/'.$path.basename($item));
	}



?>