<?php

	require_once "../share/component.php";

	$connection = connection();

	if (!$connection)
		die("{\"status\": 500, \"message\": \"database isn't connect\"}");

	function profiles () {
		$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

		if (!$query->execute())
			die("{\"status\": 500, \"message\": \"query isn't execute\"}");

		die("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	}


	if (isset($_GET["profiles"]))
		profiles();

?>