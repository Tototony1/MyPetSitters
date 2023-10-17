<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('models/ClientsModel.php');     // Inclusion du fichier ClientsModel.php
include('views/ClientsView.php');       // Inclusion du fichier ClientsView.php
class ClientsController
{
    private $model;         // Attribut model
    private $view;          // Attribut view
    private $paramGet;      // Attribut paramGet
    private $paramPost;     // Attribut paramPost

    /**
     * Constructeur de la classe ClientsController
     */
    public function __construct() 
    {
        $this->model = new ClientsModel();      // Instanciation de la classe ClientsModel
        $this->view = new ClientsView;          // Instanciation de la classe ClientsView

        $this->paramGet = array(                // Récupération des attributs avec la méthode GET
            'action'=>isset($_GET['action'])?$_GET['action']:'list',
            'id_clients'=>isset($_GET['id_clients'])?$_GET['id_clients']:null,
            'nom_clients'=>isset($_GET['nom_clients'])?$_GET['nom_clients']:null,
            'prenom_clients'=>isset($_GET['prenom_clients'])?$_GET['prenom_clients']:null,
            'num_clients'=>isset($_GET['num_clients'])?$_GET['num_clients']:null,
            'mail_clients'=>isset($_GET['mail_clients'])?$_GET['mail_clients']:null,
            'adresse_clients'=>isset($_GET['adresse_clients'])?$_GET['adresse_clients']:null,
            'liste_animal_clients'=>isset($_GET['liste_animal_clients'])?$_GET['liste_animal_clients']:null);

        $this->paramPost = array(               // Récupération des attributs avec la méthode POST
            'action'=>isset($_POST['action'])?$_POST['action']:'list',
            'id_clients'=>isset($_POST['id_clients'])?$_POST['id_clients']:null,
            'nom_clients'=>isset($_POST['nom_clients'])?$_POST['nom_clients']:null,
            'prenom_clients'=>isset($_POST['prenom_clients'])?$_POST['prenom_clients']:null,
            'num_clients'=>isset($_POST['num_clients'])?$_POST['num_clients']:null,
            'mail_clients'=>isset($_POST['mail_clients'])?$_POST['mail_clients']:null,
            'adresse_clients'=>isset($_POST['adresse_clients'])?$_POST['adresse_clients']:null,
            'liste_animal_clients'=>isset($_POST['liste_animal_clients'])?$_POST['liste_animal_clients']:null);
    }

    /**
     * Changement d'action et exécution des classes ClientsModel et ClientsView
     */
    public function dispatch()
    {
        switch ($this->paramGet['action']) {
            case 'list':
                $list = $this->model->getList($this->paramGet['action']);   // Récupère les données de la table 'mps_project_clients'
                $this->view->displayList($list);                            // Affiche ces données sur la page
                break;
            case 'add':
                $this->view->displayAdd();                                  // Affiche le formulaire d'ajout d'un client
                $this->model->add($this->paramPost);                        // Récupère les données du formulaire et les ajoute à la table 'mps_project_clients'
                break;
            case 'update':
                $this->view->displayUpdate($this->paramGet);                // Affiche le formulaire de modification d'un client
                $this->model->update($this->paramPost);                     // Récupère les données du formulaire et les modifie dans la table 'mps_project_clients'
                break;
            case 'delete':
                $this->view->displayDelete($this->paramGet);                // Affiche le formulaire de suppression d'un client
                $this->model->delete($this->paramPost);                     // Récupère les données du formulaire et les supprime de la table 'mps_project_clients'
                break;
        }
    }
}