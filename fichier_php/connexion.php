<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "paiement";

try {

    // Création de la connexion PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    // Configuration pour afficher les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connexion réussie";

} catch(PDOException $e) {

    echo "Erreur de connexion: " . $e->getMessage();

}

?>
