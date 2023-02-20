<?php
$titreFormulaire = "Modification du profil";
$titrePage = "Page de profil";
$title = "Mon profil";
ob_start();
?>
<section>
    <h2 class="display-6 my-5 text-center">Profil</h2>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="index.php?page=profil" method="post" class="bg-white col-lg-4 form-action h-75 p-5 rounded-end shadow-lg">
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
            <div class="d-flex justify-content-between">
                <p>
                    <button type="submit" class="btn btn-perso text-white mt-5">Modifier</button>
                </p>
                <p>
                    <button type="button" class="btn btn-perso text-white mt-5" data-bs-toggle="modal" data-bs-target="#supprimerProfil">
                        Supprimer
                    </button>
                </p>
            </div>

            <div class="modal fade" id="supprimerProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression du compte</h1>
                            <button type="button" class="btn-close btn-perso text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer votre compte ?
                            <p class="small">Cette action est irreversible !</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn small btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="index.php?page=deleteProfil" class="btn btn-perso">Confirmer</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    $content = ob_get_clean();
    require('base.php');
    ?>