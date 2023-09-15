<?php
header("Content-Type: application/json");
require_once 'connection.php';

$response = array();

// Vérifiez si les éléments à mettre à jour sont présents dans la requête POST
if(isset($_POST['id']) && isset($_POST['description']) 
&& isset($_POST['nombre_etoile']) && isset($_POST['box_office'])){ 

    // Récupérez les valeurs des champs POST
    $id = $_POST['id'];
    $description = $_POST['description'];
    $nombre_etoile = $_POST['nombre_etoile'];
    $box_office = $_POST['box_office'];

    // Préparez la requête SQL avec des paramètres liés
    $requete = $con->prepare('UPDATE films SET description=?, nombre_etoile=?, box_office=? WHERE id=?');

    if($requete){
        // Liez les paramètres
        $requete->bind_param("sssi", $description, $nombre_etoile, $box_office, $id);

        // Exécutez la requête
        if($requete->execute()){
            // Message de succès
            $response['error'] = false;
            $response['message'] = 'Mise à jour effectuée avec succès';
        } else {
            // Message d'échec
            $response['error'] = true;
            $response['message'] = 'Échec lors de la mise à jour du film : ' . $requete->error;
        }

        // Fermez la requête
        $requete->close();
    } else {
        // Message d'erreur de préparation de la requête
        $response['error'] = true;
        $response['message'] = 'Erreur de préparation de la requête : ' . $con->error;
    }
} else {
    // Aucune donnée d'entrée fournie
    $response['error'] = true;
    $response['message'] = "Veuillez fournir l'id, la description, le nombre d'étoiles et le box office";
}

// Affichez la réponse au format JSON
echo json_encode($response);
?>
