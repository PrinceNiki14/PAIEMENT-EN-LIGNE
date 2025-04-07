<?php
session_start(); // Toujours au tout début

date_default_timezone_set("africa/abidjan");

// Inclure le fichier de connexion après le démarrage de la session
include "connexion.php";

// Récupérer les paramètres de l'URL
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Validation et filtrage des entrées
$montant = filter_var($_SESSION["montant"], FILTER_SANITIZE_NUMBER_INT);
$mobilephone = filter_var($_SESSION['mobilephone'], FILTER_SANITIZE_NUMBER_INT);
$methode = htmlspecialchars($_SESSION['methode']);

// echo "Montant : " . $montant . "<br>";
// echo "Mobilephone : " . $mobilephone . "<br>";

// Vérifier si les valeurs sont valides (pas false)
if($montant !== false && $mobilephone !== false){
    
    $dates = date("Y-m-d H:i:s");

    try {
        $insertion = $conn->prepare("INSERT INTO paie (numero, montant, type_paiement, dates) VALUES (:numero, :montant, :type_paiement, :dates)");
        $insertion->bindParam(':numero', $mobilephone);
        $insertion->bindParam(':montant', $montant);
        $insertion->bindParam(':type_paiement', $methode);
        $insertion->bindParam(':dates', $dates);
        
        if ($insertion->execute()) {
            echo "Insertion réussie!";
        } else {
            echo "Échec de l'insertion.";
        }
    } catch(PDOException $e) {
        echo "Erreur lors de l'insertion: " . $e->getMessage();
    }

} else {
    echo "Données invalides";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement réussi - ABS AUDIT ET EXPERTISE COMPTABLE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
</head>
<body>
    <div class="payment-card text-center">
        <div class="success-icon mb-4">
            <i class="fas fa-check-circle fa-5x text-success"></i>
        </div>
        
        <h2 class="mb-4">Paiement réussi</h2>
        <p class="mb-4">Votre paiement à ABS AUDIT ET EXPERTISE COMPTABLE a été traité avec succès.</p>
        
        <div class="mb-4">
            <p>Référence de transaction : <?php echo htmlspecialchars($session_id); ?></p>
        </div>
        
        <div class="row g-3 mt-4">
            <div class="col-12">
                <a href="../index.php" class="btn btn-pay w-100">Retour à l'accueil</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
