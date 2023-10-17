<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class ContactView 
{
    private $page;      // Attribut page

    /**
     * Constructeur de la classe ContactView
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
     * Affichage de la liste des enregistrements de la table 'mps_project_contact'
     */
    public function displayList($list)
    {
        $this->page .= "<h2 class='h2 text-center py-2 mb-5 mt-5 title'>Liste des informations de contacts</h2>";    // Ajout d'un titre à l'attribut page

        $tableau = '<div class="container-fluid col-4 mb-5 overflow-auto">';
        $tableau .= '<table class="table text-center">';
        $tableau .= '<tbody>';
        foreach($list as $element)  // Ajout de la liste
        {
            $tableau .= "<tr>";
            $tableau .= "<th>Société</th>";
            $tableau .= "<td>$element[1]</td>";

            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>Numéro</th>";
            $tableau .= "<td>$element[2]</td>";
            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>E-mail</th>";
            $tableau .= "<td>$element[3]</td>";
            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>Adresse</th>";
            $tableau .= "<td>$element[4]</td>";
            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>CP</th>";
            $tableau .= "<td>$element[5]</td>";
            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>Ville</th>";
            $tableau .= "<td>$element[6]</td>";
            $tableau .= "</tr>";
            $tableau .= "<tr>";
            $tableau .= "<th>Modifier</th>";
            // Ajout du bouton de modification
            $tableau .= "<td class='text-center'>
            <a href='index.php?controller=gerer&page=contact&action=update&id_contact=$element[0]&societe_contact=$element[1]&numero_contact=$element[2]&mail_contact=$element[3]&adresse_contact=$element[4]&cp_contact=$element[5]&ville_contact=$element[6]'
               title='Modifier'><i class=".'"fa-regular fa-pen-to-square h4 text-decoration-none text-primary"'."></i>
            </a></td>";
            $tableau .= "</tr>";
            

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
        // Choix du formulaire à afficher (formulaire contact ici)
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
        $this->page = str_replace("{id_contact}", $parameters['id_contact'], $this->page);
        $this->page = str_replace("{societe_contact}", $parameters['societe_contact'], $this->page);
        $this->page = str_replace("{numero_contact}", $parameters['numero_contact'], $this->page);
        $this->page = str_replace("{mail_contact}", $parameters['mail_contact'], $this->page);
        $this->page = str_replace("{adresse_contact}", $parameters['adresse_contact'], $this->page);
        $this->page = str_replace("{cp_contact}", $parameters['cp_contact'], $this->page);
        $this->page = str_replace("{ville_contact}", $parameters['ville_contact'], $this->page);
        // Bouton
        $this->page = str_replace("{bouton}", $parameters['bouton'], $this->page);

        $this->display();
    }

    /**
     * Préparation des paramètres du formulaire de modification 
     * de la table 'mps_project_contact'
     */
    public function displayUpdate($paramGet)
    {
        $parameters = array(
            "titre"=>"Modifier un tarif",
            "hide_tarifs_form"=>"hide_tarifs_form",
            "hide_contact_form"=>"0",
            "hide_clients_form"=>"hide_clients_form",
            "hide_animaux_form"=>"hide_animaux_form",
            "controller"=>"gerer",
            "page"=>"contact",
            "action"=>"update",
            "readonly"=>"",
            "id_contact"=>$paramGet['id_contact'],
            "societe_contact"=>$paramGet['societe_contact'],
            "numero_contact"=>$paramGet['numero_contact'],
            "mail_contact"=>$paramGet['mail_contact'],
            "adresse_contact"=>$paramGet['adresse_contact'],
            "cp_contact"=>$paramGet['cp_contact'],
            "ville_contact"=>$paramGet['ville_contact'],
            "bouton"=>"Modifier");
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