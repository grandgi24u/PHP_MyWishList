<?php


namespace mywishlist\controls;

use mywishlist\vue\VueAlert;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurAlert
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function besoinconnection(Request $rq, Response $rs, $args) : Response {
        $vue = new VueAlert([], $this->container);
        $rs->getBody()->write($vue->render(0));
        return $rs;
    }


    public function listnotfound(Request $rq, Response $rs, $args) : Response {
        $vue = new VueAlert([], $this->container);
        $rs->getBody()->write($vue->render(1));
        return $rs;
    }

    public function listappartient(Request $rq, Response $rs, $args) : Response {
        $vue = new VueAlert([], $this->container);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function itemreserver(Request $rq, Response $rs, $args) : Response {
        $vue = new VueAlert([], $this->container);
        $rs->getBody()->write($vue->render(3));
        return $rs;
    }

    public function creationReussi(Request $rq, Response $rs, $args) : Response {
        $vue = new VueAlert([], $this->container);
        $rs->getBody()->write($vue->render(5));
        return $rs;
    }

    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
 * public function render(int $select) : String {

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
 */

    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
    /*
     * public function render(int $select) : String {

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
     */
}