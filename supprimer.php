<?php
header("Content-Type: application/json");
require_once 'connection.php';

$response = array();

if(isset($_POST['id'])){
    //l'id a été fournie
    $id = $_POST['id'];
    $requete = $con ->prepare("DELETE  FROM films WHERE id = ?");
    $requete->bind_param('i',$id);

    if($requete->execute()){
        //si ok
        $response['error']= false;
        $response['message']= 'Le film a été supprimer avec succes';
    }else
    $response['error']= true;
    $response['message']= 'Le film n\' a pas été supprimer';
}else{
    //si user ne fourni aucun id
    $response['error']= true;
    $response['message']= 'veuillez renseignez l\id de l\'element à suppprimer';
}
//Afficher les reponses
print_r($response);

?>