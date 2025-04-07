<?php
// Initialiser la session si nécessaire
session_start();

// Récupérer les paramètres d'erreur de l'URL
$error_code = isset($_GET['error_code']) ? $_GET['error_code'] : '';
$error_message = isset($_GET['error_message']) ? $_GET['error_message'] : 'Une erreur est survenue lors du traitement de votre paiement.';

// Vous pouvez journaliser l'erreur ici
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement échoué - ABS AUDIT ET EXPERTISE COMPTABLE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
</head>
<body>
    <div class="payment-card text-center">
        <div class="error-icon mb-4">
            <i class="fas fa-times-circle fa-5x text-danger"></i>
        </div>
        
        <h2 class="mb-4">Paiement échoué</h2>
        <p class="mb-4"><?php echo htmlspecialchars($error_message); ?></p>
        
        <?php if ($error_code): ?>
        <div class="mb-4">
            <p>Code d'erreur : <?php echo htmlspecialchars($error_code); ?></p>
        </div>
        <?php endif; ?>
        
        <div class="row g-3 mt-4">
            <div class="col-12">
                <a href="index.html" class="btn btn-pay w-100">Réessayer</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>