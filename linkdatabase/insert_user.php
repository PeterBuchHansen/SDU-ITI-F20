<script>console.log("INSERTING USER");</script>
<?php
    if(array_key_exists('signup-submit', $_POST)){
        try{
            $connection = new PDO("mysql:host=$server;port=3307;dbname=$database", 
            $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $stmt = $connection->prepare("INSERT INTO users (username, email, pwd) VALUES(:username, :email-register, :pwd-register)");
            
            $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $userXSS = htmlspecialchars($user);
            $stmt->bindParam(':username', $userXXS, PDO::PARAM_STR);

            $email = filter_var($_POST['email-register'], FILTER_SANITIZE_STRING);
            $emailXSS = htmlspecialchars($email);
            echo $emailXSS;
            $stmt->bindParam(':email-register', $emailXXS, PDO::PARAM_STR);

            $pass = filter_var(password_hash($_POST['pwd-register'], PASSWORD_DEFAULT), FILTER_SANITIZE_STRING);
            $passXSS = htmlspecialchars($pass);
            $stmt->bindParam(':pwd-register', $passXSS, PDO::PARAM_STR);

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            echo $e->getMessage();
        }
        $connection = null;
    }
?>
