<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

class UsersView 
{
    private $page;  // Attribut page

    /**
     * Constructeur de la classe UsersView
     */
    public function __construct()
    {
        $this->page = $this->searchHTML('header');                                                                                                              // Intégration du 'header.html' à l'attribut page
        $this->page .= $this->searchHTML('nav');                                                                                                                // Intégration du 'nav.html' à l'attribut page

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {                                                                                   // Vérifie si l'utilisateur est connecté
            $this->page .= "<li class='p-2'><a href='index.php?controller=gerer' class='p-2 border-rounded topNav'>Gérer</a></li>";                             // Ajout du bouton 'Gérer' dans la navigation à l'attribut page
            $this->page .= "<li class='p-2'><a href='index.php?controller=logout' class='p-2 border-rounded topNav' id='logoutButton'>Se déconnecter</a></li>"; // Ajout du bouton 'Se déconnecter' dans la navigation à l'attribut page
            $this->page .= "<span id='burgerMenuButton' class='burger-menu-button'><i class='fa-solid fa-bars'></i></span>";                                    // Ajout du bouton 'burger' dans la navigation à l'attribut page
            $this->page .= "</ul></nav></div>";                                                                                                                 // Fermeture des balises HTML à l'attribut page
            $this->page .= $this->searchHTML('nav_mobile_full');                                                                                                // Intégration du menu 'nav_mobile_full.html' à l'attribut page
        } else {
            $this->page .= "<span id='burgerMenuButton' class='burger-menu-button'><i class='fa-solid fa-bars'></i></span>";                                    // Ajout du bouton 'burger' dans la navigation à l'attribut page
            $this->page .= "</ul></nav></div>";                                                                                                                 // Fermeture des balises HTML à l'attribut page
            $this->page .= $this->searchHTML('nav_mobile');                                                                                                     // Intégration de la navigation administrateur 'admin_nav.html' à l'attribut page
        }
    }

    /**
     * Affichage de la page d'accueil
     */
    public function displayHomePage()
    {
        $this->page .= $this->searchHTML('home');            // Intégration du 'home.html' à l'attribut page
        $this->page .= $this->searchHTML('aside');           // Intégration de 'aside.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page tarif
     */
    public function displayTarifsPage($list)
    {
        
        $this->page .= $this->searchHTML('tarifs');                     // Intégration du 'tarifs.html' à l'attribut page
        $tableau = '<div class="container col-11 overflow-auto mb-5">'; // Ajout de la liste des prestations à l'attribut 'page'
        $tableau .= '<table class="table text-center">';
        $tableau .= '<thead>';
        $tableau .= '<tr>
                        <th>Temps</th>
                        <th>Famille d\'accueil</th>
                        <th>Promenades</th>
                        <th>À domicile</th>
                    </tr>';
        $tableau .= '</thead>';
        $tableau .= '<tbody>';
        foreach($list as $element)
        {
            $tableau .= "<tr>";
            $tableau .= "<td>$element[1]</td>";
            $tableau .= "<td>$element[2]</td>";
            $tableau .= "<td>$element[3]</td>";
            $tableau .= "<td>$element[4]</td>";              
            $tableau .= "</tr>";
        }
        $tableau .= "</tbody></table></div>";
        $this->page .= $tableau;                        // Ajout de la liste sur l'attribut 'page'

        $this->page .= $this->searchHTML('devis_form'); // Intégration du 'devis_form.html' à l'attribut page
        $this->page .= $this->searchHTML('aside');      // Intégration de 'aside.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page de contact
     */
    public function displayContactPage($list)
    {
        $this->page .= $this->searchHTML('contact');    // Intégration du 'contact.html' à l'attribut page

        $tableau = '<div class="my-3 overflow-auto">';  // Ajout de la liste des informations de contact à l'attribut 'page'
        $tableau .= '<h5 class="h5 text-center pb-5">Informations :</h5>';
        
        $tableau .= '<table class="table text-center">';
        $tableau .= '<tbody>';
        foreach($list as $element)
        {
            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>Société :</th>";
            $tableau .= "<td class='text-start'>$element[1]</td>";
            $tableau .= "</tr>";

            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>Numéro :</th>";
            $tableau .= "<td class='text-start'>$element[2]</td>";
            $tableau .= "</tr>";

            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>E-mail :</th>";
            $tableau .= "<td class='text-start'>$element[3]</td>";
            $tableau .= "</tr>";

            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>Adresse :</th>";
            $tableau .= "<td class='text-start'>$element[4]</td>";
            $tableau .= "</tr>";

            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>CP :</th>";
            $tableau .= "<td class='text-start'>$element[5]</td>";
            $tableau .= "</tr>";

            $tableau .= "<tr>";
            $tableau .= "<th class='text-start'>Ville :</th>";
            $tableau .= "<td class='text-start'>$element[6]</td>";
            $tableau .= "</tr>";
        }
        $tableau .= "</tbody></table></div>";

        $this->page .= $tableau;                                // Ajout de la liste sur l'attribut 'page'
        /* Intégration de la carte sur la page contact */
        $this->page .= "<div class='container-fluid overflow-auto'>";
        $this->page .= "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.4889679139683!2d2.3126904768262495!3d48.86795450003288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fce39c7f273%3A0xa52a9450f0b5eaab!2s10%20Av.%20des%20Champs-%C3%89lys%C3%A9es%2C%2075008%20Paris!5e0!3m2!1sfr!2sfr!4v1687468299059!5m2!1sfr!2sfr' width='600' height='450' style='border:0;' allowfullscreen=' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
        $this->page .= "</div>";

        $this->page .= $this->searchHTML('socials_contact');    // Intégration du 'socials_contact.html' à l'attribut page
        $this->page .= $this->searchHTML('aside');              //Intégration de 'aside.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page FAQ'
     */
    public function displayFAQPage()
    {
        $this->page .= $this->searchHTML('faq');                // Intégration du 'faq.html' à l'attribut page
        $this->page .= $this->searchHTML('aside');              // Intégration de 'aside.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page de la site map
     */
    public function displaySiteMapPage()
    {
        $this->page .= $this->searchHTML('site_map');           // Intégration de 'site_map.html' à l'attribut page
        $this->page .= $this->searchHTML('aside');              // Intégration de 'aside.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page de la page des CGU
     */
    public function displayCGUPage()
    {
        $this->page .= $this->searchHTML('CGU');                // Intégration de 'cgu.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage de la page de connexion à l'espace administrateur
     */
    public function displayAdminConnection()
    {
        $this->page .= $this->searchHTML('login');              // Intégration de 'login.html' à l'attribut page
        $this->display();
    }
    /**
     * Affichage du footer et de l'attribut $page
     */
    public function display()
    {
        $this->page .= $this->searchHTML('footer');             // Intégration de 'footer.html' à l'attribut page
        echo $this->page;                                       // Affichage de l'attribut 'page'
    }
    /**
     * Récupération des contenus html
     */
    public function searchHTML($file)
    {
        $content = file_get_contents("html/".$file.".html");    // Récupération du contenu du fichier passé en paramètre
        return $content;
    }
}