<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "paiement";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Échec de connexion : " . mysqli_connect_error());
}
echo "Connexion réussie";



?>