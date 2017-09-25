<?php

class Search {

	protected static $_pdo;
	protected $_table = "aliments";

	public function __construct() {
		try {
			self::$_pdo = new PDO('mysql:host=localhost; dbname=nutriproject', 'root', '');
			self::$_pdo->exec("SET NAMES 'UTF8'");
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}			

	public function search($request) {
		if (isset($request) && is_string($request)) {
			$request = '%' . $request . '%';

			$sql = self::$_pdo->prepare("SELECT id, ORIGGPFR, ORIGFDNM FROM ". $this->_table . " WHERE UPPER(ORIGGPFR) LIKE UPPER(?) OR UPPER(ORIGFDNM) LIKE UPPER(?) ");
			$sql->execute(array($request, $request));

			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}
	}
}

?>