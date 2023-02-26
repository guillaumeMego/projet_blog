<?php
$title = "Mot de passe oublié";
ob_start();
?>
<form action="index.php?page=token" method="post" class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-10 pt-5 px-5 bg-background form-action rounded shadow">
    <a href="index.php?page=connexion" class="nav-link text-perso"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <h2 class="text-center mb-5"><img src="./public/asset/img/logonails.png" alt="Logo 'nails by no' du site" width="150"></h2>
    <h3 class="display-8 text-police mb-3 text-center">Mot de passe oublié</h3>
    <p>
        <input type="email" id="mail" name="mail" class="form-control mb-4" placeholder="E-mail pour envoi du lien">
    </p>
    <?php
    if (!empty($error)) {
        echo '<p class="text-danger">' . $error . '</p>';
    }
    if (!empty($success)) : ?>
        <p class="text-success"><?= $success ?></p>
        <div class="spinner-border text-success mb-2" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    <?php endif;
    ?>
    <p>
        <button type="submit" class="btn btn-perso shadow px-3 text-background btn rounded mb-4">E-mail de confirmation</button>
    </p>
</form>
</div>
<?php
$content = ob_get_clean();
require('baseform.php');
?>