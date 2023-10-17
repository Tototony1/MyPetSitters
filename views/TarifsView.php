<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class TarifsView 
{
    private $page;      // Attribut page

    /**
     * Constructeur de la classe TarifsView
     */
    public function __construct()
    {
        $this->page = $this->searchHTML('header');                                                                                          // Intégration du 'header.html' à l'attribut page
        $this->page .= $this->searchHTML('nav');                                                                                            // Intégration de la 'nav.html' à l'attribut page
        $this->page .= "<li class='p-2'><a href='index.php?controller=gerer' class='p-2 border-rounded topNav'>Gérer</a></li>";             // Ajout du bouton 'Gérer' dans la navigation à l'attribut page
        $this->page .= "<li class='p-2'><a href='index.php?controller=logout' class='p-2 border-rounded topNav'>Se déconnecter</a></li>";   // Ajout du bouton 'Se déconnecter' dans la navigation à l'attribut page
        $this->page .= "<span id='burgerMenuButton' class='burger-menu-button'><i class='fa-solid fa-bars'></i></span>";                    // Ajout du bouton 'burger' dans la navigation à l'attribut page
        $this->page .= "</ul></nav></div>";                                                                                                 // Fermeture des balises HTML à l'attribut page
        $this->page .= $this->searchHTML('nav_mobile_full');                                                                                // Intégration du menu 'nav_mobile_full.html' à l'attribut page
        $this->page .= $this->searchHTML('admin_nav');                                                                                      // Intégration de la navigation administrateur 'admin_nav.html' à l'attribut page
    }

    /**
     * Affichage de la liste des enregistrements de la table 'mps_project_tarifs'
     */
    public function displayList($list)
    {
        $this->page .= "<h2 class='h2 text-center py-2 mb-5 mt-5 title'>Liste des tarifs</h2>";    // Ajout d'un titre à l'attribut page

        $tableau = '<div class="container col-11 overflow-auto mb-5">';
        $tableau .= '<div class="d-flex justify-content-center mb-4">
                        <a href="index.php?controller=gerer&page=tarifs&action=add" 
                           class="btn btn-primary addButton">Ajouter un tarif
                        </a>
                    </div>';
        $tableau .= '<table class="table text-center">';
        $tableau .= '<thead>';
        $tableau .= '<tr>
                        <th>ID</th>
                        <th>Temps</th>
                        <th>Famille d\'accueil</th>
                        <th>Promenades</th>
                        <th>À domicile</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>';
        $tableau .= '</thead>';
        $tableau .= '<tbody>';
        foreach($list as $element)  // Ajout de la liste
        {
            $tableau .= "<tr>";
            $tableau .= "<td>$element[0]</td>";
            $tableau .= "<td>$element[1]</td>";
            $tableau .= "<td>$element[2]</td>";
            $tableau .= "<td>$element[3]</td>";
            $tableau .= "<td>$element[4]</td>";
            
            // Ajout du bouton de modification
            $tableau .= "<td class='text-center'>
            <a href='index.php?controller=gerer&page=tarifs&action=update&id_tarifs=$element[0]&duree_tarifs=$element[1]&famille_accueil_tarifs=$element[2]&promenades_tarifs=$element[3]&a_domicile_tarifs=$element[4]'
               title='Modifier'><i class=".'"fa-regular fa-pen-to-square h4 text-decoration-none text-primary"'."></i>
            </a></td>";
            // Ajout du bouton de suppression
            $tableau .= "<td class='text-center'>
            <a href='index.php?controller=gerer&page=tarifs&action=delete&id_tarifs=$element[0]&duree_tarifs=$element[1]&famille_accueil_tarifs=$element[2]&promenades_tarifs=$element[3]&a_domicile_tarifs=$element[4]'
               title='Supprimer'><i class=".'"fa-regular fa-trash-can h4 text-decoration-none text-danger"'."></i>
            </a></td></tr>";                
        }
        $tableau .= "</tbody></table></div>";
        $this->page .= $tableau;
        
        $this->display();
    }
    
    /**
     * Affichage du formulaire et remplacement des valeurs modulables.
     */
    public function displayForm($parameters) 
    {   
        // Récupération du contenu admin_forms.php
        $this->page .= $this->searchHTML('admin_forms');

        // Paramétrage du titre 
        $this->page = str_replace("{titre}", $parameters['titre'], $this->page);
        // Choix du formulaire à afficher (formulaire tarifs ici)
        $this->page = str_replace("{hide_tarifs_form}", $parameters['hide_tarifs_form'], $this->page);
        $this->page = str_replace("{hide_contact_form}", $parameters['hide_contact_form'], $this->page);
        $this->page = str_replace("{hide_clients_form}", $parameters['hide_clients_form'], $this->page);
        $this->page = str_replace("{hide_animaux_form}", $parameters['hide_animaux_form'], $this->page);
        // Paramétrage de l'action
        $this->page = str_replace("{controller}", $parameters['controller'], $this->page);
        $this->page = str_replace("{page}", $parameters['page'], $this->page);
        $this->page = str_replace("{action}", $parameters['action'], $this->page);
        // Paramétrage du readonly
        $this->page = str_replace("{readonly}", $parameters['readonly'], $this->page);
        // Valeurs formulaire
        $this->page = str_replace("{id_tarifs}", $parameters['id_tarifs'], $this->page);
        $this->page = str_replace("{duree_tarifs}", $parameters['duree_tarifs'], $this->page);
        $this->page = str_replace("{famille_accueil_tarifs}", $parameters['famille_accueil_tarifs'], $this->page);
        $this->page = str_replace("{promenades_tarifs}", $parameters['promenades_tarifs'], $this->page);
        $this->page = str_replace("{a_domicile_tarifs}", $parameters['a_domicile_tarifs'], $this->page);
        // Bouton
        $this->page = str_replace("{bouton}", $parameters['bouton'], $this->page);

        $this->display();
    }

    /**
     * Préparation des paramètres du formulaire d'ajout 
     * de la table 'mps_project_tarifs'
     */
    public function displayAdd()
    {
        $parameters = array(
            "titre"=>"Ajouter un tarif",
            "hide_tarifs_form"=>"",
            "hide_contact_form"=>"hide_contact_form",
            "hide_clients_form"=>"hide_clients_form",
            "hide_animaux_form"=>"hide_animaux_form",
            "controller"=>"gerer",
            "page"=>"tarifs",
            "action"=>"add",
            "readonly"=>"",
            "id_tarifs"=>"",
            "duree_tarifs"=>"",
            "famille_accueil_tarifs"=>"",
            "promenades_tarifs"=>"",
            "a_domicile_tarifs"=>"",
            "bouton"=>"Ajouter");
        $this->displayForm($parameters);
    }

    /**
     * Préparation des paramètres du formulaire de modification 
     * de la table 'mps_project_tarifs'
     */
    public function displayUpdate($paramGet)
    {
        $parameters = array(
            "titre"=>"Modifier un tarif",
            "hide_tarifs_form"=>"",
            "hide_contact_form"=>"hide_contact_form",
            "hide_clients_form"=>"hide_clients_form",
            "hide_animaux_form"=>"hide_animaux_form",
            "controller"=>"gerer",
            "page"=>"tarifs",
            "action"=>"update",
            "readonly"=>"",
            "id_tarifs"=>$paramGet['id_tarifs'],
            "duree_tarifs"=>$paramGet['duree_tarifs'],
            "famille_accueil_tarifs"=>$paramGet['famille_accueil_tarifs'],
            "promenades_tarifs"=>$paramGet['promenades_tarifs'],
            "a_domicile_tarifs"=>$paramGet['a_domicile_tarifs'],
            "bouton"=>"Modifier");
        $this->displayForm($parameters);
    }

    /**
     * Préparation des paramètres du formulaire de suppression 
     * de la table 'mps_project_tarifs'
     */
    public function displayDelete($paramGet)
    {
        $parameters = array(
            "titre"=>"Supprimer un tarif",
            "hide_tarifs_form"=>"",
            "hide_contact_form"=>"hide_contact_form",
            "hide_clients_form"=>"hide_clients_form",
            "hide_animaux_form"=>"hide_animaux_form",
            "controller"=>"gerer",
            "page"=>"tarifs",
            "action"=>"delete",
            "readonly"=>"readonly",
            "id_tarifs"=>$paramGet['id_tarifs'],
            "duree_tarifs"=>$paramGet['duree_tarifs'],
            "famille_accueil_tarifs"=>$paramGet['famille_accueil_tarifs'],
            "promenades_tarifs"=>$paramGet['promenades_tarifs'],
            "a_domicile_tarifs"=>$paramGet['a_domicile_tarifs'],
            "bouton"=>"Supprimer");
        $this->displayForm($parameters);
    }

    /**
     * Affichage du footer et de l'attribut $page
     */
    public function display()
    {
        $this->page .= $this->searchHTML('footer');
        echo $this->page;
    }

    /**
     * Récupération contenu html
     */
    public function searchHTML($file)
    {
        $content = file_get_contents("html/".$file.".html");
        return $content;
    }
}