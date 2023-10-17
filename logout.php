<?php 

session_unset();                                // Destruction des variables de la session courante
session_destroy();                              // Destruction des données liés à la session courante
header("Location: index.php?controller=home");  // Redirection de l'utilisateur vers la page d'accueil du site
exit();