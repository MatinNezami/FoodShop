<?php
	
	class Validate {
		private $data;
		public $patterns = [];
		public $valid = false;
		public $message = NULL;


		function required ($key, $value) {
			if (!isset($this->patterns[$key]))
				return true;

			return $this->patterns[$key][2]? $value: NULL;
		}

		function email ($value) {
			return [
				"status" => filter_var($value, FILTER_VALIDATE_EMAIL)
			];
		}

		function simple ($key, $value) {
			$min = in_array($key, $this->patterns)? $this->patterns[$key][0]: 5;
			$max = in_array($key, $this->patterns)? $this->patterns[$key][1]: 30;

			return [
				"status" => preg_match("/^.{" . $min . "," . $max . "}$/", $value)
			];
		}

		function number ($key, $value) {
			$exists = isset($this->patterns[$key]);

			$min = $exists? $this->patterns[$key][0]: 5;
			$max = $exists? $this->patterns[$key][1]: 30;

			if (!($value >= $min && $value <= $max))
	            return [
	                "status" => false,
	                "message" => "$key out of range"
	            ];

	        if (!is_numeric($value))
	        	return [
	        		"status" => false,
	        		"message" => "$key isn't number"
	        	];

	        return [
	        	"status" => true
	        ];
		}

		function username ($key, $value) {
			$min = in_array($key, $this->patterns)? $this->patterns[$key][0]: 5;
			$max = in_array($key, $this->patterns)? $this->patterns[$key][1]: 30;

			return [
				"status" => preg_match("/^(?=.{" . $min . "," . $max . "}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $value)
			];
		}

		function password ($key, $value) {
			$min = in_array($key, $this->patterns)? $this->patterns[$key][0]: 8;
			$max = in_array($key, $this->patterns)? $this->patterns[$key][1]: 30;

			if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{" . $min . "," . $max . "}$/", $value))
				return [
					"status" => false,
					"message" => "password is not strong"
				];

			foreach (str_split(strtolower($value), 3) as $i)
				if (str_contains(strtolower($this->data["username"]), $i))
					return [
						"status" => false,
						"message" => "password is same with username"
					];

			return [
				"status" => true
			];
		}

		function retryPassword ($val) {
			return [
				"status" => $this->data["password"] == $val,
				"message" => "conferm password"
			];
		}

		function check ($key, $val) {
			$required = $this->required($key, $val);

			if ($required === NULL && !$val)
				return [
					"status" => true
				];

			if (!$required && !$val)
				return [
					"status" => false,
					"message" => "$key is required"
				];

			switch ($key) {
				case "email":
					return $this->email($val);

				case "number":
				case "age":
				case "price":
					return $this->number($key, $val);

				case "username":
					return $this->username($key, $val);

				case "password":
				case "old-password":
					return $this->password($key, $val);

				case "retry-password":
					return $this->retryPassword($val);

				default:
					return $this->simple($key, $val);
			}
		}

		function pattern ($patterns) {
			foreach ($patterns as $pattern)
				$this->patterns[$pattern[0]] = [$pattern[1], $pattern[2], $pattern[3]];
		}

		function __construct ($data, ...$patterns) {
			$this->data = $data;
			$this->pattern($patterns);

			foreach ($data as $key => $val) {
				$valid = $this->check($key, $val);

				$this->valid = $valid["status"];
				$this->message = $valid["message"]?? "$key isn't valid";

				if (!$this->valid)
					break;
			}
		}
	}

?>
