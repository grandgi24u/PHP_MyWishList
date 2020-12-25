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

    private function menulistes() : String {
        $html = <<<END

<div class="vertical-menu">
  <a class="active">Mes listes</a>
  <a href="./listes">Mes listes en cours</a>
  <a href="./listesexpire">Mes listes expirées</a>
  <a href="./creerliste">Créer une liste</a>
  <a href="./modifierliste">Modifier une liste</a>
</div>

END;
        return $html;
    }

    private function lesListes() : string {
        $html = '<h2>Vos listes en cours : </h2>';
        if(sizeof ($this->tab) > 0 ) {
            foreach($this->tab as $liste){
                $html .= "<li>{$liste['titre']}, {$liste['description']}, expire le : {$liste['expiration']}</li>";
            }
        }else{
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function lesListesexpire() : string {
        $html = '<h2>Vos listes expirées : </h2>';
        if(sizeof ($this->tab) > 0 ) {
            foreach($this->tab as $liste){
                $html .= "<li>{$liste['titre']}, {$liste['description']}, expiré le : {$liste['expiration']}</li>";
            }
        }else{
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function creerliste() : string {
        $url_new_liste = $this->container->router->pathFor( 'nouvelleliste' ) ;
        $html = <<<FIN
<form method="POST" action="$url_new_liste">
	<label>Titre :<br> <input type="text" name="titre"/></label><br>
	<label>Description : <br><input type="text" name="description"/></label><br>
	<label>Date d'expiration : <br><input type="date" name="date"/></label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    public function render(int $select) : String{
        switch ($select){
            case 0 : {
                VuePrincipale::$content = $this->menulistes () . $this->lesListes ();
                break;
            }
            case 1 : {
                VuePrincipale::$content = $this->menulistes () . $this->creerliste ();
                break;
            }
            case 2 : {
                VuePrincipale::$content = $this->menulistes () . $this->lesListesexpire ();
                break;
            }
        }

        return include("html/index.php");
    }

}