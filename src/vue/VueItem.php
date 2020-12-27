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
            $html .= "<table class='styled-table' ><thead><tr><td>Item</td><td>Description</td></tr></thead><tbody>";
            foreach($this->tab as $item){
                $html .= "<tr><td>{$item['nom']}</td> <td>{$item['descr']}</td></tr>";
            }
            $html .= "</tbody></table>";
        }else{
            $html .= "Aucune participation";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function lesParticipationsexpire() : String {
        $html = '<h2>Vos Items expirées: </h2>';
        if(sizeof ($this->tab) > 0 ) {
            $html .= "<table class='styled-table' ><thead><tr><td>Item</td><td>Description</td></tr></thead><tbody>";
            foreach($this->tab as $item){
                $html .= "<tr><td>{$item['nom']}</td> <td>{$item['descr']}</td></tr>";
            }
            $html .= "</tbody></table>";
        }else{
            $html .= "Aucune participation expiré";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function ajouteritem() : String {
        $url = $this -> container -> router -> pathFor ( 'ajouteritem', ['no' => $this->tab['no']] );
        $html = "<h1>Ajouter un item a la liste {$this->tab['titre']}</h1>";
        $html .= <<<FIN
<form method="POST" action="$url">
	<label>Nom :<br> <input type="text" name="nom"/></label><br>
	<label>Description : <br><input type="text" name="descr"/></label><br>
	<label>Tarif : <br><input type="text" name="tarif"/></label><br>
	<label>Url (site) : <br><input type="text" name="url"/></label><br>
	<button class="button" type="submit">Ajouter l'item</button>
</form>	
FIN;
        return $html;
    }

    public function render(int $select) : String{
        switch ($select){
            case 0 : {
                $content = $this->lesParticipations ();
                break;
            }
            case 1 : {
                $content = $this->lesParticipationsexpire ();
                break;
            }
            case 2 : {
                $content = $this->ajouteritem ();
                break;
            }
        }
        VuePrincipale::$inMenu = $this->menuParticipations ();
        VuePrincipale::$content = $content;

        return include("html/index.php");
    }



}