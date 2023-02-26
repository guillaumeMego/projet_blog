<?php
$title = "Mon profil";
ob_start();
?>
<form action="index.php?page=profil" method="post" class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-10 pt-5 px-5 bg-background form-action rounded shadow">
    <a href="index.php?page=home" class="nav-link text-perso"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <h2 class="text-center mb-5"><img src="./public/asset/img/logonails.png" alt="Logo 'nails by no' du site" width="150"></h2>
    <h3 class="display-8 text-police mb-3 text-center">Modification du profil</h3>
    <p>
        <label for="username" class="form-label">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Nouveau nom d'utilisateur">
    </p>
    <p>
        <label for="mail" class="form-label">E-mail :</label>
        <input type="email" id="mail" name="mail" class="form-control" placeholder="Nouvel E-mail">
    </p>
    <p>
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Nouveau mot de passe">
    </p>
    <?php
    if (!empty($error)) {
        echo '<p class="text-danger">' . $error . '</p>';
    }
    if (!empty($success)) {
        echo '<p class="text-success">' . $success . '</p>';
    }
    ?>
    <div class="d-flex justify-content-between">
        <p>
            <button type="submit" class="btn btn-perso my-2 px-3 text-background btn-sm rounded">Modifier</button>
        </p>
        <p>
            <button type="button" class="btn btn-perso my-2 px-3 text-background btn-sm rounded" data-bs-toggle="modal" data-bs-target="#supprimerProfil">
                Supprimer
            </button>
        </p>
        <div class="modal fade" id="supprimerProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression du compte</h1>
                        <button type="button" class="btn-close btn-perso text-police" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                        <p class="small text-danger">Cela entraînera la suppression de vos likes et de vos commentaires.</p>
                        <p class="small text-danger">Cette action est irreversible !</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a href="index.php?page=deleteProfil" class="btn btn-danger">Confirmer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
<?php
$content = ob_get_clean();
require('baseform.php');
?>