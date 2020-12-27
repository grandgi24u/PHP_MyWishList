<?php


namespace mywishlist\vue;


class VueListe extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t, $c)
    {
        $this -> tab = $t;
        $this -> container = $c;
        parent ::__construct ( $t, $c );
    }

    private function menulistes(): string
    {
        $url_lites = $this -> container -> router -> pathFor ( 'afficherlistes' );
        $url_listesexpire = $this -> container -> router -> pathFor ( 'afficherlistesexpire' );
        $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );

        $html = <<<END
<div class="vertical-menu">
  <a class="active">Mes listes</a>
  <a href="$url_lites">Mes listes en cours</a>
  <a href="$url_listesexpire">Mes listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
</div>
END;
        return $html;
    }

    private function lesListes(): string
    {
        $html = '<h2>Vos listes en cours : </h2>';
        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td> <td>{$liste['token']}</td><td><a href='./liste/{$liste['no']}'><i class='fa fa-eye'></i></a>
                              <a href='./listemodif/{$liste['no']}'><i class='fa fa-edit'></i></a>
                              <a href='./supprimerliste/{$liste['no']}'><i class='fa fa-trash'></i></a></td></tr>";
            }
            $html .= "</tbody></table>";
        } else {
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function lesListesexpire(): string
    {
        $html = '<h2>Vos listes expirées : </h2>';
        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td> <td><a href='./liste/{$liste['no']}'><i class='fa fa-eye'></i></a>
                                                                                                   <a href='./supprimerliste/{$liste['no']}'><i class='fa fa-trash'></i></a></td></tr>";
            }
            $html .= "</tbody></table>";
        } else {
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function creerliste(): string
    {
        $today = date('Y-m-d');
        $url_new_liste = $this -> container -> router -> pathFor ( 'nouvelleliste' );
        $html = <<<FIN
<form method="POST" action="$url_new_liste" style="margin-left: 2%">
	<label>Titre :<br> <input type="text" name="titre" required/></label><br><br>
	<label>Description : <br><input type="text" name="description" required/></label><br><br>
	<label>Date d'expiration : <br><input type="date" name="date" value=$today min=$today required/></label><br><br>
	<button class="button" type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    private function uneListe(): string
    {
        $html = "<h1>Liste : {$this->tab['titre']}</h1>";
        $html .= "<h3>Description : {$this->tab['description']}</h3>";
        $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
        $html .= "<table class='styled-table' ><thead><tr><td>Item</td><td>Description</td><td>Etat de reservation</td></tr></thead><tbody>";
        foreach ($this -> tab['item'] as $item) {
            $html .= "<tr><td>{$item['nom']}</td> <td>{$item['descr']}</td> <td>{$item['etat']}</td></tr>";
        }
        $html .= "</tbody></table>";
        if($this->tab['date'] > date("Y-m-d") ){
            $html .= "<a class='button' href='../additem/{$this->tab['no']}'>Ajouter un item</a>";
        }

        return $html;
    }

    private function modifliste() : String {
        $html = <<<FIN
<form method="POST" action="../modifierliste/{$this->tab['no']}">
	<label>Titre :<br> <input type="text" name="titre" value="{$this->tab['titre']}"/></label><br>
	<label>Description : <br><input type="text" name="description" value="{$this->tab['description']}"/></label><br>
	<label>Date d'expiration : <br><input type="date" name="date" value="{$this->tab['expiration']}"/></label><br>
	<button class="button" type="submit">Enregistrer la modification</button>
</form>	
FIN;
        return $html;
    }

    public function render(int $select): string
    {
        switch ($select) {
            case 0 :
            {
                VuePrincipale ::$content = $this -> lesListes ();
                break;
            }
            case 1 :
            {
                VuePrincipale ::$content = $this -> creerliste ();
                break;
            }
            case 2 :
            {
                VuePrincipale ::$content = $this -> lesListesexpire ();
                break;
            }
            case 3 :
            {
                VuePrincipale ::$content = $this -> uneListe ();
                break;
            }
            case 4 :
            {
                VuePrincipale ::$content = $this -> modifliste ();
                break;
            }
        }

        VuePrincipale::$inMenu = $this -> menulistes ();

        return include ("html/index.php");
    }

}