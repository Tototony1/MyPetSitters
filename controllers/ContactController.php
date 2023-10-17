<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('models/ContactModel.php');     // Inclusion du fichier ContactModel.php
include('views/ContactView.php');       // Inclusion du fichier ContactView.php
class ContactController
{
    private $model;         // Attribut model
    private $view;          // Attribut view
    private $paramGet;      // Attribut paramGet
    private $paramPost;     // Attribut paramPost

    /**
     * Constructeur de la classe ContactController
     */
    public function __construct() 
    {
        $this->model = new ContactModel();      // Instanciation de la classe ContactModel
        $this->view = new ContactView;          // Instanciation de la classe ContactView

        $this->paramGet = array(                // Récupération des attributs avec la méthode GET
            'action'=>isset($_GET['action'])?$_GET['action']:'list',
            'id_contact'=>isset($_GET['id_contact'])?$_GET['id_contact']:null,
            'societe_contact'=>isset($_GET['societe_contact'])?$_GET['societe_contact']:null,
            'numero_contact'=>isset($_GET['numero_contact'])?$_GET['numero_contact']:null,
            'mail_contact'=>isset($_GET['mail_contact'])?$_GET['mail_contact']:null,
            'adresse_contact'=>isset($_GET['adresse_contact'])?$_GET['adresse_contact']:null,
            'cp_contact'=>isset($_GET['cp_contact'])?$_GET['cp_contact']:null,
            'ville_contact'=>isset($_GET['ville_contact'])?$_GET['ville_contact']:null);

        $this->paramPost = array(                // Récupération des attributs avec la méthode POST
            'action'=>isset($_POST['action'])?$_POST['action']:'list',
            'id_contact'=>isset($_POST['id_contact'])?$_POST['id_contact']:null,
            'societe_contact'=>isset($_POST['societe_contact'])?$_POST['societe_contact']:null,
            'numero_contact'=>isset($_POST['numero_contact'])?$_POST['numero_contact']:null,
            'mail_contact'=>isset($_POST['mail_contact'])?$_POST['mail_contact']:null,
            'adresse_contact'=>isset($_POST['adresse_contact'])?$_POST['adresse_contact']:null,
            'cp_contact'=>isset($_POST['cp_contact'])?$_POST['cp_contact']:null,
            'ville_contact'=>isset($_POST['ville_contact'])?$_POST['ville_contact']:null);
    }

    /**
     * Changement d'action et exécution des classes ContactModel et ContactView
     */
    public function dispatch()
    {
        switch ($this->paramGet['action']) {
            case 'list':
                $list = $this->model->getList($this->paramGet['action']);   // Récupère les données de la table 'mps_project_contact'
                $this->view->displayList($list);                            // Affiche ces données sur la page
                break;
            case 'update':
                $this->view->displayUpdate($this->paramGet);                // Affiche le formulaire de modification de la page contact
                $this->model->update($this->paramPost);                     // Récupère les données du formulaire et les modifie dans la table 'mps_project_contact'
                break;
        }
    }
}