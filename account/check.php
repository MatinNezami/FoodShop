<?php

	require_once "../share/component.php";
	require_once "../share/validate.php";

	$connection = connection();
	$notExec = "{\"status\": 500, \"message\": \"query isn't execute\"}";

	if (!$connection)
		return "{\"status\": 500, \"message\": \"database isn't connect\"}";

	function profiles () {
		$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

		$query->execute() or
			die($GLOBALS["notExec"]);

		die("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	}


	function existsUser ($username, $email) {
		$check = $GLOBALS["connection"]->prepare("SELECT `email`, `username` FROM `users` WHERE `email` = :email OR `username` = :username");
		$check->bindParam(":email", $email);
		$check->bindParam(":username", $username);

		$check->execute() or
			die($GLOBALS["notExec"]);

		$data = $check->fetch(PDO::FETCH_ASSOC);

		if ($data["username"] == $username)
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		if ($data["email"] == $email)
			die("{\"status\": 500, \"message\": \"this email is accepted\"}");
	}

	function insert ($data) {
		$query = "INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `profile`)VALUE (:username, :email, :password, :firstName, :profile)";
		$insert = $GLOBALS["connection"]->prepare($query);
		
		foreach ($data as $key => &$val)
			$insert->bindParam(":$key", $val);
		
		$insert->execute() or
			die($GLOBALS["notExec"]);
	}

	function register ($data) {
		$profile = $data["profile"];
		unset($data["profile"]);

		$check = new Validate($data, ["firstName", 5, 30, false]);

		if (!$check->valid)
			die("{\"status\": 500, \"message\": \"" . str_replace("-", " ", $check->message) . "\"}");

		existsUser($data["username"], $data["email"]);

		$data["profile"] = $profile;
		unset($data["retry-password"]);
		unset($data["type"]);
		insert($data);

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