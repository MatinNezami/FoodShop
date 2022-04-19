<?php

	require_once "../share/component.php";
	require_once "../share/validate.php";

	$notExec = "{\"status\": 500, \"message\": \"query isn't execute\"}";
	$lastTime = fn() => time() + (86400 * 3);
		
	function profiles () {
        $query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

        $query->execute() or
            die($GLOBALS["notExec"]);

        die("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
    }

	function existsUser ($username, $email) {
		$check = $GLOBALS["connection"]->prepare("SELECT `email`, `username` FROM `users` WHERE `email` = :email OR `username` = :username");
		$check->bindValue(":email", $email);
		$check->bindValue(":username", $username);

		$check->execute() or
			die($GLOBALS["notExec"]);

		if (!$check->rowCount()) return;
			
		$data = $check->fetch(PDO::FETCH_ASSOC);

		if (strtolower($data["username"]) == strtolower($username))
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		if ($data["email"] === $email)
			die("{\"status\": 500, \"message\": \"this email is accepted\"}");
	}

	function oppertunity ($email) {
		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `oppertunity` = ? WHERE `email` = ?");
		$update->bindValue(1, $GLOBALS["lastTime"]());
		$update->bindValue(2, $email);

		$update->execute() or
			die($GLOBALS["notExec"]);
	}

	function mailUrl ($url, $email) {
		# CONFIG SENDMAIL FOR SEND URL TO CLIENT EMAIL
	}

	function checkValidate () {
		$profile = NULL;

		if (isset($_POST["profile"])) {
			$profile = $_POST["profile"];
			$_POST["profile"] = substr($_POST["profile"], strpos($_POST["profile"], ";") + 1);
		}

		$check = new \Validation\Validate($_POST, [
			"first-name min=4 check=text",
			"username check=username same-password=password required",
			"password check=password required",
			"retype-password retype=password required",
			"profile check=base64 mime=image max=10M required",
			"email check=email required"
		]);

		if (!$check->ok)
			die("{\"status\": 500, \"message\": \"" . $check->message . "\"}");

		$_POST["profile"] = $profile;
	}

	function generateToken () {
		$token = time();

		for ($i = 0; $i < 9; $i++)
			$token .= chr(rand(65, 90));

		return $token;
	}

	function insert ($data) {
		unset($data["retry-password"], $data["type"]);

		$query = "INSERT INTO `users` (`username`, `email`, `password`, `firstName`, `profile`, `token`, `oppertunity`)VALUE (:username, :email, :password, :firstName, :profile, :token, :oppertunity)";
		$insert = $GLOBALS["connection"]->prepare($query);
		$token = generateToken();
		
		foreach ($data as $key => &$val)
			$insert->bindParam(":$key", $val);

		$insert->bindParam(":token", $token);
		$insert->bindParam(":oppertunity", $GLOBALS["lastTime"]());

		$insert->execute() or
			die($GLOBALS["notExec"]);

		mailUrl("localhost/accept?token=$token", $email);

		cookie($token);
	}

	// work on this function CREATE FAVORITE AND SAVE PRODUCTS
	function register () {
		checkValidate();
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


	function changeInfoQuery () {
		$query = "UPDATE `users` SET ";
		
		foreach ($_POST as $key => $val)
			$query .= "`$key` = :$key, ";
		
		return substr($query, 0, -2) . " WHERE `username` = :oldUsername";
	}

	function changeInfo () {
		global $info;

		if ($info["password"] != $_POST["password"])
			die("{\"status\": 500, \"message\": \"password didn't match\"}");

		if (isset($_POST["username"]) && existsUser($_POST["username"], ""))
			die("{\"status\": 500, \"message\": \"this username is exists\"}");

		checkValidate();
		unset($_POST["type"]);
		
		$change = $GLOBALS["connection"]->prepare(changeInfoQuery());
		
		foreach ($_POST as $key => &$val)
			$change->bindValue(":$key", $val);
		
		$change->bindValue(":oldUsername", $info["username"]);

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

		checkValidate();

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

		checkValidate();
		existsUser("", $_POST["email"]);

		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `email` = ?, `accept` = 0 WHERE `username` = ?");
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

		oppertunity($email);
	}

	function insertCode ($code, $username) {
		$update = $GLOBALS["connection"]->prepare("UPDATE `users` SET `acceptCode` = ? WHERE `username` = ?");
		$update->bindValue(1, $code);
		$update->bindValue(2, $username);

		$update->execute() or
			die($GLOBALS["notExec"]);
	}

	function resetPasswd () {
		checkValidate();

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
		if (!isset($_GET["type"])) return;

		switch ($_GET["type"]) {
			case "profiles":
				profiles();
	
			case "logout":
				logout();
		}
	})();
		

	(function () {
		if (!isset($_POST["type"])) return;

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