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

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
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

    $monsieurChecked = isset($_POST['sexe']) && in_array('monsieur', $_POST['sexe']);
    $madameChecked = isset($_POST['sexe']) && in_array('madame', $_POST['sexe']);

    if ($monsieurChecked && $madameChecked) {
        $sexe = 'Autre';
    } elseif ($monsieurChecked) {
        $sexe = 'Monsieur';
    } elseif ($madameChecked) {
        $sexe = 'Madame';
    } else {
        $sexe = 'Non spécifié'; // ou laissez cette chaîne vide si vous préférez
    }

    $formationsInteressees = isset($_POST['formation']) ? implode(', ', $_POST['formation']) : '';

    // Concaténez toutes les motivations choisies en une chaîne
    $motivations = isset($_POST['motivation']) ? implode(', ', $_POST['motivation']) : '';
    $autreMotivation = $_POST['autre_motivation'] ?? '';


    $consentement = isset($_POST['consentement']) ? 'Oui' : 'Non';

    // Créer une ligne de données pour le CSV (ajouter $motivations et $autreMotivation à la fin)
    $formData = [
        $nom, $prenom, $sexe, $ville, $codePostal, $email,
        $telephone, $niveauBac, $section, $etablissement,
        $contactEmail, $contactSms, $date, $formationsInteressees,
        $consentement, $motivations, $autreMotivation
    ];
    $isEmptyLine = true;
    foreach ($formData as $item) {
        if (!empty($item)) {
            $isEmptyLine = false;
            break;
        }
    }

    // Écriture des données dans le fichier CSV
    fputcsv($csvFile, $formData);
    // Fermeture du fichier
    fclose($csvFile);

    // Redirection après 5 secondes
    header("Refresh:5; url=index.html");

    // Message de confirmation
    echo "Les informations ont été enregistrées avec succès. Vous allez être redirigé vers la page d'accueil dans 5 secondes.";
}
?>
