<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est bien en possession d'un cookie valide
// Dans le cas contraire il sera redirigé vers la page d'accueil de connexion
if (!isset($_COOKIE['authToken']) && !str_starts_with($_COOKIE['authToken'], 'user_')) {
    header('Location: index.php');
    exit();
}
echo "page utilisateur";
