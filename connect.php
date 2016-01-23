<?php
$servername = "localhost";
$username = "root";
$password = "root";
$bdd = "pornation";

// Create connection
$conn = new mysqli($servername, $username, $password);
mysqli_select_db($conn,$bdd) or die("erreur de connexion a la base de donnees");

// Check connection
if ($conn->connect_error) {
    die("connecion echoue " . $conn->connect_error);
} 
?>