<?php 

/**
 * Fonction développeur qui permet un affichage rapide des données.
 */
function debug($variable){
    echo '<pre>';
        print_r($variable);
    echo '</pre>';
}

/**
 * Fonction qui permet d'échapper les caractères spéciaux
 */
function dataEscape($array = [])
{
    
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
        $_POST[$key] = trim($value);
    }

    foreach ($_GET as $key => $value) {
        $_GET[$key] = htmlspecialchars($value, ENT_QUOTES);
        $_GET[$key] = trim($value);
    }

    foreach ($array as $key => $value) {
        $array[$key] = htmlspecialchars($value, ENT_QUOTES);
        $array[$key] = trim($value);
    }

}

/**
 * Fonction qui permet l'ajout de produit en BDD
 */
function addProduct($pdoObject){

    $requete = $pdoObject->prepare("INSERT INTO produit(titre, prix, description, photo) VALUES(:titre, :prix, :description, :photo)");

    // $success = $requete->execute([
    //     'titre' => $_POST['titre'],
    //     'prix' => $_POST['prix'],
    //     'description' => $_POST['description'],
    //     'photo' => $_FILES['photo']['name']
    // ]);

    // return $success;

    return $requete->execute([
        'titre' => $_POST['titre'],
        'prix' => $_POST['prix'],
        'description' => $_POST['description'],
        'photo' => $_FILES['photo']['name']
    ]);
}

/**
 * Fonction qui permet la récupération de tous les produits en BDD
 */
function getAllProducts($pdoObject){
    return $pdoObject->query("SELECT * FROM produit ORDER BY id_produit")->fetchAll(PDO::FETCH_ASSOC);
}
