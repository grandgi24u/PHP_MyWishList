<?php


namespace mywishlist\vue;


use mywishlist\models\Liste;

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
        $url = $this -> container -> router -> pathFor ( 'ajouteritem', ['tokenModif' => Liste::find($this->tab['no'])->tokenModif, 'no' => $this->tab['no']] );
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

    private function modifitem(): string
    {
        $url = $this->container->router->pathFor('modifieritem', ['tokenModif' => Liste::find($this->tab['liste_id'])->tokenModif, 'no' => $this->tab['id']]);
        $html = <<<FIN
<form method="POST" action="$url">
	<label>Nom :<br> <input type="text" name="nom" value="{$this->tab['nom']}"/></label><br>
	<label>Description : <br><input type="text" name="descr" value="{$this->tab['descr']}"/></label><br>
	<label>Url : <br><input type="text" name="url" value="{$this->tab['url']}"/></label><br>
	<label>Url de l'image : <br><input type="text" name="img" value="{$this->tab['img']}"/></label><br>
	<label for="fileUpload">Ou uploadez votre image :</label><br>
        <input type="file" name="photo">
        <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 10 Mo.</p>
	<label>Tarif : <br><input type="text" name="tarif" value="{$this->tab['tarif']}"/></label><br>
	<button class="button" type="submit">Enregistrer la modification</button>
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
            case 3 : {
                $content = $this->modifitem ();
                break;
            }
        }
        VuePrincipale::$inMenu = $this->menuParticipations ();
        VuePrincipale::$content = $content;

        return substr(include ("html/index.php"), 1,-1);
    }



}