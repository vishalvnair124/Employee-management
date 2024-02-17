<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "trackify_db";

try {
    $con = new mysqli($hostname, $username, $password, $db);
    if ($con->connect_error) {
        throw new Exception("Connection failed: " . $con->connect_error);
    }
} catch (Exception $e) {
    header("Location:../common/Error.php");
    exit;
}
?>
