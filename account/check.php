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

		if ($data["username"] === $username)
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		if ($data["email"] === $email)
			die("{\"status\": 500, \"message\": \"this email is accepted\"}");
	}

	function mailUrl ($url, $email) {
		# CONFIG SENDMAIL FOR SEND URL TO CLIENT EMAIL
	}

	function checkValidate ($data) {
		unset($data["profile"]);

		if (!$data)
			return null;

		$check = new Validate($data, ["firstName", 5, 30, false]);

		if (!$check->valid)
			die("{\"status\": 500, \"message\": \"" . str_replace("-", " ", $check->message) . "\"}");
	}

	function generateToken () {
		$token = time();

		for ($i = 0; $i < 9; $i++)
			$token .= chr(rand(65, 90));

		return $token;
	}

	function insert ($data) {
		unset($data["retry-password"], $data["type"]);

		$query = "INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `profile`, `token`)VALUE (:username, :email, :password, :firstName, :profile, :token)";
		$insert = $GLOBALS["connection"]->prepare($query);
		$token = generateToken();
		
		foreach ($data as $key => &$val)
			$insert->bindParam(":$key", $val);

		$insert->bindParam(":token", $token);

		$insert->execute() or
			die($GLOBALS["notExec"]);

		mailUrl("localhost/accept?token=$token", $email);

		cookie($token);
	}

	// work on this function CREATE FAVORITE AND SAVE PRODUCTS
	function register () {
		checkValidate($_POST);

		existsUser($_POST["username"], $_POST["email"]);
		insert($_POST);

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
		checkValidate($_POST);

		$check = $GLOBALS["connection"]->prepare("SELECT `password` FROM `users` WHERE `token` = ?");
		$check->bindValue(1, $_POST["token"]);

		$check->execute() or
			die($GLOBALS["notExec"]);

		if ($_POST["password"] != $check->fetch(PDO::FETCH_ASSOC)["password"])
			die("{\"status\": 500, \"message\": \"your password didn't match\"}");

		accepted($_POST["token"]);

		die("{\"status\": 200, \"message\": \"your password did match\"}");
	}


	function logout () {
		if (setcookie("token", "", time() - 10, "/"))
			die("{\"status\": 200, \"message\": \"logout successly\"}");

		die("{\"status\": 500, \"message\": \"logout failed\"}");
	}


	function login () {
		checkValidate($_POST);

		$info = $GLOBALS["connection"]->prepare("SELECT * FROM `users` WHERE `username` = ?");
		$info->bindValue(1, $_POST["username"]);

		$info->execute() or
			die($GLOBALS["notExec"]);

		if (!$info->rowCount())
			die("{\"status\": 500, \"message\": \"this username isn't exists\"}");

		$info = $info->fetch(PDO::FETCH_ASSOC);

		if ($_POST["password"] != $info["password"])
			die("{\"status\": 500, \"message\": \"password didn't match\"}");

		cookie($info["token"]);
		unset($info["accept"], $info["token"], $info["password"], $info["acceptCode"]);

		die("{\"status\": 200, \"message\": \"welcome, login successly\", \"info\": " . json_encode($info) ."}");
	}


	function changeInfo () {
		global $info;

		if ($info["password"] != $_POST["password"])
			die("{\"status\": 500, \"message\": \"password didn't match\"}");

		if (isset($_POST["username"]) && existsUser($_POST["username"], ""))
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		$_POST["username"] = $info["username"];
		unset($_POST["type"]);
		checkValidate($_POST);

		$query = "UPDATE `users` SET ";
		
		foreach ($_POST as $key => $val)
			$query .= "`$key` = :$key, ";
		
		
		$query = substr($query, 0, -2) . " WHERE `username` = :username";
		$change = $GLOBALS["connection"]->prepare($query);
		
		foreach ($_POST as $key => &$val)
			$change->bindValue(":$key", $val);
		
		$change->bindValue(":username", $info["username"]);

		$change->execute() or
			die($GLOBALS["notExec"]);

		die("{\"status\": 200, \"message\": \"successly change informations\"}");
	}


	function changePasswd () {
		global $info;

		if ($_POST["password"] == $_POST["old-password"])
			die("{\"status\": 500, \"message\": \"new password match with old password\"}");

		if ($info["password"] != $_POST["old-password"])
			die("{\"status\": 500, \"message\": \"old password didn't match\"}");

		$_POST["username"] = $info["username"];

		checkValidate($_POST);

		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ?");
		$update->bindValue(1, $_POST["password"]);
		$update->bindValue(2, $info["username"]);

		$update->execute() or
			die($GLOBALS["notExec"]);

		die("{\"status\": 200, \"message\": \"password successly changed\"}");
	}


	function changeEmail () {
		global $info;

		if ($_POST["password"] != $info["password"])
			die("{\"status\": 500, \"message\": \"password didn't match\"}");

		checkValidate($_POST);
		existsUser("", $_POST["email"]);

		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `email` = ? WHERE `username` = ?");
		$update->bindValue(1, $_POST["email"]);
		$update->bindValue(2, $info["username"]);

		$update->execute() or
			die($GLOBALS["notExec"]);

		die("{\"status\": 200, \"message\": \"check new email\"}");
	}


	function generateAcceptCode () {
		$code = "";

		for($i = 0; $i < 6; $i++)
			$code .= rand(0, 9);

		return $code;
	}

	function mailCode ($code, $email) {
		# CONFIG SENDMAIL FOR SEND URL TO CLIENT EMAIL
	}

	function insertCode ($code, $username) {
		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `acceptCode` = ? WHERE `username` = ?");
		$update->bindValue(1, $code);
		$update->bindValue(2, $username);

		$update->execute() or
			die($GLOBALS["notExec"]);
	}

	function resetPasswd () {
		checkValidate($_POST);

		$email = $GLOBALS["connection"]->prepare("SELECT `accept` FROM `users` WHERE `email` = ? AND `username` = ?");
		$email->bindValue(1, $_POST["email"]);
		$email->bindValue(2, $_POST["username"]);

		$email->execute() or
			die($GLOBALS["notExec"]);

		if (!$email->rowCount())
			die("{\"status\": 500, \"message\": \"this informations isn't exists\"}");

		if (!$email->fetch(PDO::FETCH_ASSOC)["accept"])
			die("{\"status\": 500, \"message\": \"please accept your email\"}");

		$code = generateAcceptCode();
		mailCode($code, $_POST["email"]);
		insertCode($code, $_POST["username"]);

		die("{\"status\": 200, \"message\": \"check your email\"}");
	}


	(function () {
		if (!isset($_GET["type"]))
			return NULL;

		switch ($_GET["type"]) {
			case "profiles":
				profiles();
	
			case "logout":
				logout();
		}
	})();
		

	(function () {
		if (!isset($_POST["type"]))
			return NULL;

		switch ($_POST["type"]) {
			case "register":
				register();

			case "accept":
				accept();

			case "login":
				login();

			case "change":
				changeInfo();

			case "change-password":
				changePasswd();

			case "change-email":
				changeEmail();

			case "reset-password":
				resetPasswd();
		}
	})();

?>