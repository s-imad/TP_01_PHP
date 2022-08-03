<?php
// ########### TRAITEMENT DE PHP ###########
// Appel du fichier de connexion à la BDD
require_once "inc/init.php";

// ####### ETAPE 1 - Récupération des données en BDD
$produits = getAllProducts($bdd);

// ############# AFFICHAGE HTML #############
// Appel du fichier header + définition du titre
$title = "Boutique";
require_once RACINE_SITE . "inc/header.php"; ?>

<!-- ########### CODE SPECIFIQUE A LA PAGE ########### -->

    <h1 class="text-center mt-4">Liste des produits de mon site</h1>

    <div class="container">
        <div class="d-flex flex-wrap justify-content-evenly">
            <!-- Affichage de nos produits -->
            <?php foreach ($produits as $produit) { ?>
                <div class="card my-3" style="width: 16rem;">
                    <img class="card-img-top"  src="<?= "photos/".$produit['photo'] ?>" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produit['titre'] ?></h5>
                        <p class="card-text"><?= $produit['description'] ?></p>
                        <span class="fs-5 badge bg-success rounded-pill" ><?= $produit['prix'] ?>€</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<!-- ################################################# -->

<?php 
// Appel du fichier footer
require_once RACINE_SITE . "inc/footer.php";