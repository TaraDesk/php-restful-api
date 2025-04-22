<?php

class QuizController {
	public function __construct(private $gateway, private $validator) {}

	public function handleRequest() {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$this->handleGetRequest();
				break;
			case 'POST':
				$this->handlePostRequest();
				break;
			case 'PUT':
        		$this->handlePutRequest();
				break;
			case 'DELETE':
        		$this->handleDeleteRequest();
				break;
			default:
				http_response_code(405);
				header("Allow: GET, POST, PUT, DELETE");
	            echo json_encode([
	                "error" => true,
	                "message" => "Invalid Request",
	            ]);
				break;
		}
    }

    private function handleGetRequest() {
    	$request = $this->checkUrlRequest();

    	if (ctype_digit($request)) {
    		$id = (int)$request;
    		$category = null;
    	} else {
    		$id = null;
    		$category = $request;
    	}

    	if($id && !$category) {
    		$result = $this->gateway->find($id);
    	} else if ($category && !$id) {
    		$result = $this->gateway->getAll($category);
    	} else {
    		$result = $this->gateway->getAll("All");
    	}

    	if(array_key_exists('error', $result)) {
    		http_response_code(404);
    		echo json_encode([
		        "status" => 404,
		        "error" => $result["error"]
		    ]);
    		return;
    	}

    	$response = $result["questions"];
    	$options = $result["options"];

		$groupedOptions = [];
		foreach ($options as $opt) {
		    $groupedOptions[$opt['question_id']][] = $opt['option_text'];
		}

		$optionIds = [];
		foreach ($options as $opt) {
		    $optionIds[$opt['question_id']][] = $opt['id'];
		}

		$correctOptions = [];
		foreach ($options as $opt) {
			if($opt['is_correct']) {
				$correctOptions[$opt['question_id']] = $opt['option_text']; 
			}
		}

    	foreach ($response as &$questions) {
    		$qid = $questions['id'];

    		$questions['option_ids'] = $optionIds[$qid];
    		$questions['options'] = $groupedOptions[$qid];
    		$questions['correct_opt'] = $correctOptions[$qid];
    	}

    	http_response_code(200);
    	echo json_encode([
		    "status" => 200,
		    "data" => $response
		]);
    }

    private function handlePostRequest() {
    	$request = $this->checkUrlRequest();
    	$data = json_decode(file_get_contents("php://input"), true) ?? null;

    	$status = $this->validateAll($data, $request, $_SERVER['REQUEST_METHOD']);

    	if(!$status) {
		    return;
    	}

		if (!$request) {
	        $result = $this->gateway->create($data);
	        http_response_code(201);
	        echo json_encode($result);
		} else if ($request === "token") {
		    http_response_code(201);
		    echo json_encode([
		        "message" => "Token has been verified",
		        "status"  => "Approved"
		    ]);
		} else {
		    http_response_code(400);
		    echo json_encode(["message" => "Invalid Request"]);
		}
    }

    private function handlePutRequest() {
        $request = $this->checkUrlRequest();
    	$data = json_decode(file_get_contents("php://input"), true) ?? null;

    	if (!ctype_digit($request)) {
    		http_response_code(400);
		    echo json_encode(["message" => "Invalid Request"]);
    		return;
    	}

    	$status = $this->validateAll($data, $request, $_SERVER['REQUEST_METHOD']);

    	if(!$status) {
		    return;
    	}

    	$result = $this->gateway->find($request);
    	if(array_key_exists('error', $result)) {
    		http_response_code(404);
    		echo json_encode([
		        "status" => 404,
		        "error" => $result["error"]
		    ]);
    		return;
    	}

    	$question = $result['questions'];
    	$updateResult = $this->gateway->update($question[0]['id'], $data, $result);

		http_response_code(201);
    	echo json_encode($updateResult);
    }

    private function handleDeleteRequest() {
        $request = $this->checkUrlRequest();
    	$data = json_decode(file_get_contents("php://input"), true) ?? null;

    	if (!ctype_digit($request)) {
    		http_response_code(400);
		    echo json_encode(["message" => "Invalid Request"]);
    		return;
    	}

    	$status = $this->validateAll($data, $request, $_SERVER['REQUEST_METHOD']);

    	if(!$status) {
		    return;
    	}

    	$findResult = $this->gateway->find($request);
    	if(array_key_exists('error', $findResult)) {
    		http_response_code(404);
    		echo json_encode([
		        "status" => 404,
		        "error" => $findResult["error"]
		    ]);
    		return;
    	}

    	$question = $findResult['questions'];
    	$result = $this->gateway->delete($question[0]['id']);

        http_response_code(201);
        echo json_encode($result);
    }

    // Utils Method
	private function checkUrlRequest() {
		$cleanUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$parts = explode("/", $cleanUri);

		$request = trim($parts[1]);
		return $request ?? null;
	}

	private function validateAll($data, $request, $method) {
		$isValid = $this->validator->validate($data, $request, $method);

    	if(!$isValid['status']) {
    		http_response_code(400);
    		echo json_encode([
		    	"status" => "Denied",
		    	"message" => $isValid['message'],
		    ]);
		    return false;
    	}

    	return true;
	}
}

?>

