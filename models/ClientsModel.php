<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class ClientsModel
{
    private $connexion; // Attribut connexion
    private $requete;   // Attribut requete

    /**
     * Constructeur de la classe ClientsModel
     */
    public function __construct()
    {
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
     * Retourne la liste des enregistrements de la table 'mps_project_clients'
     */
    public function getList($action)
    {
        $this->requete = "SELECT * FROM mps_project_clients";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }

    /**
     * Ajoute une donnée dans la table 'mps_project_clients'
     */
    public function add($paramForm)
    {
        try {
            $sql = "INSERT INTO mps_project_clients (id_clients, nom_clients, prenom_clients, num_clients, mail_clients, adresse_clients, liste_animal_clients) VALUES (?,?,?,?,?,?,?)";
            $this->requete = $this->connexion->prepare($sql);

            $this->requete->bindValue(1, NULL, PDO::PARAM_INT);
            $this->requete->bindValue(2, $paramForm['nom_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['prenom_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['num_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['mail_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(6, $paramForm['adresse_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(7, $paramForm['liste_animal_clients'], PDO::PARAM_STR);
    
            $resultat = $this->requete->execute(array(NULL, $paramForm['nom_clients'], $paramForm['prenom_clients'], $paramForm['num_clients'], $paramForm['mail_clients'], $paramForm['adresse_clients'], $paramForm['liste_animal_clients']));
        } catch (Exception $e) {
            echo 'Erreur : '. $e->getMessage();
        }
    }

    /**
     * Met à jour les données d'un enregistrement dans la table 'mps_project_clients'
     */
    public function update($paramForm)
    {
        try {
            $sql = "UPDATE mps_project_clients SET nom_clients=?, prenom_clients=?, num_clients=?, mail_clients=?, adresse_clients=?, liste_animal_clients=?  WHERE id_clients=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['nom_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(2, $paramForm['prenom_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['num_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['mail_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['adresse_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(6, $paramForm['liste_animal_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(7, $paramForm['id_clients'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['nom_clients'], $paramForm['prenom_clients'], $paramForm['num_clients'], $paramForm['mail_clients'], $paramForm['adresse_clients'], $paramForm['liste_animal_clients'], $paramForm['id_clients']));

        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Supprime un enregistrement dans la table 'mps_project_clients'
     */
    public function delete($paramForm)
    {
        try {
            $sql = "DELETE FROM mps_project_clients WHERE id_clients=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['id_clients'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['id_clients']));
        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}