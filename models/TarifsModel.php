<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class TarifsModel
{
    private $connexion; // Attribut connexion
    private $requete;   // Attribut requete

    /**
     * Constructeur de la classe TarifsModel
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
     * Retourne la liste des enregistrements de la table 'mps_project_tarifs'
     */
    public function getList($action)
    {
        $this->requete = "SELECT * FROM mps_project_tarifs";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }

    /**
     * Ajoute une donnée dans la table 'mps_project_tarifs'
     */
    public function add($paramForm)
    {
        try {
            $sql = "INSERT INTO mps_project_tarifs (id_tarifs, duree_tarifs, famille_accueil_tarifs, promenades_tarifs, a_domicile_tarifs) VALUES (?,?,?,?,?)";
            $this->requete = $this->connexion->prepare($sql);

            $this->requete->bindValue(1, NULL, PDO::PARAM_INT);
            $this->requete->bindValue(2, $paramForm['duree_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['famille_accueil_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['promenades_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['a_domicile_tarifs'], PDO::PARAM_STR);
    
            $resultat = $this->requete->execute(array(NULL, $paramForm['duree_tarifs'], $paramForm['famille_accueil_tarifs'], $paramForm['promenades_tarifs'], $paramForm['a_domicile_tarifs']));
        } catch (Exception $e) {
            echo 'Erreur : '. $e->getMessage();
        }
    }

    /**
     * Met à jour les données d'un enregistrement dans la table 'mps_project_tarifs'
     */
    public function update($paramForm)
    {
        try {
            $sql = "UPDATE mps_project_tarifs SET duree_tarifs=?, famille_accueil_tarifs=?, promenades_tarifs=?, a_domicile_tarifs=?  WHERE id_tarifs=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['duree_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(2, $paramForm['famille_accueil_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['promenades_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['a_domicile_tarifs'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['id_tarifs'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['duree_tarifs'], $paramForm['famille_accueil_tarifs'], $paramForm['promenades_tarifs'], $paramForm['a_domicile_tarifs'],$paramForm['id_tarifs']));

        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Supprime un enregistrement dans la table 'mps_project_tarifs'
     */
    public function delete($paramForm)
    {
        try {
            $sql = "DELETE FROM mps_project_tarifs WHERE id_tarifs=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['id_tarifs'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['id_tarifs']));
        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}