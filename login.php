<?php
session_start();

$_SESSION['last_activity'] = time();    // Assignation de la valeur de time() à $_SESSION['last_activity']

// Connexion à la BDD
/* define('SERVER' ,"sqlprive-pc2372-001.eu.clouddb.ovh.net:35167");
define('USER' ,"cefiidev1265");
define('PASSWORD' ,"n4M9ui5Y");
define('BASE' ,"cefiidev1265"); */

/* define('SERVER' ,"localhost");
define('USER' ,"root");
define('PASSWORD' ,"");
define('BASE' ,"mypetsitters"); */

try {
    $connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);   // Connexion à la base de données avec la classe PDO
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}

$query = "SELECT username, password FROM mps_project_admin_access WHERE id=1";

try {
    $stmt = $connexion->query($query);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Vérification du mot de passe et de l'identifiant saisi avec password_verify()
        if (password_verify($_POST['password'], $admin['password']) && password_verify($_POST['username'], $admin['username'])) {  
            $_SESSION['username'] = $admin['username'];
            $_SESSION['loggedin'] = true;
            header("Location: index.php?controller=gerer");
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Identifiant administrateur non trouvé.";
    }
} catch(PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    exit();
}