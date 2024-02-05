<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Visualisation des données</title>
    <link rel="icon" type="image/png" href="chemin/vers/le/faviconV2.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap');
        
        /* Styles existants */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Nouveaux styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: black; /* Couleur du texte ajustée pour la lisibilité */
            margin: 0;
            padding: 0;
        }

        /* ... Autres styles ... */
        /* Styles pour le formulaire, les entrées, les boutons, etc. */

        header {
            background-color: #FFF;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        img {
            height: 100px;
            width: auto;
        }
    </style>
</head>
<body>
    <header>
        <!-- Insérez votre logo ici -->
        <img src="logoEpsiFondBlanc.svg" alt="Logo">
    <h1>Données enregistrées</h1>
    <a href="data.csv" download="data.csv" style="margin-bottom: 20px; display: block;">Télécharger les données</a>
    <button id="saveToUSB">Sauvegarder sur USB</button>

<script>
    document.getElementById('saveToUSB').addEventListener('click', function() {
        fetch('save_to_usb.php', {
            method: 'POST',
        })
        .then(response => response.text())
        .then((response) => {
            alert(response); // Afficher la réponse du serveur (Succès ou message d'erreur)
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
</script>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Ville</th>
                <th>Code Postal</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Niveau BAC</th>
                <th>Section/Spécialité</th>
                <th>Etablissement</th>
                <th>Contact par Email</th>
                <th>Contact par SMS</th>
                <th>Date</th>
                <th>Formations Intéressées</th>
                <th>Consentement</th>
                <th>Motivations</th>
                <th>Autre Motivation</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $csvFilePath = 'data.csv';
                if (($handle = fopen($csvFilePath, 'r')) !== FALSE) {
                    // Ignorer la ligne d'en-tête
                    if (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        // En-têtes déjà définis dans le HTML ci-dessus
                    }

                    // Lire les lignes suivantes
                    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                        echo '<tr>';
                        foreach ($data as $cell) {
                            echo '<td>' . htmlspecialchars($cell) . '</td>';
                        }
                        echo '</tr>';
                    }
                    fclose($handle);
                } else {
                    echo '<tr><td colspan="14">Impossible d\'ouvrir le fichier.</td></tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
