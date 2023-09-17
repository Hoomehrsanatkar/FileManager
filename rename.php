<?php

	$items = $_GET['items'];
	$name = $_GET['name'];

	$itemsArr = explode(',', $items);

	foreach($itemsArr as $item) {
		$path = pathinfo($item);
		rename($item, $path['dirname'].'/'.$name);
	}

	echo $path['dirname'].$name;
	echo $items[0];
?>