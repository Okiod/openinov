<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Visualisation des données</title>
    <style>
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
    </style>
</head>
<body>
    <h1>Données enregistrées</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
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
