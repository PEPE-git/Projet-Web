<?php
//~ Affichage message d'erreur
function erreur($err=''){
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>');
}
?>

