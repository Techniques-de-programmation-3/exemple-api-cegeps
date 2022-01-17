<?php

// Cette fonction prend l'object au format tablulaire SQL 
// et retourne un objet dont la structure correspond au format
// devant être retourné par l'API. 
function ConversionCegepSQLEnObjet($cegepSQL) {
    $cegepOBJ = new stdClass();
    $cegepOBJ->nom = $cegepSQL["nom"];

    $cegepOBJ->adresse = new stdClass();
    $cegepOBJ->adresse->noCivique = $cegepSQL["noCivique"];
    $cegepOBJ->adresse->rue = $cegepSQL["rue"];
    $cegepOBJ->adresse->ville = $cegepSQL["ville"];
    $cegepOBJ->adresse->code_postal = $cegepSQL["code_postal"];

    $cegepOBJ->coordonnees = new stdClass();
    $cegepOBJ->coordonnees->longitude = $cegepSQL["longitude"];
    $cegepOBJ->coordonnees->lattitude = $cegepSQL["lattitude"];

    $cegepOBJ->liste_programmes = explode(";", $cegepSQL["liste_programmes"]);

    return $cegepOBJ;
}   

?>