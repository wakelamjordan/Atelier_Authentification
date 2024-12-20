<?php
// Démarrer la session
session_start();

// var_dump($_SESSION['username']);


// Vérifier si l'utilisateur s'est bienconnecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header('Location: index.php'); // Dans le cas contraire, l'utilisateur sera redirigé vers la page de connexion
    exit();
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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>

<body>
    <h1>Bienvenue sur la page administrateur de l'atelier 3</h1>
    <h2>Vous avez visité la page <?= htmlspecialchars($_SESSION['count_visite']); ?></h2>
    <p>Vous êtes connecté en tant que : <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>

</html>