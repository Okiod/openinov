<?php
// submit_form.php

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chemin du fichier CSV où les données seront sauvegardées
    $csvFilePath = "data.csv";


    // Ouvre le fichier CSV en mode append
    $csvFile = fopen($csvFilePath, 'a');

    // Si le fichier n'existe pas, crée l'entête du CSV
    if (filesize($csvFilePath) == 0) {
        fputcsv($csvFile, [
            'Nom', 'Prénom', 'Adresse', 'Ville', 'Code Postal', 'Email', 
            'Téléphone', 'Niveau BAC', 'Section/Spécialité', 'Etablissement', 
            'Contact par Email', 'Contact par SMS', 'Date', 'Formations Intéressées', 
            'Consentement', 'Signature'
        ]);
    }

    // Récupère les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $codePostal = $_POST['code_postal'];
    $email = $_POST['email'];
    $telephone = $_POST['tel'];
    $niveauBac = $_POST['bac'];
    $section = $_POST['section'];
    $etablissement = $_POST['Etablissement'];
    $contactEmail = isset($_POST['contact_email']) ? 'Oui' : 'Non';
    $contactSms = isset($_POST['contact_sms']) ? 'Oui' : 'Non';
    $date = $_POST['date'];
    // Concaténez toutes les formations choisies en une chaîne
    $formations = implode(', ', array_filter($_POST['formation'] ?? [], fn($value) => !empty($value)));
    $consentement = isset($_POST['consentement']) ? 'Oui' : 'Non';
    // Vous devrez implémenter la capture et le traitement de la signature ici

    // Créer une ligne de données pour le CSV
    $formData = [
        $nom, $prenom, $adresse, $ville, $codePostal, $email,
        $telephone, $niveauBac, $section, $etablissement,
        $contactEmail, $contactSms, $date, $formations,
        $consentement
    ];

    // Écriture des données dans le fichier CSV
    fputcsv($csvFile,$formData);
// Fermeture du fichier
fclose($csvFile);

// Message de confirmation ou redirection
echo "Les informations ont été enregistrées avec succès.";
// Ou vous pouvez rediriger vers une autre page avec:
// header('Location: merci.html');
// exit();
}
?>
