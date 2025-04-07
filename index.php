<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface de paiement ABS AUDIT ET EXPERTISE COMPTABLE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
</head>



<body>

<form id="paymentForm" action="" method="post">
    <div class="payment-card">
        <select class="language-selector">
            <option><span class="globe-icon"><i class="fa-solid fa-globe"></i></span> FR</option>
            <option><span class="globe-icon"><i class="fa-solid fa-globe"></i></span> EN</option>
        </select>
        
        <div class="row mb-4">
            <div class="col-6">
                <div class="payment-label">Paiement à </div>
                <div class="payment-value">ABS AUDIT & EXPERTISE COMPTABLE</div>
            </div>
            <div class="col-6">
                <div class="payment-label">Pour</div>
                <div class="payment-value purple-text">FACTURE</div>
            </div>
        </div>
        
        <div class="mb-4 display">
            <div class="payment-label">Montant</div>
            <input type="text" class="form-control" name="montant" id="montant">
        </div>
        
        <div class="mb-4">
            <div class="payment-label">Numéro de téléphone</div>
            <div class="phone-input">
                <div class="phone-prefix">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Flag_of_C%C3%B4te_d%27Ivoire.svg/1200px-Flag_of_C%C3%B4te_d%27Ivoire.svg.png" alt="Côte d'Ivoire flag" class="flag">
                    +225
                </div>
                <input type="tel" class="form-control" id="phoneNumber" placeholder="Entrez votre numéro de téléphone" maxlength="10" name="numero" required>
            </div>
        </div>
        
        <div class="mb-4">
            <div class="payment-label">Opérateur</div>
            <div class="row g-2">
                <div class="col-4">
                    <div class="operator-option" id="mtnOption">
                        <input type="radio" name="operator" id="mtn" class="operator-checkbox" data-href="https://mtn.ci/payment">
                        <label for="mtn" class="operator-label">
                            <img src="photo/mtn.jpg" alt="MTN">
                            <div class="operator-name">MTN</div>
                        </label>
                    </div>
                </div>

                <div class="col-4">
                    <div class="operator-option" id="waveOption">
                        <input type="radio" name="operator" id="wave" class="operator-checkbox" data-href="fichier_php/paiement_wave.php">
                        <label for="wave" class="operator-label">
                            <img src="photo/wave.png" alt="WAVE">
                            <div class="operator-name">WAVE</div>
                        </label>
                    </div>
                </div>

                <div class="col-4">
                    <div class="operator-option" id="orangeOption">
                        <input type="radio" name="operator" id="orange" class="operator-checkbox" data-href="fichier_php/success.php" >
                        <label for="orange" class="operator-label">
                            <img src="photo/orange.png" alt="Orange Money">
                            <div class="operator-name">ORANGE</div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-3 mt-4">
            <div class="col-6">
            <button type="button" class="btn btn-cancel w-100">Annuler</button>
            </div>
            <div class="col-6">
            <button type="submit" class="btn btn-pay w-100" style="background-color:red; color:black;">Payer</button>
            </div>
        </div>
        
        <!--<div class="footer-text">-->
        <!--    Proposé par <!-- <img src="pawapay.jpg" alt="PawaPay" height="15"> https://pay.wave.com/m/M_HEuzafnoyAeZ/c/ci/ -->
        <!--</div>-->
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const operatorRadios = document.querySelectorAll(".operator-checkbox");
        const form = document.getElementById("paymentForm");

        operatorRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                // Mise à jour de l'action du formulaire
                let newAction = this.getAttribute("data-href");
                if (newAction) {
                    form.setAttribute("action", newAction);
                }
            });
        });

        form.addEventListener("submit", function(event) {
            // Validation des champs avant soumission
            const montant = document.getElementById("montant").value;
            const numero = document.getElementById("phoneNumber").value;
            const selectedOperator = document.querySelector('input[name="operator"]:checked');

            if (!montant || !numero) {
                event.preventDefault();
                alert("Veuillez remplir tous les champs.");
                return;
            }

            if (!selectedOperator) {
                event.preventDefault();
                alert("Veuillez sélectionner un opérateur.");
                return;
            }
        });
    });
    </script>        

</body>
</html>