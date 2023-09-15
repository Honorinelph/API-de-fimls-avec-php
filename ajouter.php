<?php
header("Content-Type: application/json");
require_once 'connection.php';

$response = array();

// Les différentes entrées : titre, description, langue, genre, date_de_sortie, box_office, duree, nombre_etoile
if (
    isset($_POST['titre']) &&
    !empty($_POST['description']) &&
    isset($_POST['langue']) &&
    isset($_POST['genre']) &&
    isset($_POST['date_de_sortie']) &&
    isset($_POST['box_offixe']) &&
    isset($_POST['duree']) &&
    isset($_POST['nombre_etoile'])
) {

    // Récupérez les valeurs des champs POST
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $langue = $_POST['langue'];
    $genre = $_POST['genre'];
    $date_de_sortie = $_POST['date_de_sortie'];
    $box_office = $_POST['box_offixe'];
    $duree = $_POST['duree'];
    $nombre_etoile = $_POST['nombre_etoile'];

    // Préparez la requête SQL avec des paramètres liés
    $requete = $con->prepare('INSERT INTO films (titre, description, langue, genre, date_de_sortie, box_offixe, duree, nombre_etoile) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

    if ($requete) {
        // Liez les paramètres
        $requete->bind_param("ssssdssi", $titre, $description, $langue, $genre, $date_de_sortie, $box_offixe, $duree, $nombre_etoile);

        // Exécutez la requête
        if ($requete->execute()) {
            // Message de succès
            $response['error'] = false;
            $response['message'] = 'Le film a été ajouté avec succès';
        } else {
            // Message d'échec
            $response['error'] = true;
            $response['message'] = 'Erreur lors de l\'ajout du film : ' . $requete->error;
        }

        // Fermez la requête
        $requete->close();
    } else {
        // Message d'erreur de préparation de la requête
        $response['error'] = true;
        $response['message'] = 'Erreur de préparation de la requête : ' . $con->error;
    }
} else {
    // Si certaines données ne sont pas fournies
    $response['error'] = true;
    $response['message'] = 'Veuillez fournir toutes les informations nécessaires pour ajouter un film';
}

// Affichez la réponse au format JSON
echo json_encode($response);
?>
