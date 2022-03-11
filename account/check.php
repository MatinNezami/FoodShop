<?php

	require_once "../share/component.php";
	require_once "../share/validate.php";

	$notExec = "{\"status\": 500, \"message\": \"query isn't execute\"}";
		
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

	function mailUrl ($url) {
		# CONFIG SENDMAIL FOR SEND URL TO CLIENT EMAIL
	}

	function token () {
		$token = time();

		for ($i = 0; $i < 9; $i++)
			$token .= chr(rand(65, 90));

		return $token;
	}

	function insert ($data) {
		$query = "INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `profile`, `token`)VALUE (:username, :email, :password, :firstName, :profile, :token)";
		$insert = $GLOBALS["connection"]->prepare($query);
		$token = token();
		
		foreach ($data as $key => &$val)
			$insert->bindParam(":$key", $val);

		$insert->bindParam(":token", $token);

		$insert->execute() or
			die($GLOBALS["notExec"]);

		mailUrl("localhost/accept?token=$token");
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

		die("{\"status\": 200, \"message\": \"check your email\"}");
	}


	function cookie ($token) {
		if (!setcookie("token", $token, time() + (86400 * 300), "/"))
			die("{\"status\": 500, \"message\": \"can't set cookie\"}");
	}

	function accepted ($token) {
		$accepted = $GLOBALS["connection"]->prepare("UPDATE `users` SET `accept` = 1 WHERE `token` = ?");
		$accepted->bindValue(1, $token);

		$accepted->execute() or
			die($GLOBALS["notExec"]);
	}

	function accept () {
		$validate = new Validate($_POST);

		if (!$validate->valid)
			die("{\"status\": 500, \"message\": \"" . $validate->message . "\"}");

		$check = $GLOBALS["connection"]->prepare("SELECT `password` FROM `users` WHERE `token` = ?");
		$check->bindValue(1, $_POST["token"]);

		$check->execute() or
			die($GLOBALS["notExec"]);

		if ($_POST["password"] != $check->fetch(PDO::FETCH_ASSOC)["password"])
			die("{\"status\": 500, \"message\": \"your password didn't match\"}");

		cookie($_POST["token"]);
		accepted($_POST["token"]);

		die("{\"status\": 200, \"message\": \"your password did match\"}");
	}


	function logout () {
		if (setcookie("token", "", time() - 10, "/"))
			die("{\"status\": 200, \"message\": \"logout successly\"}");

		die("{\"status\": 500, \"message\": \"logout failed\"}");
	}


	if (isset($_GET["type"]))
		switch ($_GET["type"]) {
			case "profiles":
				profiles();

			case "logout":
				logout();
		}

	if (isset($_POST["type"]))
		switch ($_POST["type"]) {
			case "register":
				register($_POST);

			case "accept":
				accept();
		}

?>