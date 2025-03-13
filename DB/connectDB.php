<?php
$servername = "localhost";
$username2 = "MangaDRusers";
$password = "User2023@";
$dbname = "mangadr";
    
$conn = new mysqli($servername, $username2, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>