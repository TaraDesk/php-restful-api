<?php

class Validator {
	public $status = true;
	public $message = "";

	public function __construct(private $gateway) {}

	public function validate($data, $request, $method) {
		$this->hasValidToken($data);

		if(!$this->status) {
			return [
				'status' =>	$this->status,
				'message' => $this->message
			];
		}

		$this->validateToken($data['token']);
		if(!$this->status) {
			return [
				'status' =>	$this->status,
				'message' => $this->message
			];
		}

		if (
		    $method !== "DELETE" &&
		    !($method === "POST" && $request === "token")
		) {
		    $this->validateInputData($data);

		    if (!$this->status) {
		        return [
		            'status' => $this->status,
		            'message' => $this->message
		        ];
		    }
		}

		return [
			'status' =>	$this->status,
			'message' => $this->message
		];
	}

	private function hasValidToken($data) {
    	if (!isset($data['token']) || empty(trim($data['token']))) {
    		$this->message = "Please provide access token!";
            $this->status = false;
    	}
    }

    private function validateToken($token) {
    	$authStatus = $this->gateway->validateToken($token);

    	if(!$authStatus['auth_status']) {
		    $this->message = $authStatus['message'];
            $this->status = false;
    	}
    }

    private function validateInputData($data) {
	    $requiredFields = ['question', 'category', 'options', 'correct_opt'];
	    $missingFields = [];

	    if (empty($data)) {
	        $this->message = "No input data provided.";
	        $this->status = false;
	    } else {
	        foreach ($requiredFields as $field) {
	            if (
				    !isset($data[$field]) || 
				    (is_string($data[$field]) && trim($data[$field]) === '') || 
				    (is_array($data[$field]) && empty($data[$field]))
				) {
				    $missingFields[] = $field;
				}
	        }

	        if (!empty($missingFields)) {
	            $this->message = "Missing required fields: " . implode(", ", $missingFields);
		        $this->status = false;
	        } else {
	        	$missing = array_diff($data['correct_opt'], $data['options']);

	        	if (!empty($missing)) {
					$this->message = "Please include all correct options to the options list.";
			        $this->status = false;
				} 
	        }
	    }
	}
}

?>