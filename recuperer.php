<?php
header("content-Type: application/json");
require_once 'connection.php';

 $response = array();
 $query = $con->prepare("SELECT id,titre from films");

 //verifier le resultat de la requette
 if($query->execute()){
    // la requette a été bien exécutée
    $films = array();
    $resultat = $query->get_result();

    while($elmt = $resultat->fetch_array(MYSQLI_ASSOC)){

        $films[] =$elmt;
    }
 $response ['error'] = false; 
 $response ['films'] = $films; 
 $response ['message'] = "La commande a été effectuée avec succès"; 
 $query->Close();

    
 }else{
    //impossible d'exécuter cette requette
    $response ['error'] = true; 
    $response ['message'] = "La commande n'a pas pu été exécutée"; 

 }

 //afficher les données
 print_r($response);
 //echo json_encode($response);
?>