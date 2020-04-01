<?php
  //$searchValue;
  //$orderBy;
    //if (isset($_GET["newusername"])) {
      $newusername = $_GET['newusername'];
    //}
    require_once('../db_config.php');

    $result;
    try 
    {
        $stmtString = "SELECT username FROM user WHERE ( username = :newusername)";

        $stmt = $conn->prepare($stmtString);
        $stmt->bindParam(':newusername', $newusername);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
          echo "exists";
        }
    }
    catch(PDOException $e)
    {
        echo "<br><p> Connection failed: " . $e->getMessage() . ". code: " . $e->getCode() . "</p>";
    }

    $conn = null;
?>
