<?php

class Search {

	protected $pdo;
	protected $table = "aliments";

	public function __construct() {
		try {
			$pdo = new PDO('mysql:host=localhost; dbname=nutriproject', 'root', '');
			$pdo->exec("SET NAMES 'UTF8'");
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

		$this->pdo = $pdo;
	}			

	public function search($request) {
		if (isset($request) && is_string($request) && ctype_alpha($request)) {
			$request = '%' . $request . '%';

			$sql = $this->pdo->prepare("SELECT id, ORIGGPFR, ORIGFDNM FROM `aliments` WHERE ORIGGPFR LIKE ? OR ORIGFDNM LIKE ? ");
			$sql->execute(array($request, $request));

			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}
	}
}

?>