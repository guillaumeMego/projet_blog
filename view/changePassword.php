<?php
$titreFormulaire = "Mot de passe oublié";
$titrePage = "Récupération de mot de passe";
$title = "Mot de passe";
ob_start();
?>
<section>
    <h2 class="display-6 my-5 text-center">Changer de mot de passe</h2>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="index.php?page=changePassword" method="post" class="bg-white col-lg-4 form-action h-75 p-5 rounded-end shadow-lg">
            <h2 class="display-6 text-center mb-5"><?= $titreFormulaire ?></h2>
            <p>
                <label for="token" class="form-label">Votre token reçu par e-mail :</label>
                <input type="text" id="token" name="token" class="form-control">
            </p>
            <p>
                <label for="new_password" class="form-label">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" class="form-control">
            </p>
            <p>
                <button type="submit" class="btn btn-perso text-white">Changer de mot de passe</button>
            </p>
        </form>
    </div>
    <?php
    $content = ob_get_clean();
    require('base.php');
    ?>