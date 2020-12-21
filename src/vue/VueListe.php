<?php


namespace mywishlist\vue;


class VueListe extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t,$c){
        $this->tab = $t;
        $this->container = $c;
        parent::__construct($t,$c);
    }

    private function lesListes() : string {
        $html = '<h2>Vos listes publiques : </h2>';
        foreach($this->tab as $liste){
            $html .= "<li>{$liste['titre']}, {$liste['description']}</li>";
        }
        $html .= '<h2>Vos listes privées : </h2>';
        foreach($this->tab as $liste){
            $html .= "<li>{$liste['titre']}, {$liste['description']}</li>";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    public function render(int $select) : String{
        switch ($select){
            case 0 : {
                VuePrincipale::$content = $this->lesListes ();
            }
        }



        return include("html/index.php");
    }

}