<?php

	// require_once "../share/component.php";
	// require_once "../share/validate.php";

	// $connection = connection();

	// if (!$connection)
	// 	return "{\"status\": 500, \"message\": \"database isn't connect\"}";

	// function profiles () {
	// 	$query = $GLOBALS["connection"]->prepare("SELECT * FROM `profile`");

	// 	if (!$query->execute())
	// 		return "{\"status\": 500, \"message\": \"query isn't execute\"}";

	// 	return ("{\"status\": 200, \"data\": " . json_encode($query->fetchAll(PDO::FETCH_ASSOC)) . "}");
	// }


	// function register ($data) {
	// 	unset($data["profile"]);

	// 	$check = new Validate($data);

	// 	if (!$check->valid)
	// 		return "{\"status\": 500, \"message\": \"" . $check->message . "\"}";


	// 	return "{\"status\": 200, \"message\": \"signup success\"}";
	// }


	// if (isset($_GET["profiles"]))
	// 	die(profiles());

	// if (isset($_POST["type"]))
	// 	switch ($_POST["type"]) {
	// 		case "register":
				// die(register($_POST));


			// var_dump( preg_match("/^.{" . 5 . "," . 30 . "}$/", "matin"));
			

		// unset($_POST['profile']);

		// $j = [
		// 	"first-name" => "matin",
		// 	"email" => "matin@gmail.com",
		// 	"username" => "matinnez",
		// 	"password" => "Hello912@",
		// 	"retry-password" => "Hello912@"
		// ];

			// foreach($_POST as $p => $pval)
			// 	foreach ($j as $d => $dval) {
			// 		var_dump($p, $pval, $d, $dval);
			// 		var_dump($pval == $dval);
			// 	}
		// }









		


		// echo register($d);


		$res =        preg_match('/^[a-z]{1,10}$/', "hell"     , $matches);


		var_dump(count($matches), $res);


		// preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
		// print_r(count($matches));

		// var_dump(function_exists("preg_match_all"));

?>