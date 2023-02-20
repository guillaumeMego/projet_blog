<?php
$titreFormulaire = "Connectez vous ici :";
$titrePage = "Connexion";
$title = "Connexion";
ob_start();
?>
<section>
    <h2 class="display-6 my-5 text-center">Connexion</h2>
    <div class="d-flex justify-content-center align-items-center mt-5">

        <form action=" index.php?page=connexion" method="post" class="bg-white form-action h-75 p-5 rounded shadow-lg">
            <h2 class="display-6 text-center mb-4"><?= $titreFormulaire ?></h2>
            <p>
                <label for="mail" class="form-label mt-5">E-mail :</label>
                <input type="email" id="mail" name="mail" class="form-control">
            </p>
            <p>
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control">
            </p>
            <p>
                <button type="submit" class="btn btn-perso small mt-3">Envoyer</button>
            </p>
            <a href="inscription" class="btn btn-outline-perso btn-sm">Vous etes nouveau ?</a>
        </form>
    </div>
</section>
<?php
$content = ob_get_clean();
require('base.php');
?>