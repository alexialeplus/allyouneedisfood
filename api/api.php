<?php

//header('Content-Type: application/json');

if (isset($_GET['q']) && is_string($_GET['q'])) {
	require('list.php');

	$search = new Search();
	$result = $search->search($_GET['q']);
	echo json_encode($result);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	require('show.php');

	$product = new Product();
	//$product->echodump();
}

?>