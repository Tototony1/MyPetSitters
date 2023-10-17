<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('models/TarifsModel.php');      // Inclusion du fichier TarifsModel.php
include('views/TarifsView.php');        // Inclusion du fichier TarifsView.php
class TarifsController
{
    private $model;         // Attribut model
    private $view;          // Attribut view
    private $paramGet;      // Attribut paramGet
    private $paramPost;     // Attribut paramPost

    /**
     * Constructeur de la classe TarifsController
     */
    public function __construct() 
    {
        $this->model = new TarifsModel();   // Instanciation de la classe TarifsModel
        $this->view = new TarifsView;       // Instanciation de la classe TarifsView

        $this->paramGet = array(                // Récupération des attributs avec la méthode GET
            'action'=>isset($_GET['action'])?$_GET['action']:'list',
            'id_tarifs'=>isset($_GET['id_tarifs'])?$_GET['id_tarifs']:null,
            'duree_tarifs'=>isset($_GET['duree_tarifs'])?$_GET['duree_tarifs']:null,
            'famille_accueil_tarifs'=>isset($_GET['famille_accueil_tarifs'])?$_GET['famille_accueil_tarifs']:null,
            'promenades_tarifs'=>isset($_GET['promenades_tarifs'])?$_GET['promenades_tarifs']:null,
            'a_domicile_tarifs'=>isset($_GET['a_domicile_tarifs'])?$_GET['a_domicile_tarifs']:null);

        $this->paramPost = array(               // Récupération des attributs avec la méthode POST
            'action'=>isset($_POST['action'])?$_POST['action']:'list',
            'id_tarifs'=>isset($_POST['id_tarifs'])?$_POST['id_tarifs']:null,
            'duree_tarifs'=>isset($_POST['duree_tarifs'])?$_POST['duree_tarifs']:null,
            'famille_accueil_tarifs'=>isset($_POST['famille_accueil_tarifs'])?$_POST['famille_accueil_tarifs']:null,
            'promenades_tarifs'=>isset($_POST['promenades_tarifs'])?$_POST['promenades_tarifs']:null,
            'a_domicile_tarifs'=>isset($_POST['a_domicile_tarifs'])?$_POST['a_domicile_tarifs']:null);
    }

    /**
     * Changement d'action et exécution des classes TarifsModel et TarifsView
     */
    public function dispatch()
    {
        switch ($this->paramGet['action']) {
            case 'list':
                $list = $this->model->getList($this->paramGet['action']);   // Récupère les données de la table 'mps_project_tarifs'
                $this->view->displayList($list);                            // Affiche ces données sur la page
                break;
            case 'add':
                $this->view->displayAdd();                                  // Affiche le formulaire d'ajout d'un tarif
                $this->model->add($this->paramPost);                        // Récupère les données du formulaire et les ajoute à la table 'mps_project_tarifs'
                break;
            case 'update':
                $this->view->displayUpdate($this->paramGet);                // Affiche le formulaire de modification d'un tarif
                $this->model->update($this->paramPost);                     // Récupère les données du formulaire et les modifie dans la table 'mps_project_tarifs'
                break;
            case 'delete':
                $this->view->displayDelete($this->paramGet);                // Affiche le formulaire de suppression d'un tarif
                $this->model->delete($this->paramPost);                     // Récupère les données du formulaire et les supprime de la table 'mps_project_tarifs'
                break;
        }
    }
}