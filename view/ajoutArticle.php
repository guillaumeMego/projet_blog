<?php
$title = 'Ajouter un article';
ob_start();
?>
<form action="index.php?page=ajoutArticle" method="post" enctype="multipart/form-data" class="px-5 pt-5 bg-background form-action rounded shadow">
    <a href="index.php?page=home" class="nav-link text-perso"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <h3 class="display-8 text-police mb-3 text-center">Ajout d'article</h3>
    <fieldset class="mb-2">
        <label for="titre" class="mb-2 text-police">Titre de l'article :</label>
        <input type="text" name="titre" id="titre" class="form-control">
    </fieldset>
    <fieldset class="mb-2">
        <label for="description" class="mb-2 text-police">Description de l'article :</label>
        <input type="text" name="description" id="description" class="form-control">
    </fieldset>
    <fieldset class="mb-2">
        <label for="article" class="mb-2 text-police">Contenu de l'article :</label>
        <textarea name="article" id="article" cols="30" rows="10" class="form-control"></textarea>
    </fieldset>
    <fieldset class="mb-2">
        <label for="photo" class="mb-2 text-police">Image de l'article :</label>
        <input type="file" name="photo" id="photo" class="form-control">

    </fieldset>
    <?php if (!empty($error)) : ?>
        <p class="text-danger small"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (!empty($success)) : ?>
        <p class="text-success small"><?php echo $success; ?></p>
    <?php endif; ?>
    <fieldset>
        <button type="submit" class="btn btn-perso shadow px-3 text-background btn rounded my-4">Ajouter l'article</button>
    </fieldset>
</form>
</div>

<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('baseform.php');
?>