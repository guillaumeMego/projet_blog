<?php
$title = "Mot de passe";
ob_start();
?>


<form action="index.php?page=changePassword" method="post" class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-10 pt-5 px-5 bg-background form-action rounded shadow">
    <h2 class="text-center mb-5"><img src="./public/asset/img/logonails.png" alt="Logo 'nails by no' du site" width="150"></h2>
    <h3 class="display-8 text-police mb-3 text-center">Mot de passe oublié</h3>

    <?php
    if (!empty($error)) {
        echo '<p class="text-danger">' . $error . '</p>';
    }
    ?>
    <?php
    if (!empty($success)) : ?>
        <p class="text-success"><?= $success ?></p>
        <p>
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <input type="password" id="new_password" name="password" class="form-control" placeholder="Nouveau mot de passe">
        </p>
        <button type="submit" class="btn btn-perso text-white mb-4">Changer de mot de passe</button>
    <?php endif; ?>
</form>
<?php
$content = ob_get_clean();
require('baseform.php');
?>