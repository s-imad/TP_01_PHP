<?php

// ######## ETAPE 1 - Connexion à la BDD
// Déclaration des variables contenant les informations de connexion
$sgbd = "mysql";
$host = "localhost";
$dbname = "php_meubles";
$username = "root";
$mdp = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
];

// Création d'un système try/catch pour récupérer les erreurs si la connexion échoue
try {
    $bdd = new PDO("$sgbd:host=$host;dbname=$dbname", $username, $mdp, $options);
} catch (\Exception $e) {
    die("ERREUR DE CONNEXION BDD : " . $e->getMessage());
}

// ######## ETAPE 2 - Déclaration des informations globales au site
// Déclaration des variables "globales" (que je pourrais utiliser sur tous mon site)
// Déclaration des constantes pour gérer l'import de fichiers et les URL.
$errorMessage = "";
$successMessage = "";

define("RACINE_SITE", str_replace('\\', '/', str_replace("inc", "", __DIR__)));
define("URL", "http://" . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], "", RACINE_SITE) );

// ######## ETAPE 3 - Appel du fichier des fonctions
require_once RACINE_SITE . "inc/functions.php";
