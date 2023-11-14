<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $produit = $_POST["produit"];
    $prix = $_POST["prix"];

    // Créer une chaîne de données à enregistrer
    $commandeData = "Nom: $nom\nAdresse: $adresse\nProduit: $produit\nPrix: $prix\n\n";

    // Enregistrer les données dans le fichier texte
    $fichierCommandes = "commandes.txt";
    file_put_contents($fichierCommandes, $commandeData, FILE_APPEND | LOCK_EX);

    // Copie de sauvegarde dans un dossier spécifié
    $dossierSauvegarde = "sauvegarde_commandes/";
    if (!file_exists($dossierSauvegarde)) {
        mkdir($dossierSauvegarde, 0777, true); // Crée le dossier s'il n'existe pas
    }

    $fichierSauvegarde = $dossierSauvegarde . "commandes_backup_" . date("Ymd_His") . ".txt";
    file_put_contents($fichierSauvegarde, $commandeData, LOCK_EX);

    echo "Commande enregistrée avec succès.";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire de commande</title>
  </head>
  <body>
    <h1>Formulaire de commande</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="nom">Nom :</label>
      <input type="text" name="nom" id="nom" required><br><br>
      <label for="adresse">Adresse :</label>
      <textarea name="adresse" id="adresse" required></textarea><br><br>
      <label for="produit">Produit :</label>
      <input type="text" name="produit" id="produit" required><br><br>
      <label for="prix">Prix :</label>
      <input type="number" name="prix" id="prix" required><br><br>
      <input type="submit" value="Envoyer">
    </form>
  </body>
</html>
