<?php

	require_once "../share/component.php";
	// require_once "../share/validate.php";

	$connection = connection();

	if (!$connection)
		die("{\"status\": 500, \"message\": \"database isn't connect\"}");

	function profiles () {
		$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

		if (!$query->execute())
			die("{\"status\": 500, \"message\": \"query isn't execute\"}");

		die("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	}


	function register ($data) {
		// USE PROFILE AND CUSTOM VALIDATE;
		// var_dump($data);

		unset($data["profile"]);

		$check = new Validate($data);

		if (!$check->valid)
			die("\"status\": 500, \"message\": \"" . $check->message . "\"");

		echo "check true";
	}


	if (isset($_GET["profiles"]))
		profiles();

	if (isset($_POST["type"]))
		switch ($_POST["type"]) {
			case "register":
				register($_POST);
		}

?>