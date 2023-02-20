<?php
// Définition du titre de la page
$title = $article['title'];
$sousTitre = 'Page de blog';
$titrePage = $article['title'];
// Démarrage de la temporisation de sortie
ob_start();

?>
<h2 class="display-6 my-5 text-center">Modifier un article :</h2>
<div class="d-flex justify-content-center align-items-center mt-5">
    <form action="index.php?page=updateArticle&id=<?php echo $article['id']; ?>" method="post" enctype="multipart/form-data" class="bg-white form-action h-75 p-3 mx-2 rounded shadow-lg">
        <fieldset class="mb-2">
            <label for="titre">Titre de l'article</label>
            <input type="text" name="titre" id="titre" placeholder="<?= $article['title']; ?>" class="form-control">
        </fieldset>
        <fieldset class="mb-2">
            <label for="description">Description de l'article</label>
            <input type="text" name="description" id="description" placeholder="<?= $article['description']; ?>" class="form-control">
        </fieldset>
        <fieldset class="mb-2">
            <label for="article">Contenu de l'article</label>
            <textarea name="article" id="article" cols="30" rows="10" class="form-control"><?= $article['content']; ?></textarea>
        </fieldset>
        <fieldset class="mb-2">
            <label for="photo">Image de l'article</label>
            <input type="file" name="photo" id="photo" class="form-control">

        </fieldset>
        <fieldset>
            <button type="submit" class="btn btn-perso text-white mt-2">Modifier l'article</button>
        </fieldset>
    </form>
</div>

<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('base.php');
?>