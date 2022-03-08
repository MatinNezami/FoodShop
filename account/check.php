<?php

	require_once "../share/component.php";
	require_once "../share/validate.php";

	$connection = connection();

	if (!$connection)
		return "{\"status\": 500, \"message\": \"database isn't connect\"}";

	function profiles () {
		$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

		$query->execute() or
			die("{\"status\": 500, \"message\": \"query isn't execute\"}");

		die("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	}


	function existsUser ($username, $email) {
		$checkUsername = $GLOBALS["connection"]->prepare("SELECT `username` FROM `users` WHERE `username` = ?");
		$checkUsername->bindValue(1, $username);

		$checkEmail = $GLOBALS["connection"]->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
		$checkEmail->bindValue(1, $email);

		$checkEmail->execute() && $checkUsername->execute() or
			die("{\"status\": 500, \"message\": \"query isn't execute\"}");

		if ($checkUsername->rowCount())
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		if ($checkEmail->rowCount())
			die("{\"status\": 500, \"message\": \"this email is accepted\"}");
	}

	function register ($data) {
		unset($data["profile"]);

		$check = new Validate($data, ["first-name", 5, 30, false]);

		if (!$check->valid)
			die("{\"status\": 500, \"message\": \"" . str_replace("-", " ", $check->message) . "\"}");

		existsUser($data["username"], $data["email"]);

		die("{\"status\": 200, \"message\": \"signup success\"}");
	}


	if (isset($_GET["profiles"]))
		die(profiles());

	if (isset($_POST["type"]))
		switch ($_POST["type"]) {
			case "register":
				register($_POST);
		}

?>