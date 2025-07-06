<?php
$host = "sql313.infinityfree.com"; // MySQL Hostname
$user = "if0_39406544";            // MySQL Username
$pass = "Ggyan123";                // MySQL Password
$dbname = "if0_39406544_jobportal"; // MySQL Database Name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
