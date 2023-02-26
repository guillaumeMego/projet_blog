<?php
$title = $title;
ob_start();
?>

<form action="index.php?page=updateArticle&id=<?php echo $id_article; ?>" method="post" enctype="multipart/form-data" class="px-5 pt-5 bg-background form-action rounded shadow">
    <a href="index.php?page=home" class="nav-link text-perso"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <h3 class="display-8 text-police mb-3 text-center">Modifier l'article</h3>
    <fieldset class="mb-2">
        <label for="titre" class="mb-2 text-police">Titre de l'article</label>
        <input type="text" name="titre" id="titre" placeholder="<?= $title ?>" class="form-control">
    </fieldset>
    <fieldset class="mb-2">
        <label for="description" class="mb-2 text-police">Description de l'article</label>
        <input type="text" name="description" id="description" placeholder="<?= $description ?>" class="form-control">
    </fieldset>
    <fieldset class="mb-2">
        <label for="article" class="mb-2 text-police">Contenu de l'article</label>
        <textarea name="article" id="article" cols="30" rows="10" class="form-control"><?= $contentArt ?></textarea>
    </fieldset>
    <fieldset class="mb-2">
        <label for="photo" class="mb-2 text-police">Image de l'article</label>
        <input type="file" name="photo" id="photo" class="form-control">

    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-perso shadow px-3 text-background btn rounded my-4">Modifier l'article</button>
    </fieldset>
</form>


<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('baseform.php');
?>