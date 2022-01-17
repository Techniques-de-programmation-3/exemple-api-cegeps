<?php
include_once 'include/config.php'; 
include_once 'include/fonctions.php'; 

header('Content-Type: application/json;');
header('Access-Control-Allow-Origin: *'); 

$mysqli = new mysqli($host, $username, $password, $database); // Établissement de la connexion à la base de données
if ($mysqli -> connect_errno) { // Affichage d'une erreur si la connexion échoue
  echo 'Échec de connexion à la base de données MySQL: ' . $mysqli -> connect_error;
  exit();
} 

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET':  // GESTION DES DEMANDES DE TYPE GET
	if(isset($_GET['id'])) { 
		if ($requete = $mysqli->prepare("SELECT * FROM cegeps WHERE id=?")) {  
		  $requete->bind_param("i", $_GET['id']); 
		  $requete->execute(); 

		  $resultat_requete = $requete->get_result(); 
		  $cegepSQL = $resultat_requete->fetch_assoc(); 

		  // Convesion de l'objet au format JSON désiré
		  $cegepObj = ConversionCegepSQLEnObjet($cegepSQL);

		  echo json_encode($cegepObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

		  $requete->close(); 
		}
	} else {
		$requete = $mysqli->query("SELECT * FROM cegeps");
		$listeCegepsObj = [];

		while ($cegepSQL = $requete->fetch_assoc()) {
			// Convesion de l'objet au format JSON désiré
			$cegepObj = ConversionCegepSQLEnObjet($cegepSQL);

			// Ajout du Cégep à la liste
			array_push($listeCegepsObj, $cegepObj);
		}

		echo json_encode($listeCegepsObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		$requete->close();
	}
	break;
case 'POST':  // GESTION DES DEMANDES DE TYPE POST
	$reponse = new stdClass();
	$reponse->message = "Ajout d'un cégep: ";
	
	$corpsJSON = file_get_contents('php://input');
	$data = json_decode($corpsJSON, TRUE); 

	$nom = $data['nom'];
	$noCivique = $data['adresse']['noCivique'];
	$rue = $data['adresse']['rue'];
	$ville = $data['adresse']['ville'];
	$code_postal = $data['adresse']['code_postal'];
	$longitude = $data['coordonnees']['longitude'];	
	$lattitude = $data['coordonnees']['lattitude'];	
	$liste_programmes_str = $data['liste_programmes'];

	if(isset($nom) && isset($noCivique) && isset($rue) && isset($ville) && isset($code_postal) && isset($longitude) && isset($lattitude) && isset($liste_programmes_str)) {
	  $liste_programmes = implode(';', $liste_programmes_str);

      if ($requete = $mysqli->prepare("INSERT INTO cegeps (nom, noCivique, rue, ville, code_postal, longitude, lattitude, liste_programmes) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")) {      
		$requete->bind_param("sssssdds", $nom, $noCivique, $rue, $ville, $code_postal, $longitude, $lattitude, $liste_programmes);

        if($requete->execute()) { 
          $reponse->message .= "Succès";  
        } else {
          $reponse->message .=  "Erreur dans l'exécution de la requête";  
        }

        $requete->close(); 
      } else  {
        $reponse->message .=  "Erreur dans la préparation de la requête";  
      } 
    } else {
		$reponse->message .=  "Erreur dans le corps de l'objet fourni";  
	}
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	
	break;
case 'PUT':  // GESTION DES DEMANDES DE TYPE PUT
case 'DELETE':  // GESTION DES DEMANDES DE TYPE DELEET
default:
	$reponse = new stdClass();
	$reponse->message = "Opération non supportée";	
	echo json_encode($reponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

$mysqli->close(); 
?>