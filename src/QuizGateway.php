<?php

class QuizGateway {

	private $conn;

	public function __construct($database) {
		$this->conn = $database->getConnection();
	}

	private function getAllQuestions($category = null) {
	    if ($category) {
	        $query = "SELECT * FROM questions WHERE category = :category";
	        $stmt = $this->conn->prepare($query);
	        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
	    } else {
	        $query = "SELECT * FROM questions";
	        $stmt = $this->conn->prepare($query);
	    }

	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private function getOptionsByQuestionsId($ids) {
	    $placeholders = implode(',', array_fill(0, count($ids), '?'));

	    $query = "SELECT * FROM options WHERE question_id IN ($placeholders)";
	    $stmt = $this->conn->prepare($query);

	    foreach ($ids as $index => $id) {
	        $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
	    }

	    $stmt->execute();
	    return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAll($category) {
		if($category === "All") {
			$questions = $this->getAllQuestions();
		} else {
			$questions = $this->getAllQuestions($category);
		}

		$questionIds = array_column($questions, "id");
		$options = $this->getOptionsByQuestionsId($questionIds);

	    return [
	        'questions' => $questions,
	        'options' => $options
	    ];
	}

	public function find($id) {
		$query = "SELECT * FROM questions WHERE id = :id LIMIT 1";
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();
	    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

	    if (!count($questions)) {
		    return ['error' => 'Question not found'];
		}
		
		$id = array_column($questions, "id");
	    $options = $this->getOptionsByQuestionsId($id);

		return [
			'questions' => $questions,
			'options' => $options
		];
	}

	public function create($data) {
		$query = "INSERT INTO questions (question, category) VALUES (:question, :category)";
		$stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':question', $data['question'], PDO::PARAM_STR);
	    $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);

	    $stmt->execute();
	    $id = $this->conn->lastInsertId();

	    $options = [];

	    foreach ($data['options'] as $option) {
	    	$option = trim($option);
	    	$options[] = [
		        'option_text' => $option,
		        'is_correct' => in_array($option, $data['correct_opt'], true) ? 1 : 0
		    ];
	    }

	    $this->createOption($options, $id);

	    return [
	    	'message' => 'Question has been added',
	    	'status' => 'Success'
	    ];
	}

	private function createOption($data, $lastId) {
		$query = "INSERT INTO options (question_id, option_text, is_correct) VALUES (:question_id, :option_text, :is_correct)";
		$stmt = $this->conn->prepare($query);

	    foreach ($data as $item) {
	        $isActive = filter_var($item['is_correct'], FILTER_VALIDATE_BOOLEAN);

	        $stmt->bindParam(':question_id', $lastId, PDO::PARAM_INT);
	        $stmt->bindParam(':option_text', $item['option_text'], PDO::PARAM_STR);
	        $stmt->bindParam(':is_correct', $isActive, PDO::PARAM_BOOL);

	        $stmt->execute();
	    }
	}

	public function update($id, $data, $currentData) {
		$query = "UPDATE questions SET question = :question, category = :category WHERE id = :id";
		$stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':question', $data['question'], PDO::PARAM_STR);
	    $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();

	    $oldOptions = $currentData['options'];
	    $newOptions = [];

	    foreach ($data['options'] as $option) {
	    	$option = trim($option);
	    	$newOptions[] = [
		        'option_text' => $option,
		        'is_correct' => in_array($option, $data['correct_opt'], true) ? 1 : 0
		    ];
	    }

	    $diffOption = count($newOptions) - count($oldOptions);

	    if($diffOption < 0) {
	    	$this->deleteOptions($id, abs($diffOption));
	    } else if($diffOption > 0) {
	    	$newInsertedOptions = [];
			for ($i = 0; $i < $diffOption; $i++) {
			    $newInsertedOptions[] = array_pop($newOptions);
			}

			$this->createOption($newInsertedOptions, $id);
	    } 

	    $ids = array_column($oldOptions, "id");
	    $this->updateOptions($ids, $id, $newOptions);

    	return [
	    	'message' => 'Question has been edited',
	    	'status' => 'Success'
	    ];
	}

	private function updateOptions($ids, $questionId, $data) {
		$query = "UPDATE options SET option_text = :option_text, is_correct = :is_correct WHERE id = :id AND question_id = :question_id";
		$stmt = $this->conn->prepare($query);

		foreach ($data as $index => $item) {
	        $isActive = filter_var($item['is_correct'], FILTER_VALIDATE_BOOLEAN);

	        $stmt->bindParam(':question_id', $questionId, PDO::PARAM_INT);
	        $stmt->bindParam(':id', $ids[$index], PDO::PARAM_INT);
	        $stmt->bindParam(':option_text', $item['option_text'], PDO::PARAM_STR);
	        $stmt->bindParam(':is_correct', $isActive, PDO::PARAM_BOOL);

	        $stmt->execute();
	    }
	}

	private function deleteOptions($questionId, $deleteNumber) {
	    $deleteNumber = (int) $deleteNumber;

	    $query = "DELETE FROM options WHERE id IN (
	        SELECT id FROM (
	            SELECT id
	            FROM options
	            WHERE question_id = :question_id
	            ORDER BY id DESC
	            LIMIT $deleteNumber
	        ) AS sub
	    )";

	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':question_id', $questionId, PDO::PARAM_INT);
	    $stmt->execute();
	}

	public function delete($id) {
		$query = "DELETE FROM questions WHERE id = :id";
		$stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();

	    return [
	        'message' => 'Question has been deleted',
	        'status' => 'Success'
	    ];
	}

	public function validateToken($token) {
		$query = "SELECT * FROM tokens WHERE token = :token LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':token', $token, PDO::PARAM_STR);
		$stmt->execute();

		$tokenData = $stmt->fetch(PDO::FETCH_ASSOC);

		if($tokenData) {
			$expiresAt = new DateTime($tokenData['expires_at']);
			$now = new DateTime("now");

			if ($expiresAt > $now) {
				return ['auth_status' => true, 'message' => 'Token has been verified'];
			} else {
				return ['auth_status' => false, 'message' => 'Token access has expired'];
			}
		} else {
		    return ['auth_status' => false, 'message' => 'Token not found'];
		}	
	}
}
?>