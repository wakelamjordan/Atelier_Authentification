<?php
// Démarre la session
session_start();

// permet un ajout de compte et page facilement, en quelque sorte similaire à ce que l'on pourrai obtenir à partir d'une bdd
$account = [
    [
        'username' => 'admin',
        'password' => 'secret',
        'page' => 'page_admin.php'
    ],
    [
        'username' => 'user',
        'password' => 'utilisateur',
        'page' => 'page_user.php'
    ]
];

// Vérifier si l'utilisateur est déjà connecté et si on a une valeur username pour effectuer un redirection
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['username']) {
    // sur la valeur de username on effectue le switch et une redirection vers la page correspondante si aucune valeur prévu on reste sur la page et stope le script, le html est alors simplement affiché par le navigateur

    foreach ($account as $user) {
        if ($user['username'] === $_SESSION['username']) {
            header('Location: ' . $user['page']);
            break;
        }
    }
}

if (isset($_SESSION['count_visite'])) {
    $_SESSION['count_visite']++;
} else {
    $_SESSION['count_visite'] = 1;
}

echo "<pre>";
echo ("variable global _SESSION ");
print_r($_SESSION);
echo "</pre>";

// Gérer le formulaire de connexion
// si avec la requete effectué au serveur, que l'on vérifie avec la superglobale $_SERVER et que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // on prend dans les variable global post les valeurs des clé username et password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // switch sur la valeur de username puis vérification de password simple avec attribution des valeurs de session nécessaires aux prochaines vérif sur les différentes pages

    foreach ($account as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['count_visite'] = 0;
            header('Location: ' . $user['page']);
            break;
        }
    }
    // echo plus friendly pour savoir que ce n'est pas bon, dans lequel on arrive uniquement si aucune autres conditions n'est valide avant
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>
    <h1>Atelier authentification par Session</h1>
    <h2>Vous avez visité la page <?= htmlspecialchars($_SESSION['count_visite']); ?></h2>
    <h3>La page <a href="page_admin.php">page_admin.php</a> de cet atelier 3 est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>