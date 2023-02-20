<?php
// Définition du titre de la page
$title = 'Ajouter un article';
$sousTitre = 'Page des articles';
$titrePage = 'Ajouter un article';

// Démarrage de la temporisation de sortie
ob_start();
?>
<!-- Contenu de la page -->
<h2 class="display-6 my-5 text-center">Ajouter un article :</h2>
<div class="d-flex justify-content-center align-items-center mt-5">
    <form action="index.php?page=ajoutArticle" method="post" enctype="multipart/form-data" class="bg-white form-action h-75 p-3 mx-2 rounded shadow-lg">
        <fieldset class="mb-2">
            <label for="titre">Titre de l'article</label>
            <input type="text" name="titre" id="titre" class="form-control">
        </fieldset>
        <fieldset class="mb-2">
            <label for="description">Description de l'article</label>
            <input type="text" name="description" id="description" class="form-control">
        </fieldset>
        <fieldset class="mb-2">
            <label for="article">Contenu de l'article</label>
            <textarea name="article" id="article" cols="30" rows="10" class="form-control"></textarea>
        </fieldset>
        <fieldset class="mb-2">
            <label for="photo">Image de l'article</label>
            <input type="file" name="photo" id="photo" class="form-control">

        </fieldset>
        <fieldset>
            <button type="submit" class="btn btn-perso btn-sm text-white mt-2">Ajouter l'article</button>
        </fieldset>
    </form>
</div>

<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('base.php');
?>