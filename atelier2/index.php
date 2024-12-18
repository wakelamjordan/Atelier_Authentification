<?php
// Démarrer une session utilisateur qui sera en mesure de pouvoir gérer les Cookies
session_start();

// Vérifier si l'utilisateur est déjà en possession d'un cookie valide (cookie authToken ayant le contenu 12345)
// Si l'utilisateur possède déjà ce cookie, il sera redirigé automatiquement vers la page home.php
// Dans le cas contraire il devra s'identifier.
if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === '12345') {
    header('Location: page_admin.php');
    exit();
}

// création d'un array avec plusieurs utilisateurs
$account = [
    ["username" => "admin", "password" => "12345"],
    ["username" => "user", "password" => "utilisateur"]
];

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $username = $_POST['username'];
    // $password = $_POST['password'];

    $userPost = [
        "username" => $_POST['username'],
        "password" => $_POST['password']
    ];

    // Vérification simple du username et de son password.

    $lenth

    foreach ($account as $user) {
        $userAccount = [
            "username" => $user['username'],
            "password" => $user['password']
        ];

        $lenthAccount++;

        $authOk = ifAuthOk($userAccount, $userPost);
    }

    // Si ok alors on initialise le cookie sur le poste de l'utilisateur 

    function ifAuthOk($userAccount, $userPost)
    {
        if ($userAccount['username'] === $userPost['username'] && $userAccount['password'] === $userPost['password']) {

            // génération d'un token aléatoire
            $token = bin2hex(random_bytes(16));

            setcookie('authToken', $token, time() + 60, '/', '', false, true); // Le Cookie est initialisé et valable pendant 1 heure (3600 secondes) 
            header('Location: page_admin.php'); // L'utilisateur est dirigé vers la page home.php
            return true;
            // exit();
        // } else {
        //     $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }

        if
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>La page <a href="page_admin.php">page_admin.php</a> est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
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