<?php
// Démarre la session
session_start();

// Vérifier si l'utilisateur est déjà connecté et si on a une valeur username pour effectuer un redirection
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['username']) {
    // sur la valeur de username on effectue le switch et une redirection vers la page correspondante si aucune valeur prévu on reste sur la page et stope le script, le html est alors simplement affiché par le navigateur
    switch ($_SESSION['username']) {
        case 'admin':
            header('Location: page_admin.php'); // Si l'utilisateur s'est déjà connecté alors il sera automatiquement redirigé vers la page protected.php
            break;
        case 'user':
            header('Location: page_user.php'); // Si l'utilisateur s'est déjà connecté alors il sera automatiquement redirigé vers la page protected.php
            break;
        default:
            exit;
            break;
    }
}

// Gérer le formulaire de connexion
// si avec la requete effectué au serveur, que l'on vérifie avec la superglobale $_SERVER et que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // on prend dans les variable global post les valeurs des clé username et password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // switch sur la valeur de username puis vérification de password simple avec attribution des valeurs de session nécessaires aux prochaines vérif sur les différentes pages

    switch ($username) {
        case 'admin':
            if ($password === 'secret') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: page_admin.php');
            };
            break;
        case 'user':
            if ($password === 'utilisateur') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('Location: page_user.php');
            };
            break;
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