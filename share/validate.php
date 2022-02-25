<?php

	class Validate {
		private $data;
		public $valid = false;
		public $message = NULL;


		function email ($value) {
			return [
				"status" => filter_var($value, FILTER_VALIDATE_EMAIL)
			];
		}

		function simple ($value) {
			return [
				"status" => preg_match("/^.{5,30}$/", $value)
			];
		}

		function number ($value) {
			if (!($value >= 5 && $value <= 30))
	            return [
	                "status" => false,
	                "message" => "number out of range"
	            ];

	        if (!is_numeric($value))
	        	return [
	        		"status" => false,
	        		"message" => "value isn't number"
	        	];

	        return [
	        	"status" => true
	        ];
		}

		function username ($value) {
			return [
				"status" => preg_match("/^(?=.{5,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $value)
			];
		}

		function password ($value) {
			if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,30}$/", $value))
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
			switch ($key) {
				case "email":
					return $this->email($val);

				case "number":
				case "age":
					return $this->number($val);

				case "username":
					return $this->username($val);

				case "password":
					return $this->password($val);

				case "retry-password":
					return $this->retryPassword($val);

				default:
					return $this->simple($val);
			}
		}

		function __construct ($data) {
			$this->data = $data;

			foreach ($data as $key => $val) {
				if (!$val) {
					$this->valid = false;
					$this->message = "$key is empty";
					break;
				}

				$valid = $this->check($key, $val);

				$this->valid = $valid["status"];
				$this->message = $valid["message"]?? "data isn't valid";

				if (!$this->valid)
					break;
			}
		}
	}

?>