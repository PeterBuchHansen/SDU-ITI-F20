<?php
class Chat extends Database {
	
	public function loadChat1() {
		echo "hi " . $_POST['picid'];	
	}

	public function getAll() {
		try
		{
			$picid = Chat::filter('picid', FILTER_SANITIZE_NUMBER_INT);
			if (!$picid) {
				echo "Invalid picid";
			}
			$stmtString = "SELECT chatid, username, comment, timestamp FROM chat WHERE picid = :picid;";
			$stmt = $this->conn->prepare($stmtString);
			$stmt->bindParam(':picid', $picid);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // FETCH_NUM -> returnerer array indexeret i colonner angivet i tal.                                         // Andre return methoder er beskrevet her: https://www.php.net/manual/en/pdostatement.fetch.php
			$result = $stmt->fetchAll();
			return $result;
		}
		catch(PDOException $e)
		{
			return "Connection failed: $e->getMessage() \ncode: $e->getCode";
		}
	}

	public function post() {
		try
		{
			$comment = Chat::filter('comment');
			if (!empty(trim($comment))) {
				$picid = Chat::filter('picid', FILTER_SANITIZE_NUMBER_INT);
				if (!$picid && !$comment) {
					echo "Invalid picid or comment";
				}
				$stmtString = "INSERT INTO chat (username, picid, comment, timestamp) VALUES (:username, :picid, :comment, NOW());";
				$stmt = $this->conn->prepare($stmtString);
				$stmt->bindParam(':username', $_SESSION['username']);
				$stmt->bindParam(':picid', $picid);
				$stmt->bindParam(':comment', $comment);
				$result = $stmt->execute();
				return $result == 1 ? true : "Error in insertion, nothing was inserted. though nothing broke";
			}
			else return "Comment contained nothing. nothing was inserted";
		}
		catch(PDOException $e)
		{
			return "Connection failed: $e->getMessage() \ncode: $e->getCode";
		}
	}

	public function update() {
		try
		{
			$picid = Chat::filter('picid', FILTER_SANITIZE_NUMBER_INT);
			$chatid = Chat::filter('chatid');
			if (!$picid && !$chatid) {
				echo "Invalid picid or chatid";
			}
			$stmtString = "SELECT chatid, username, comment, timestamp FROM chat WHERE picid = :picid AND chatid > :chatid;";
			$stmt = $this->conn->prepare($stmtString);
			$stmt->bindParam(':picid', $picid);
			$stmt->bindParam(':chatid', $chatid);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // FETCH_NUM -> returnerer array indexeret i colonner angivet i tal.                                         // Andre return methoder er beskrevet her: https://www.php.net/manual/en/pdostatement.fetch.php
			$result = $stmt->fetchAll();
			return $result;
		}
		catch(PDOException $e)
		{
			return "Connection failed: $e->getMessage() \ncode: $e->getCode";
		}
	}

	// Filter _POST or _GET requests with _REQUEST
	private static function filter($name, $filter = FILTER_SANITIZE_STRING) {
		return filter_var($_REQUEST[$name], $filter);
	}

}