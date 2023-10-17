<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';  // Intégration du fichier Exception.php
require 'PHPMailer/src/PHPMailer.php';  // Intégration du fichier PHPMailer.php

$mail = new PHPMailer(true);            // Instanciation de PHPMailer

$nom = (isset($_POST['nom']))?$_POST['nom']:'null';             // Récupération de la valeur de l'attribut 'nom'
$prenom = (isset($_POST['prenom']))?$_POST['prenom']:'null';    // Récupération de la valeur de l'attribut 'prenom'
$tel = (isset($_POST['tel']))?$_POST['tel']:'null';             // Récupération de la valeur de l'attribut 'tel'
$email = (isset($_POST['email']))?$_POST['email']:'null';       // Récupération de la valeur de l'attribut 'email'
$demande = (isset($_POST['demande']))?$_POST['demande']:'null'; // Récupération de la valeur de l'attribut 'demande'


try {

    // Concernés
    $mail->setFrom($email);
    $mail->addAddress('anthony-fabbiati@netcourrier.com');     // Ajouter un destinataire

    // Contenu du mail
    $mail->isHTML(true);                                       // Paramétrer le format d'email en HTML
    $mail->Subject = "Demande de devis - $nom";
    $mail->Body    = 'Nom : '.$nom.'<br>Prenom : '.$prenom.'<br>Tel :'.$tel.'<br>E-mail : '.$email.'<br><br>'.$demande;


    $mail->send();
    header('Location: index.php?controller=tarifs');    // Redirection vers la page 'tarifs'
    exit();
} catch (Exception $e) {
    echo "Une erreur est survenue : {$mail->ErrorInfo}";
}