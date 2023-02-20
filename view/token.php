<?php
$titreFormulaire = "Mot de passe oublié";
$titrePage = "Récupération de mot de passe";
$title = "Mot de passe";
ob_start();
?>
<section>
    <h2 class="display-6 my-5 text-center">Mot de passe oublié</h2>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="index.php?page=token" method="post" class="bg-white col-lg-4 form-action h-75 p-5 rounded-end shadow-lg">
            <h2 class="display-6 text-center mb-5"><?= $titreFormulaire ?></h2>
            <p>
                <label for="mail" class="form-label">E-mail :</label>
                <input type="email" id="mail" name="mail" class="form-control">
            </p>
            <p>
                <button type="submit" class="btn btn-perso text-white">Envoyer une confirmation par mail</button>
            </p>
        </form>
    </div>
    <?php
    $content = ob_get_clean();
    require('base.php');
    ?>