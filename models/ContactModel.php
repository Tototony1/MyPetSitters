<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class ContactModel
{
    private $connexion; // Attribut connexion
    private $requete;   // Attribut requete

    /**
     * Constructeur de la classe ContactModel
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
     * Retourne la liste des enregistrements de la table 'mps_project_contact'
     */
    public function getList($action)
    {
        $this->requete = "SELECT * FROM mps_project_contact";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }

    /**
     * Met à jour les données d'un enregistrement dans la table 'mps_project_contact'
     */
    public function update($paramForm)
    {
        try {
            $sql = "UPDATE mps_project_contact SET societe_contact=?, numero_contact=?, mail_contact=?, adresse_contact=?, cp_contact=?, ville_contact=?  WHERE id_contact=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['societe_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(2, $paramForm['numero_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['mail_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['adresse_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['cp_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(6, $paramForm['ville_contact'], PDO::PARAM_STR);
            $this->requete->bindValue(7, $paramForm['id_contact'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['societe_contact'], $paramForm['numero_contact'], $paramForm['mail_contact'], $paramForm['adresse_contact'], $paramForm['cp_contact'], $paramForm['ville_contact'], $paramForm['id_contact']));

        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

}