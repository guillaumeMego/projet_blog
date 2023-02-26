<?php
$title = 'Inscription';
ob_start();
?>
<form action="index.php?page=inscription" method="post" name="formulaire" class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-10 pt-5 px-5 bg-background form-action rounded shadow">
    <a href="index.php?page=connexion" class="nav-link text-perso"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <h2 class="text-center mb-5"><img src="./public/asset/img/logonails.png" alt="Logo 'nails by no' du site" width="200"></h2>
    <h3 class="display-8 text-police mb-3 text-center">Inscription</h3>
    <p>
        <input type="text" id="username" name="username" class="form-control mb-4" placeholder="Pseudo">
    </p>
    <p>
        <input type="email" id="mail" name="mail" class="form-control mb-4" placeholder="E-mail">
    </p>
    <p>
        <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Mot de passe">
    </p>
    <?php if (!empty($error)) : ?>
        <p class="text-danger small"><?php echo $error; ?></p>
    <?php endif; ?>
    <p>
        <button type="submit" class="btn btn-perso shadow px-3 text-background btn rounded mb-4">Envoyer</button>
    </p>
</form>

</div>
<?php
$content = ob_get_clean();
require('baseform.php');
?>