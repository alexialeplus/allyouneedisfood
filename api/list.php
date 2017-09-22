<?php

class Search {

	protected $pdo;

	public function __construct() {
		try {
			$pdo = new PDO('mysql:host=localhost; dbname=nutriproject', 'root', '');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

		$this->pdo = $pdo;

		if (isset($_GET['q']) && $_GET['q'] !== NULL) {
			$this->search($_GET['q']);
		}

		return $this->pdo;	
	}

	public function search($request) {
		if (isset($request) && is_string($request)) {
			
		}
	}
}
?>