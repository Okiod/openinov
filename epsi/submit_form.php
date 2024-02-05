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
            'Nom', 'Prénom', 'Sexe', 'Ville', 'Code Postal', 'Email', 
            'Téléphone', 'Niveau BAC', 'Section/Spécialité', 'Etablissement', 
            'Contact par Email', 'Contact par SMS', 'Date', 'Formations Intéressées', 
            'Consentement', 'Motivations', 'Autre Motivation'
        ]);
    }

    // ... (autres champs déjà présents)

    // Concaténez toutes les motivations choisies en une chaîne
    $motivations = implode(', ', array_filter($_POST['motivation'] ?? [], fn($value) => !empty($value)));
    $autreMotivation = $_POST['autre_motivation'] ?? '';

    // Créer une ligne de données pour le CSV (ajouter $motivations et $autreMotivation à la fin)
    $formData = [
        $nom, $prenom, $sexe, $ville, $codePostal, $email,
        $telephone, $niveauBac, $section, $etablissement,
        $contactEmail, $contactSms, $date, $formations,
        $consentement, $motivations, $autreMotivation
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
