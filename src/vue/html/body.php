<?php

echo "<div class='in'>";

if(\mywishlist\vue\VuePrincipale::getInMenu() != "" ){
    echo "<div class='inMenu'>";
    echo \mywishlist\vue\VuePrincipale ::getInMenu ();
    echo "</div>";
}else{
    echo "<center>";
}

echo "<div class='content'>";
echo \mywishlist\vue\VuePrincipale ::getContent ();
echo "</div></div>";

if(\mywishlist\vue\VuePrincipale::getInMenu() == "" ){
    echo "</center>";
}

?>

