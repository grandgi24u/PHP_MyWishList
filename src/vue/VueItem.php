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

        $url_items = $this -> container -> router -> pathFor ( 'afficheritems' );
        $url_itemsexpire = $this -> container -> router -> pathFor ( 'afficheritemsexpire' );

        $html = <<<END

<div class="vertical-menu">
  <a class="active">Mes Participations</a>
  <a href="$url_items">Mes cadeaux à achetés</a>
  <a href="$url_itemsexpire">Mes cadeaux passées</a>
</div>

END;
        return $html;
    }

    private function lesParticipations() : String {
        $html = '<h2>Vos Items à achetées : </h2>';
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

    private function lesParticipationsexpire() : String {
        $html = '<h2>Vos Items expirées: </h2>';
        if(sizeof ($this->tab) > 0 ) {
            foreach($this->tab as $item){
                $html .= "<li>{$item['nom']}, {$item['descr']}</li>";
            }
        }else{
            $html .= "Aucune participation expiré";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function ajouteritem() : String {
        $html = "<h1>Ajouter un item a la liste {$this->tab['titre']}</h1>";
        $html .= <<<FIN
<form method="POST" action="../ajouteritem/{$this->tab['no']}">
	<label>Nom :<br> <input type="text" name="nom"/></label><br>
	<label>Description : <br><input type="text" name="descr"/></label><br>
	<label>Tarif : <br><input type="text" name="tarif"/></label><br>
	<button type="submit">Ajouter l'item</button>
</form>	
FIN;
        return $html;
    }

    public function render(int $select) : String{
        switch ($select){
            case 0 : {
                VuePrincipale::$content = $this->menuParticipations () . $this->lesParticipations ();
                break;
            }
            case 1 : {
                VuePrincipale::$content = $this->menuParticipations () . $this->lesParticipationsexpire ();
                break;
            }
            case 2 : {
                VuePrincipale::$content = $this->ajouteritem ();
                break;
            }
        }

        return include("html/index.php");
    }



}