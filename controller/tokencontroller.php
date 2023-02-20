<?php
function token()
{
    if (isset($_POST['mail'])) {
        $email = $_POST['mail'];
        if (MotDePasseOublie::checkEmail($email)) {
            $token = MotDePasseOublie::createToken($email);

            // Envoi du mail
            MotDePasseOublie::sendMail($email, $token);
        }
    }
    require('./view/token.php');
}

function verifieToken()
{
    if (!empty($_POST['token']) && !empty($_POST['newpassword'])) {
        $token = $_POST['token'];
        if (MotDePasseOublie::checkToken($token)) {
            $password = Securite::chiffrer(htmlspecialchars($_POST['password']));
            MotDePasseOublie::changePassword($password, $token);
        }
    }
    require('./view/changePassword.php');
}
