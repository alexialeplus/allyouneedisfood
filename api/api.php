<?php

header('Content-Type: application/json');

require('list.php');
$array = array();
$array['status'] = 'OK';
$json = json_encode($array);

if (isset($_GET['q']) && is_string($_GET['q'])) {
	$search = new Search();
	$result = $search->search($_GET['q']);
	echo json_encode($result);
}
elseif (isset($_GET['id'] && is_int($_GET['id']))) {
	
}

?>