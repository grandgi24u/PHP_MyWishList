<?php


namespace mywishlist\vue;


class VueItem extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t,$c){
        $this->tab = $t;
        $this->container = $c;
        parent::__construct($t,$c);
    }

    private function menuParticipations() : String {
        $html = <<<END

<div class="vertical-menu">
  <a class="active">Mes Participations</a>
  <a href="./items">Mes cadeaux à achetés</a>
  <a href="./pastitems">Mes cadeaux passées</a>
</div>

END;
        return $html;
    }

    private function lesParticipations() : String {
        $html = '<h2>Vos Items : </h2>';
        if(sizeof ($this->tab) > 0 ) {
            foreach($this->tab as $item){
                $html .= "<li>{$item['nom']}, {$item['descr']}</li>";
            }
        }else{
            $html .= "Aucune participation";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    public function render(int $select) : String{
        switch ($select){
            case 0 : {
                VuePrincipale::$content = $this->menuParticipations () . $this->lesParticipations ();
                break;
            }
            case 1 : {
                VuePrincipale::$content = $this->menuParticipations () . $this->creerliste ();
                break;
            }
        }



        return include("html/index.php");
    }



}