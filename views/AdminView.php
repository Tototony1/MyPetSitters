<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class AdminView 
{
    private $page;      // Attribut page

    /**
     * Constructeur de la classe AdminView
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
     * Affichage de la page administrateur 'Comment ça marche ?'
     */
    public function displayCCMPage()
    {
        $this->page .= $this->searchHTML('ccm');
        $this->display();
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
     * Récupération des contenus html
     */
    public function searchHTML($file)
    {
        $content = file_get_contents("html/".$file.".html");
        return $content;
    }
}