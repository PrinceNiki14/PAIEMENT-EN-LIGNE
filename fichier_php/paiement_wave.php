<?php
session_start();

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider le montant
    $montant = isset($_POST['montant']) ? filter_var($_POST['montant'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0;
    $numero = isset($_POST['numero']) ? filter_var($_POST['numero'], FILTER_SANITIZE_NUMBER_INT) : '';

    $string = pathinfo($_SERVER["PHP_SELF"], PATHINFO_FILENAME);
    $string = preg_replace("/_/", " ", $string);

    $_SESSION['mobilephone'] = $numero;
    $_SESSION['montant'] = $montant;
    $_SESSION["methode"] = $string;

    echo $numero."</br>";
    echo $montant;
    echo $string;
    
    // Vérifier que le montant est valide
    if ($montant <= 0) {
        die(json_encode(['success' => false, 'message' => 'Montant invalide']));
    }
    
    // Vérifier que le numéro est valide (10 chiffres)
    if (strlen($numero) !== 10) {
        die(json_encode(['success' => false, 'message' => 'Numéro de téléphone invalide : ' . $numero]));
    }

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    header("location: success.php");
    
    // // Configuration de l'API Wave (remplacez avec vos identifiants réels)
    $api_key = "wave_sn_prod_YhUNb9d...i4bA6"; // Remplacez par votre clé API complète
    
    // URL de base de votre site
    $base_url = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    
    // Initialiser cURL
    $curl = curl_init();
    
    // Configuration de la requête cURL
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.wave.com/v1/checkout/sessions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            "amount" => (string)$montant,
            "currency" => "XOF",
            "error_url" => $base_url . "/error.php",
            "success_url" => $base_url . "/success.php",
            "client_reference" => "FACTURE_" . time(), // Référence unique pour la facture
            "mobile_phone" => "+225" . $numero // Format international pour la Côte d'Ivoire
        ]),
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . $api_key,
            "Content-Type: application/json"
        ],
    ]);
    
    // Exécuter la requête
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    // Fermer la session cURL
    curl_close($curl);
    
    // Traiter la réponse
    if ($err) {
        die(json_encode(['success' => false, 'message' => "Erreur cURL: " . $err]));
    } else {
        $result = json_decode($response, true);
        
        // Vérifier si la session de paiement a été créée avec succès
        if (isset($result['wave_launch_url'])) {
            // Rediriger vers l'URL de paiement Wave
            header('Location: ' . $result['wave_launch_url']);
            exit;
        } else {
            // Gérer l'erreur
            die(json_encode(['success' => false, 'message' => "Erreur: " . ($result['message'] ?? 'Erreur inconnue')]));
        }
    }


} else {
    // Si la page est accédée directement sans données POST
    header('Location: index.html');
    exit;
}

?>
