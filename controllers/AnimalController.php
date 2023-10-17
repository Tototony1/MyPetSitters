<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('models/AnimalModel.php');  // Inclusion du fichier AnimalModel.php
include('views/AnimalView.php');    // Inclusion du fichier AnimalView.php
class AnimalController
{
    private $model;         // Attribut model
    private $view;          // Attribut view
    private $paramGet;      // Attribut paramGet
    private $paramPost;     // Attribut paramPost

    /**
     * Constructeur de la classe AnimalController
     */
    public function __construct() 
    {
        $this->model = new AnimalModel();       // Instanciation de la classe AnimalModel 
        $this->view = new AnimalView;           // Instanciation de la classe AnimalView

        $this->paramGet = array(                // Récupération des attributs avec la méthode GET
            'action'=>isset($_GET['action'])?$_GET['action']:'list',
            'id_animal'=>isset($_GET['id_animal'])?$_GET['id_animal']:null,
            'nom_animal'=>isset($_GET['nom_animal'])?$_GET['nom_animal']:null,
            'age_animal'=>isset($_GET['age_animal'])?$_GET['age_animal']:null,
            'taille_animal'=>isset($_GET['taille_animal'])?$_GET['taille_animal']:null,
            'race_animal'=>isset($_GET['race_animal'])?$_GET['race_animal']:null,
            'particularite_animal'=>isset($_GET['particularite_animal'])?$_GET['particularite_animal']:null,
            'id_clients'=>isset($_GET['id_clients'])?$_GET['id_clients']:null);

        $this->paramPost = array(               // Récupération des attributs avec la méthode POST
            'action'=>isset($_POST['action'])?$_POST['action']:'list',
            'id_animal'=>isset($_POST['id_animal'])?$_POST['id_animal']:null,
            'nom_animal'=>isset($_POST['nom_animal'])?$_POST['nom_animal']:null,
            'age_animal'=>isset($_POST['age_animal'])?$_POST['age_animal']:null,
            'taille_animal'=>isset($_POST['taille_animal'])?$_POST['taille_animal']:null,
            'race_animal'=>isset($_POST['race_animal'])?$_POST['race_animal']:null,
            'particularite_animal'=>isset($_POST['particularite_animal'])?$_POST['particularite_animal']:null,
            'id_clients'=>isset($_POST['id_clients'])?$_POST['id_clients']:null);
    }

    /**
     * Changement d'action et exécution des classes AnimalModel et AnimalView
     */
    public function dispatch()
    {
        switch ($this->paramGet['action']) {
            case 'list':
                $list = $this->model->getList($this->paramGet['action']);   // Récupère les données de la table 'mps_project_animal'
                $this->view->displayList($list);                            // Affiche ces données sur la page
                break;
            case 'add':
                $this->view->displayAdd();                                  // Affiche le formulaire d'ajout d'un animal
                $this->model->add($this->paramPost);                        // Récupère les données du formulaire et les ajoute à la table 'mps_project_animal'
                break;
            case 'update':
                $this->view->displayUpdate($this->paramGet);                // Affiche le formulaire de modification d'un animal
                $this->model->update($this->paramPost);                     // Récupère les données du formulaire et les modifie dans la table 'mps_project_animal'
                break;
            case 'delete':
                $this->view->displayDelete($this->paramGet);                // Affiche le formulaire de suppression d'un animal
                $this->model->delete($this->paramPost);                     // Récupère les données du formulaire et les supprime de la table 'mps_project_animal'
                break;
        }
    }
}