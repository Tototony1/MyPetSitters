<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('Dispatcher.php');      // Inclusion du fichier Dispatcher.php
$router = new Dispatcher();     // Instanciation de la classe Dispatcher
$router->router();              // Exécution de la méthode router de la classe Dispatcher
