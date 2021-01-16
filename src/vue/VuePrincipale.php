<?php

namespace mywishlist\vue;

class VuePrincipale
{

    private $tab;
    private $container;
    public static $content;
    public static $inMenu;
    //constructeur de la vue Principale
   public function __Construct($t, $c){
       $this->tab = $t;
       $this->container = $c;
   }
    //Cette methode genere la page d'accueil du site
   public function accueil() : String {
       //definition de l'url du lien qui mene a la creation de liste
       $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
       //Message de bienvenue du site
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
   //Cette methode envoie les contenue de la pages d'accueil e fonction de l'entier select
   public function render(int $select) : String {

       switch($select){
           //Dans le cas ou select vaut 0
           case 0 : {
               //on associe a la varial content (contenue) le message d'accueil
               VuePrincipale::$content = $this->accueil();
           }
       }
        //On vide la variable inMenue
       VuePrincipale::$inMenu = "";
        //retourne le fichier index qui contien principalement le css du site
       return substr(include ("html/index.php"), 1,-1);

   }
    //getter du contenue de la vu principal
   public function getContent(): String {
       return VuePrincipale::$content;
   }
    //getter du contenue de la variable inMenu
    public function getInMenu(): String {
        return VuePrincipale::$inMenu;
    }

}