<?php
// ########### TRAITEMENT DE PHP ###########
// Appel du fichier de connexion à la BDD
require_once "inc/init.php";

// ####### ETAPE 1 - On vérifie si le formulaire a été validé.
if (!empty($_POST)) {
    
    // ####### ETAPE 2 - Echappement des caractères spéciaux pour éviter les injections SQL / XSS
        dataEscape();
    // 

    // ####### ETAPE 3 - Vérification des données
        if ( empty($_POST['titre']) || iconv_strlen($_POST['titre']) < 10 ) {
            $errorMessage .= "Merci d'indiquer un titre d'au moins 10 caractères <br>";
        }
        if ( empty($_POST['prix']) || !is_numeric($_POST['prix']) ) {
            $errorMessage .= "Merci d'indiquer un prix <br>";
        }
        if ( empty($_POST['description']) || iconv_strlen($_POST['description']) < 10 ) {
            $errorMessage .= "Merci d'indiquer une description d'au moins 10 caractères <br>";
        }
    // 

    // ####### ETAPE 4 - Upload de la photo
        // Si j'ai un nom pour la photo c'est que l'utilisateur à uploadé une photo
        if (!empty($_FILES['photo']['name'])) {
            copy($_FILES['photo']['tmp_name'], "photos/".$_FILES['photo']['name']);
        } else {
            $errorMessage .= "La photo est obligatoire <br>";
        }
    //

    // ####### ETAPE 5 - Enregistrement des données en BDD
        if ( empty($errorMessage) ) {
            
            $success = addProduct($bdd);

            if ($success) {
                $successMessage .= "Produit inséré en BDD <br>";
            } else {
                $errorMessage .= "Erreur lors de l'enregistrement <br>";
            }

        }
    // 
}

// ############# AFFICHAGE HTML #############
// Appel du header avec définition du titre de la page
$title = "Ajout Produit";
require_once RACINE_SITE . "inc/header.php"; ?>

<!-- ############# CODE SPECIFIQUE A LA PAGE ############# -->

    <h1 class="text-center mt-3">Ajout produit</h1>

    <!-- Affichage des messages -->
    <?php require_once RACINE_SITE . 'inc/messages.php' ?>

    <!-- Affichage du formulaire -->
    <form class="col-md-6 mx-auto" action="ajout_produit.php" method="POST" enctype="multipart/form-data" >

        <label class="form-label" for="titre">Titre</label>
        <input class="form-control" type="text" name="titre" id="titre" value="<?= $_POST['titre'] ?? "" ?>">

        <label class="form-label" for="prix">Prix</label>
        <input class="form-control" type="number" step="0.01" name="prix" id="prix" value="<?= $_POST['prix'] ?? "" ?>">

        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="5">
            <?= $_POST['decription'] ?? "" ?>
        </textarea>

        <label class="form-label" for="photo">Photo</label>
        <input class="form-control" type="file" name="photo" id="photo">

        <button class="btn btn-primary d-block mx-auto my-4">Envoyer</button>

    </form>

<!-- ##################################################### -->

<?php // Appel du footer de mon site
require_once RACINE_SITE . "inc/footer.php";
