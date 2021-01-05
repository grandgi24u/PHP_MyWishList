<?php


namespace mywishlist\vue;


class VueAlert extends VuePrincipale
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

    private function itemreserver() : String {
        return "<h1>L'item ne peux pas etre modifier ou supprimer car il est réserver</h1>";
    }

    private function itemdejareserver() : String {
        return "<h1>L'item est déjà réserver</h1>";
    }

    private function creationReussi() : String {
        return "<h1>Création réussi</h1>";
    }

    public function render(int $select) : String {
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
            case 3 :
            {
                VuePrincipale::$content = $this->itemreserver();
                break;
            }
            case 4 :
            {
                VuePrincipale::$content = $this->itemdejareserver();
                break;
            }
            case 5 :
            {
                VuePrincipale::$content = $this->creationReussi();
                break;
            }
            case 6 :
            {
                VuePrincipale::$content = $this->erreurconnection();
                break;
            }
        }

        VuePrincipale::$inMenu = "";

        return substr(include ("html/index.php"), 1,-1);
    }

}