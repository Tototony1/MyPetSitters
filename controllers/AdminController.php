<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


include('views/AdminView.php');     // Inclusion du fichier AdminView.php
class AdminController
{
    private $page;      // Attribut page
    private $view;      // Attribut view

    /**
     * Constructeur de la classe AdminController
     */
    public function __construct() 
    {
        
        $this->view = new AdminView();                          // Instanciation de la classe AdminView
        
        $this->page = array(
            'page'=>isset($_GET['page'])?$_GET['page']:'ccm',   // Récupération de l'attribut 'page'
        );
    }

    /**
     * Changement d'action et exécution des classes Model et View
     */
    public function dispatch()
    {
        switch ($this->page['page']) {                          // Switch sur l'attribut 'page' récupéré
            case 'ccm':
                $this->view->displayCCMPage();                  // Affichage de la page 'Comment ca marche ?'
                break;
            case 'tarifs':
                include('TarifsController.php');                // Inclusion du fichier controller de 'Page tarifs'
                $tarifsController = new TarifsController();
                $tarifsController->dispatch();
                break;
            case 'contact':
                include('ContactController.php');               // Inclusion du fichier controller de 'Page contact'
                $contactController = new ContactController();
                $contactController->dispatch();
                break;
            case 'clients':
                include('ClientsController.php');               // Inclusion du fichier controller de 'Gestion clients'
                $clientsController = new ClientsController();
                $clientsController->dispatch();
                break;
            case 'animaux':
                include('AnimalController.php');                // Inclusion du fichier controller de 'Gestion animaux'
                $animalController = new AnimalController();
                $animalController->dispatch();
                break;
        }
    }
}