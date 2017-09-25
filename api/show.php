<?php

require('list.php');

class Product extends Search {

	protected $_table = 'aliments';

	public function show($id) {
		if (isset($id) && is_numeric($id)) {

			$sql = self::$_pdo->prepare("SELECT * FROM " . $this->_table . " WHERE id = ?");
			$sql->execute(array($id));

			return $sql->fetch(PDO::FETCH_ASSOC);
		}
	} 
}
?>