<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$dbname = "secure_access";
$username = "root"; // default XAMPP MySQL user
$password = "";     // default password is empty

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "database connection is success";

} catch(PDOException $e) {
    die(json_encode(["success" => false, "message" => "DB Connection failed: " . $e->getMessage()]));
}
?>
