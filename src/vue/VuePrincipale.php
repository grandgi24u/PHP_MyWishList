<?php

namespace mywishlist\vue;

class VuePrincipale
{

    private $tab;
    private $container;
    public static $content;
    public static $inMenu;

   public function __Construct($t, $c){
       $this->tab = $t;
       $this->container = $c;
   }

   public function accueil() : String {
       $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
       $html = <<<END

<center><h1>Bienvenue sur le site MyWishList</h1></center>

<p>MyWishList est une application en ligne pour créer, partager et gérer des listes de cadeaux.
L'application permet de créer une liste de souhaits à l'occasion d'un événement
particulier (anniversaire, fin d'année, mariage, retraite …) et lui permet de diffuser cette liste de
souhaits à un ensemble de personnes concernées. Vous pouvez donc consulter cette liste
et s'engager à offrir 1 élément de la liste. 
</p>
<a class='button' href="$url_creerlistes">Créer une liste</a>

END;
        return $html;
   }

   public function render(int $select) : String {

       switch($select){
           case 0 : {
               VuePrincipale::$content = $this->accueil();
           }
       }

       VuePrincipale::$inMenu = "";

       return substr(include ("html/index.php"), 1,-1);

   }

   public function getContent(): String {
       return VuePrincipale::$content;
   }

    public function getInMenu(): String {
        return VuePrincipale::$inMenu;
    }

}