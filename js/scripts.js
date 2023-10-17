window.addEventListener('load', function(){
    window.addEventListener('scroll', apparitionBoutonScroll);                              // Exécute la fonction 'apparitionBoutonScroll' lors d'une action de scrolling sur la fenêtre
    document.getElementById('backToTopButton').addEventListener('click', scrollToTop);      // Exécute la fonction 'scrollToTop' lors du clic sur le bouton

    document.getElementById('burgerMenuButton').addEventListener('click', showMobileMenu);  // Au clic sur le menu burger, exécute la fonction showMobileMenu.

    if (document.getElementById('annuler') !== null) {                                      // Test si le bouton d'id 'annuler' n'est pas null
        document.getElementById('annuler').addEventListener('click', resetContactForm);     // Au clic sur le bouton annuler, remet à 0 les champs.
    }
});

/**
 * Fonction faisant apparaitre la flèche de retour 
 * vers le haut.
 */
function apparitionBoutonScroll() {
    var backToTopButton = document.getElementById('backToTopButton');   // Récupération du bouton 'backToTopButton'
    if (window.scrollY > 300) {                                         // Test de la hauteur du scroll effectué
        backToTopButton.style.display = 'block';                        // Changement du display du bouton en 'block'
    } else {
        backToTopButton.style.display = 'none';                         // Changement du display du bouton en 'none'
    }
};
/**
 * Fonction de scroll vers le haut 
 * au clic sur le bouton
 */
function scrollToTop(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });    // Scroll de la fenêtre vers la hauteur 0 de manière douce
};
  
/**
 * Fonction ajoutant ou retirant la classe 'showMobileMenu'
 * afin d'afficher ou non la liste au clic sur le bouton menu.
 */
function showMobileMenu() {
    var menuMobile = document.getElementById('burgerMenuItem'); // Récupération du menu 'burgerMenuItem
    menuMobile.classList.toggle('showMobileMenu');              // Ajout ou retrait de la classe 'showMobileMenu'
}

/**
 * Fonction de remise à zéro des champs
 * du formulaire de la page 'contact'
 */
function resetContactForm(e) {
    e.preventDefault();
    document.getElementById('nom').value = '';      // Réinitialisation de la valeur du champ
    document.getElementById('prenom').value = '';   // Réinitialisation de la valeur du champ
    document.getElementById('tel').value = '';      // Réinitialisation de la valeur du champ
    document.getElementById('email').value = '';    // Réinitialisation de la valeur du champ
    document.getElementById('demande').value = '';  // Réinitialisation de la valeur du champ
}



