<?php

namespace mywishlist\vue;

class VuePrincipale
{

    private $tab;
    private $container;
    public static $content;

   public function __Construct($t, $c){
       $this->tab = $t;
       $this->container = $c;
   }

   public function accueil() : String {
       $html = <<<END

<h1> Bienvenue sur le site MyWishList </h1>

END;
        return $html;
   }

   public function render(int $select) : String {

       switch($select){
           case 0 : {
               VuePrincipale::$content = $this->accueil();
           }
           case 1 : {

           }
       }

       return include("html/index.php");

   }

   public function getContent(): String {
       return VuePrincipale::$content;
   }

}