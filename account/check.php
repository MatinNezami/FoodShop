<?php

	require_once "../share/component.php";
	require_once "../share/validate.php";

	$connection = connection();

	if (!$connection)
		return "{\"status\": 500, \"message\": \"database isn't connect\"}";

	function profiles () {
		$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

		if (!$query->execute())
			return "{\"status\": 500, \"message\": \"query isn't execute\"}";

		return ("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	}


	function register ($data) {
		unset($data["profile"]);

		$check = new Validate($data, ["first-name", 5, 30, false]);

		if (!$check->valid)
			return "{\"status\": 500, \"message\": \"" . str_replace("-", " ", $check->message) . "\"}";

		// insert to the db

		return "{\"status\": 200, \"message\": \"signup success\"}";
	}


	if (isset($_GET["profiles"]))
		die(profiles());

	if (isset($_POST["type"]))
		switch ($_POST["type"]) {
			case "register":
				die(register($_POST));
		}

?>