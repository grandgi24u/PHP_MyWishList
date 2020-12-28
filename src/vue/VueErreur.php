<?php


namespace mywishlist\vue;


class VueErreur extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t, $c)
    {
        $this -> tab = $t;
        $this -> container = $c;
        parent ::__construct ( $t, $c );
    }

    private function besoinconnection() : String {
        return "<h1>Vous avez besoin d'etre connecter</h1>";
    }

    private function erreurconnection() : String {
        return "<h1>Echec de la connection</h1>";
    }

    private function listnotfound() : String {
        return "<h1>La liste saisie n'existe pas</h1>";
    }

    private function listappartient() : String {
        return "<h1>La liste saisie appartient déjà à quelqu'un</h1>";
    }

    public function render($select) : String {
        switch ($select) {
            case 0 :
            {
                VuePrincipale::$content = $this->besoinconnection();
                break;
            }
            case 1 :
            {
                VuePrincipale::$content = $this->listnotfound();
                break;
            }
            case 2 :
            {
                VuePrincipale::$content = $this->listappartient();
                break;
            }
        }

        VuePrincipale::$inMenu = "";

        return substr(include ("html/index.php"), 1,-1);;
    }

}