<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

include('views/UsersView.php');     // Appel de la classe UsersView
include('models/UsersModel.php');   // Appel de la classe UsersModel

class Dispatcher
{
    private $getController; // Attribut getController
    private $view;          // Attribut view
    private $model;         // Attribut model
    private $paramGet;      // Attribut paramGet

    /**
     * Chargement du constructeur de la classe Dispatcher
     */
    public function __construct()
    { 
        $this->view = new UsersView();                                                      // Instanciation de la classe UsersView
        $this->model = new UsersModel();                                                    // Instanciation de la classe UsersModel
        $this->getController = isset($_GET['controller'])?$_GET['controller']:'home';       // Récupération du paramètre controller choisi
        $this->paramGet = array('action'=>isset($_GET['action'])?$_GET['action']:'list');   // Récupération de l'action 'list'
    }
    /**
     * Changement de page et exécution du contrôleur adéquat
     */
    public function router()
    {
        /* ----------------------------------- Partie utilisateur ----------------------------------- */

        switch ($this->getController) {
            // Page d'accueil
            case 'home':
                $this->view->displayHomePage();         // Affichage de la page d'accueil
                break;
            // Page tarifs
            case 'tarifs':
                $list = $this->model->getTarifsList();  // Récupération des informations pour la page Nos tarifs
                $this->view->displayTarifsPage($list);  // Affichage de la page Nos tarifs
                break;
            // Page traitement devis
            case 'devis_traitement':
                include('devis_traitement.php');        // Inclusion du fichier devis_traitement.php
                break;
            // Page contact
            case 'contact':
                $list = $this->model->getContactList(); // Récupération des informations pour la page Contact
                $this->view->displayContactPage($list); // Affichage de la page d'accueil
                break;
            // Page témoignages
            case 'faq':
                $this->view->displayFAQPage();          // Affichage de la page FAQ
                break;
            // Page de la carte du site
            case 'siteMap':
                $this->view->displaySiteMapPage();      // Affichage de la page Site map
                break;
            // Page des CGU
            case 'CGU':
                $this->view->displayCGUPage();          // Affichage de la page CGU
                break;
            // Page connexion
            case 'mps_admin':
                $this->view->displayAdminConnection();  // Affichage de la page de connexion à l'espace administrateur
                break;
                
            }
        
        /* ----------------------------------- Partie administrateur ----------------------------------- */

        if (isset($_SESSION['username'])) {                     // Vérifie si l'utilisateur est connecté
            define('SESSION_TIMEOUT', 900);                     // Durée de la session en seconde (ici 15 min)
            
            // Test de la variable time() avec la constante SESSION_TIMEOUT prédéfinie
            if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
                session_unset();                                // Destruction des variables de la session en cours
                session_destroy();                              // Destruction des données de la session en cours
                header("Location: index.php?controller=home");  // Redirection vers la page d'accueil du site après expiration de la session
                exit();
            } else {
                $_SESSION['last_activity'] = time();
            }
            switch ($this->getController) {                     // Pages affichées seulement si connecté
                // Page gérer
                case 'gerer':
                    include('controllers/AdminController.php'); // Inclusion du fichier AdminController.php
                    $adminController = new AdminController();   // Instanciation de la classe AdminController
                    $adminController->dispatch();               // Exécution de la méthode dispatch de la classe AdminController
                    break;
                // Page de déconnexion
                case 'logout':
                    include('logout.php');                      // Inclusion du fichier de déconnexion logout.php
                    break;
                } 
        }
    }
}