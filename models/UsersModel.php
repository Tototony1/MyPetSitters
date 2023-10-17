<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class UsersModel
{
    private $connexion; // Attributs connexion
    private $requete;   // Attributs requete

    /**
     * Constructeur de la classe UsersModel
     */
    public function __construct()
    {
        // Connexion à la BDD
/*         define('SERVER' ,"sqlprive-pc2372-001.eu.clouddb.ovh.net:35167");
        define('USER' ,"cefiidev1265");
        define('PASSWORD' ,"n4M9ui5Y");
        define('BASE' ,"cefiidev1265"); */
        define('SERVER' ,"localhost");          // Définition de la constante 'SERVER'
        define('USER' ,"root");                 // Définition de la constante 'USER'
        define('PASSWORD' ,"");                 // Définition de la constante 'PASSWORD'
        define('BASE' ,"MyPetSitters");         // Définition de la constante 'BASE'
        
        try
        {
            $this->connexion = new PDO("mysql:host=".SERVER.";dbname=".BASE, USER, PASSWORD);   // Instanciation de la classe PDO et connexion à la BDD
        }
        catch (Exception $e)
        {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Retourne la liste des enregistrements de la table 'mps_project_tarifs'
     */
    public function getTarifsList()
    {
        $this->requete = "SELECT * FROM mps_project_tarifs";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }
    /**
     * Retourne la liste des enregistrements de la table 'mps_project_contact'
     */
    public function getContactList()
    {
        $this->requete = "SELECT * FROM mps_project_contact";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }
}