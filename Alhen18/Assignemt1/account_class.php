<?php
session_start();

class account {

  public function login($values) {
    $db = getDB();
    $username = $values['Username'];
    $pass = $values['Password'];
    $count_sql = "SELECT count(*) FROM account WHERE username = :username;";
    $stmt = $db->prepare($count_sql);
    $stmt->bindparam(":username", $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if($count > 0) {
      $sql = "SELECT id,password FROM account WHERE username = :username;";
      $stmt = $db->prepare($sql);
      $stmt->bindparam(":username", $username);
      $stmt->execute();
    
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if(password_verify($pass, $row['password'])) {
          $_SESSION['name'] = $username;
          $_SESSION['AccountID'] = $row['id'];
          $db = null;
          return true;
        } else {
          $db = null;
          return false;
        }
      }
    } else {
      $db = null;
      return false;
    }
  }

  public function isLoggedIn() {
    if(isset($_SESSION['AccountID'])) {
      return true;
    } else {
      return false;
    }
  }

  public function logout() {
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['AccountID']);
    return true;
  }

  public function checkUsername($values) {
    $db = getDB();
    $username = $values['Username'];
    $sql = "SELECT count(*) FROM account WHERE username = :Username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":Username", $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $db = null;
    if($count > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function createAccount($values) {
    $db = getDB();
    $userName = $values['Username'];
    $password = $values['Password'];
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO account (username, password) "
         . "VALUES(:Username, :Password);";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(":Username", $userName);
    $stmt->bindparam(":Password", $hashPass);
    $stmt->execute();
    $rows = $stmt->rowCount();
    $db =  null;
    
    if($rows > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getAccountInfo() {
    $db = getDB();
    $sql = "SELECT * FROM account WHERE id = :AccountID;";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(":AccountID", $_SESSION['AccountID']);
    $stmt->execute();
    $returnVal = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
    return $returnVal;
  }

  public function getAccountList() {
    $db = getDB();
    $sql = "SELECT id, username FROM account ORDER BY id asc;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $returnVal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $db = null;
    return $returnVal;
  }
}
