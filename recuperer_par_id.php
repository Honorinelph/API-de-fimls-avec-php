<?php
header("Content-Type: application/json");
require_once 'connection.php';

$response = array();

if (isset($_GET["id"])) {

    // Exécutez la requête en recherchant l'élément concerné
    $id = $_GET['id'];

    $query = $con->prepare("SELECT id, titre, description, langue, genre, date_de_sortie, box_offixe, duree, nombre_etoile FROM films WHERE id = ?");
    
    if ($query === false) {
        die("Erreur de préparation de la requête : " . $con->error);
    }

    $query->bind_param("i", $id); // Utilisez "s" pour le type de chaîne (string)

    if ($query->execute()) {
        // Succès
        $query->bind_result($id, $titre, $description, $langue, $genre, $date_de_sortie, $box_offixe, $duree, $nombre_etoile);
        $query->fetch();

        $films = array(
            'id' => $id,
            'titre' => $titre,
            'description' => $description,
            'langue' => $langue,
            'genre' => $genre,
            'date_de_sortie' => $date_de_sortie,
            'box_offixe' => $box_offixe,
            'duree' => $duree,
            'nombre_etoile' => $nombre_etoile
        );

        $response['error'] = false;
        $response['films'] = $films;
        $response['message'] = 'Le film recherché existe dans la base de données';
    } else {
        // Échec
        $response['error'] = true;
        $response['message'] = 'Le film recherché n\'existe pas dans la base de données';
    }
} else {
    // Aucun titre de film fourni
    $response['error'] = true;
    $response['message'] = 'Veuillez fournir un id de film à rechercher';
}

// Afficher le résultat
//echo json_encode($response);
print_r($response);
?>
