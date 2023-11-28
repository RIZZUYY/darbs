<?php
$servername = "fdb34.awardspace.net";
$username = "3931241_vanags";
$password = "R18DJ!G21DZ5";
$dbname = "3931241_vanags";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Savienojuma kļūda ar datu bāzi: " . $conn->connect_error);
}
?>
