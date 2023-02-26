<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog de nails art pour les amateurs et professionnels, avec des tutoriels, des astuces et des photos de designs créatifs. Trouvez l'inspiration pour vos prochains projets de nail art ici !" />

    <link rel="canonical" href="https://www.nailsbyno.com" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/d2f808818c.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/design/css/defaut.css">
    <link rel="icon" href="./public/asset/img/logoNailsSolo.png" type="image/x-icon">
    <title><?= $title ?> || Nails by No</title>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WCS8B9LB6"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-8WCS8B9LB6');
</script>

<body class="bg-background">
    <section class="min-vh-100 vw-100 d-flex justify-content-center align-items-center">
        <?= $content ?>
    </section>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/d2f808818c.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>