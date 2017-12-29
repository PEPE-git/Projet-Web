<!DOCTYPE html>
<html>
    <head>
        <title>Contact</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <form id="contact" action="mail_fr.php" method="POST">
            <h1>Contacter les administrateurs</h1>
            <label>Nom</label><br/>
            <input type="text" id="champs" name="name"></input><br/><br/>
            <label>E-mail</label><br/>
            <input type="text" id="champs" name="email"></input><br/><br/>
            <label>Sujet</label><br/>
            <input type="text" id="champs" name="object"></input><br/><br/>
            <label>Message</label><br/>
            <textarea id="message" name="message"></textarea><br/><br/>
            <input id="envoyer" type="submit" value="Envoyer" name="Envoyer"></input>
        </form>
    </body>
</html>
 
<?php
    if(isset($_POST['Envoyer'])) {
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['object']) && !empty($_POST['message'])) {
            $destinataire = "ophelie.dasilva@live.fr";
            $objet = $_POST['object'];
            $message = $_POST['message'];
            mail($destinataire, $objet, $message);
            echo 'message envoyé';
        }
        else echo 'Veuillez remplir tous les champs';
    }
?>
