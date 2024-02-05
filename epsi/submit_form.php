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
            'Nom', 'Prénom', 'Ville', 'Code Postal', 'Email', 
            'Téléphone', 'Niveau BAC', 'Section/Spécialité', 'Etablissement', 
            'Contact par Email', 'Contact par SMS', 'Date', 'Formations Intéressées', 
            'Consentement'
        ]);
    }

    // Récupère les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    // Récupère les données du formulaire
    $sexe = $_POST['sexe'] ?? 'Non spécifié'; // Utilisez 'Non spécifié' ou une valeur par défaut si rien n'est choisi
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

    // Créer une ligne de données pour le CSV
    $formData = [
        $nom, $prenom, $sexe, $ville, $codePostal, $email,
        $telephone, $niveauBac, $section, $etablissement,
        $contactEmail, $contactSms, $date, $formations,
        $consentement
    ];

    // Écriture des données dans le fichier CSV
    fputcsv($csvFile,$formData);
    // Fermeture du fichier
    fclose($csvFile);

    // Redirection après 5 secondes
    header("Refresh:5; url=index.html");

    // Message de confirmation
    echo "Les informations ont été enregistrées avec succès. Vous allez être redirigé vers la page d'accueil dans 5 secondes.";
}
?>
