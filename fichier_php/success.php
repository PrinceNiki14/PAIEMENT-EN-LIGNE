<?php
// Initialiser la session si nécessaire
session_start();

// Récupérer les paramètres de l'URL
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Vous pouvez vérifier le statut du paiement en interrogeant l'API Wave si nécessaire
// avec le session_id

// Enregistrer le paiement dans votre base de données ici

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
                <a href="index.html" class="btn btn-pay w-100">Retour à l'accueil</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>