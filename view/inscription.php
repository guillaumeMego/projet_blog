<?php
$titreFormulaire = "Inscrivez vous ici :";
$titrePage = "Inscription";
$title = 'Inscription';
ob_start();
?>
<section>
    <h2 class="display-6 my-5 text-center">Inscription</h2>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="index.php?page=inscription" method="post" class="bg-white col-lg-4 form-action h-75 p-5 rounded-end shadow-lg">
            <h2 class="display-6 text-center mb-5"><?= $titreFormulaire ?></h2>
            <p>
                <label for="username" class="form-label">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" class="form-control">
            </p>
            <p>
                <label for="mail" class="form-label">E-mail :</label>
                <input type="email" id="mail" name="mail" class="form-control">
            </p>
            <p>
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control">
            </p>
            <p>
                <button type="submit" class="btn btn-perso mt-3">Envoyer</button>
            </p>
        </form>
    </div>
    <?php
    $content = ob_get_clean();
    require('base.php');
    ?>