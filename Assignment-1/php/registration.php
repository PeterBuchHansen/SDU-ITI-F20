<?php
// Create database connection
require 'config.php';

// If upload button is clicked ...
if (isset($_POST['upload'])) {
  
  echo "Open console and check"; 
  echo '<script>console.log("Hello");</script>';

  // Get email
  $Email = htmlentities($_POST['Email']);
  // Get username
  $Username = htmlentities($_POST['Username']);
  // Get password
  $Password = password_hash(htmlentities($_POST['Password']), PASSWORD_DEFAULT);


  // Get name
  $Name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
  // Get birthday
  $BDate = filter_var($_POST['BDate'], FILTER_SANITIZE_STRING);
  // Get encoded image name
  $Image = $_FILES['Image']['name'];
  // base64_encode(
  // image file directory
  $target = "img/pictures/" . basename($Image);

  try {
    $db = new PDO("mysql:host=$DB_SERVER;port=3307;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // insert email, username, password and auto id
    $db->prepare("INSERT INTO user (Email, Username, Password)
    VALUES('$Email', '$Username', '$Password')")->execute();
    // Get last inserted id 
    $userID = $db->lastInsertId();

    // insert name, birthday, profileimage and id from tabel user
    $sql = "INSERT INTO userinfo (Name, BDate, Image, LoginID) 
    VALUES('$Name', '$BDate', '$Image', '$userID')";
    // executes the statment
    $db->prepare($sql)->execute();

    // shows if the connection fails
    echo "Connected successfully";

    if (move_uploaded_file($_FILES['Image']['tmp_name'], $target)) {
      echo "Image uploaded successfully";
    } else {
      echo "Failed to upload image";
    }
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
}

?>
<form method="POST" action="../index.php" enctype="multipart/form-data">
  <h1>Create account</h1>
  <input type="email" placeholder="E-mail is required" name="Email" required />
  <input type="text" placeholder="Username is required" name="Username" required />
  <input type="password" placeholder="Password is required" name="Password" required />
  <input type="text" placeholder="Your full name is required" name="Name" required />
  <input type="date" value="2000-01-01" name="BDate" required />
  <input type="file" name="Image" accept="image/*" required>
  <button type="submit" name="upload">Sign up</button>
</form>