document.addEventListener("DOMContentLoaded", function () {
    // Sélection du formulaire
    var form = document.querySelector('form');

    // Fonction de validation de l'identifiant
    function validateIdentifiant() {
        var identifiantInput = document.getElementById('identifiant');
        var identifiantValue = identifiantInput.value.trim();

        // Vérification si l'identifiant est vide
        if (identifiantValue === '') {
            alert("L'identifiant est obligatoire.");
            return false;
        }

        return true;
    }

    // Fonction de validation du mot de passe
    function validatePassword() {
        var passwordInput = document.getElementById('password');
        var passwordValue = passwordInput.value;

        // Vérification si le mot de passe a au moins 6 caractères
        if (passwordValue.length < 6) {
            alert("Le mot de passe doit comporter au moins 6 caractères.");
            return false;
        }

        return true;
    }

    // Fonction de validation des adresses e-mail
    function validateEmails() {
        var emailInput = document.getElementById('email');
        var emailConfirmInput = document.getElementById('email-confirm');
        var emailValue = emailInput.value.trim();
        var emailConfirmValue = emailConfirmInput.value.trim();

        // Vérification si les adresses e-mail sont identiques et non vides
        if (emailValue === '' || emailConfirmValue === '' || emailValue !== emailConfirmValue) {
            alert("Les adresses e-mail doivent être identiques et remplies.");
            return false;
        }

        return true;
    }

    // Fonction de validation générale du formulaire
    function validateForm(event) {
        // Appeler les fonctions de validation
        var isIdentifiantValid = validateIdentifiant();
        var isPasswordValid = validatePassword();
        var areEmailsValid = validateEmails();

        // Empêcher l'envoi du formulaire si une des conditions n'est pas respectée
        if (!isIdentifiantValid || !isPasswordValid || !areEmailsValid) {
            event.preventDefault(); // Bloquer l'envoi du formulaire
        }
    }

    // Ajouter l'événement de soumission du formulaire
    form.addEventListener('submit', validateForm);
});
