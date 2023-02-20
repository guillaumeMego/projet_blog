<?php
$title = 'Accueil';
$sousTitre = "page d'erreur";
$titrePage = "page d'erreur";



ob_start(); // retient et met dans content
?>
<section class="container mx-auto m-5">

    <h1>OUPS</h1>
    <p><?= $error ?></p>

</section>

<?php

$content = ob_get_clean();

require('base.php');
