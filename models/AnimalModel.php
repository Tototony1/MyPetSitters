<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class AnimalModel
{
    private $connexion; // Attribut connexion
    private $requete;   // Attribut requete

    /**
     * Constructeur de la classe AnimalModel
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
     * Retourne la liste des enregistrements de la table 'mps_project_animal'
     */
    public function getList($action)
    {
        $this->requete = "SELECT * FROM mps_project_animal";
        $resultat = $this->connexion->query($this->requete);
        $list = $resultat->fetchAll(PDO::FETCH_NUM);
        return $list;
    }

    /**
     * Ajoute une donnée dans la table 'mps_project_animal'
     */
    public function add($paramForm)
    {
        try {
            $sql = "INSERT INTO mps_project_animal (id_animal, nom_animal, age_animal, taille_animal, race_animal, particularite_animal, id_clients) VALUES (?,?,?,?,?,?,?)";
            $this->requete = $this->connexion->prepare($sql);

            $this->requete->bindValue(1, NULL, PDO::PARAM_INT);
            $this->requete->bindValue(2, $paramForm['nom_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['age_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['taille_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['race_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(6, $paramForm['particularite_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(7, $paramForm['id_clients'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array(NULL, $paramForm['nom_animal'], $paramForm['age_animal'], $paramForm['taille_animal'], $paramForm['race_animal'], $paramForm['particularite_animal'], $paramForm['id_clients']));
        } catch (Exception $e) {
            echo 'Erreur : '. $e->getMessage();
        }
    }

    /**
     * Met à jour les données d'un enregistrement dans la table 'mps_project_animal'
     */
    public function update($paramForm)
    {
        try {
            $sql = "UPDATE mps_project_animal SET nom_animal=?, age_animal=?, taille_animal=?, race_animal=?, particularite_animal=?, id_clients=?  WHERE id_animal=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['nom_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(2, $paramForm['age_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(3, $paramForm['taille_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(4, $paramForm['race_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(5, $paramForm['particularite_animal'], PDO::PARAM_STR);
            $this->requete->bindValue(6, $paramForm['id_clients'], PDO::PARAM_STR);
            $this->requete->bindValue(7, $paramForm['id_animal'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['nom_animal'], $paramForm['age_animal'], $paramForm['taille_animal'], $paramForm['race_animal'], $paramForm['particularite_animal'], $paramForm['id_clients'] , $paramForm['id_animal']));

        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Supprime un enregistrement dans la table 'mps_project_animal'
     */
    public function delete($paramForm)
    {
        try {
            $sql = "DELETE FROM mps_project_animal WHERE id_animal=?";
            $this->requete = $this->connexion->prepare($sql);
    
            $this->requete->bindValue(1, $paramForm['id_animal'], PDO::PARAM_INT);
    
            $resultat = $this->requete->execute(array($paramForm['id_animal']));
        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}