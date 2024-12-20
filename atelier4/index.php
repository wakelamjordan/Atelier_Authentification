<?php
// Nom d'utilisateur et mot de passe corrects

$account = [
    [
        'username' => 'admin',
        'password' => 'secret'
    ],
    [
        'username' => 'user',
        'password' => 'utilisateur'
    ]
];

// Vérifier si l'utilisateur a envoyé des identifiants
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Envoyer un header HTTP pour demander les informations
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Vous devez entrer un nom d\'utilisateur et un mot de passe pour accéder à cette page.';
    exit;
}

foreach ($account as $user) {
    // $valid_username = 'admin';
    // $valid_password = 'secret';
    // $valid_username = $user['username'];
    // $valid_password = $user['password'];

    // var_dump($_SERVER['PHP_AUTH_USER']);


    if ($_SERVER['PHP_AUTH_USER'] === $user['username'] && $_SERVER['PHP_AUTH_PW'] === $user['password']) {
        $authOk = true;
        break;
    }
}

if (!$authOk) {
    header('WWW-Authenticate: Basic realm="Zone Protégée"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    exit;
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>

<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Ceci est une page protégée par une authentification simple via le header HTTP</p>
    <p>C'est le serveur qui vous demande un nom d'utilisateur et un mot de passe via le header WWW-Authenticate</p>
    <p>Aucun système de session ou cookie n'est utilisé pour cet atelier</p>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></p>
    <h2>Si vous êtes admin vous pourrez voir le texte suivant :</h2>
    <?php
    if ($_SERVER['PHP_AUTH_USER'] === 'admin') {
        echo '<p><span style="font-size: large; color:red; font-weight:bold">Vous êtes admin</span> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, architecto?</p>';
    }
    ?>

</body>

</html>