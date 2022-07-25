<?php
$servername = "localhost";
$username = "monitriip_cat";
$password = "";
$dbname = "monitriip_cat";
try {
  $conn = new PDO("mysqli:host=$servername;dbname=monitriip_cat", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>