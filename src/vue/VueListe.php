<?php


namespace mywishlist\vue;


class VueListe extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t, $c)
    {
        $this->tab = $t;
        $this->container = $c;
        parent::__construct($t, $c);
    }

    private function menulistes(): string
    {
        $url_listes = $this->container->router->pathFor('afficherlistes');
        $url_listesexpire = $this->container->router->pathFor('afficherlistesexpire');
        $url_creerlistes = $this->container->router->pathFor('creerliste');
        $url_ajouteruneliste = $this->container->router->pathFor('ajouterUneListe');

        if (isset($_SESSION['iduser'])) {
            $html = <<<END
<div class="vertical-menu">
  <a class="active">Mes listes</a>
  <a href="$url_listes">Mes listes en cours</a>
  <a href="$url_listesexpire">Mes listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
  <a href='$url_ajouteruneliste'>Ajouter une liste au compte</a>
</div>
END;
        } else {
            $html = <<<END
<div class="vertical-menu">
  <a class="active">Les listes publiques</a>
  <a href="$url_listes">Les listes en cours</a>
  <a href="$url_listesexpire">Les listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
</div>
END;
        }

        return $html;
    }

    private function lesListes(): string
    {
        if (isset($_SESSION['iduser'])) {
            $html = '<h2>Vos listes en cours : </h2>';
        } else {
            $html = '<h2>Les listes en cours : </h2>';
        }
        if (sizeof($this->tab) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this->tab as $liste) {
                if (isset($_SESSION['iduser'])) {
                    $url_show = $this->container->router->pathFor('afficherUneListe', ['token' => $liste['token']]);
                    $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    $url_modif = $this->container->router->pathFor('listemodif', ['tokenModif' => $liste['tokenModif']]);
                    $url_suppr = $this->container->router->pathFor('supprimerliste', ['tokenModif' => $liste['tokenModif']]);
                    $html .= " <a href='$url_modif'><i class='fa fa-edit'></i></a>
                              <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                } else {
                    if ($liste['acces'] == "public") {
                        $url_show = $this->container->router->pathFor('afficherUneListe', ['token' => $liste['token']]);
                        $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";

                    }
                }
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
        if (isset($_SESSION['iduser'])) {
            $html = '<h2>Vos listes expirées : </h2>';
        } else {
            $html = '<h2>Les listes expirées : </h2>';
        }
        if (sizeof($this->tab) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this->tab as $liste) {
                if (isset($_SESSION['iduser'])) {
                    $url_show = $this->container->router->pathFor('afficherUneListe', ['token' => $liste['token']]);
                    $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    $url_suppr = $this->container->router->pathFor('supprimerliste', ['tokenModif' => $liste['tokenModif']]);
                    $html .= " <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                } else {
                    if ($liste['acces'] == "public") {
                        $url_show = $this->container->router->pathFor('afficherUneListe', ['token' => $liste['token']]);
                        $html .= "<tr><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";

                    }
                }
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
        $url_new_liste = $this->container->router->pathFor('nouvelleliste');

        $html = <<<FIN
<form method="POST" action="$url_new_liste" style="margin-left: 2%">
	<label>Titre :<br> <input type="text" name="titre" required/></label><br><br>
	<label>Description : <br><input type="text" name="description" required/></label><br><br>
	<label>Date d'expiration : <br><input type="date" name="date" value=$today min=$today required/></label><br><br>
	<label for='subscribeNews'>Liste publique?</label><input type='checkbox' name='etat' value='yes'><br><br>
	<button class="button" type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    private function modifliste(): string
    {
        $url = $this->container->router->pathFor('modifierliste', ['tokenModif' => $this->tab['tokenModif']]);
        $html = <<<FIN
<form method="POST" action="$url">
	<label>Titre :<br> <input type="text" name="titre" value="{$this->tab['titre']}"/></label><br>
	<label>Description : <br><input type="text" name="description" value="{$this->tab['description']}"/></label><br>
	<label>Date d'expiration : <br><input type="date" name="date" value="{$this->tab['expiration']}"/></label><br>
	<button class="button" type="submit">Enregistrer la modification</button>
</form>	
FIN;
        return $html;
    }


    private function recherchenulle(): string
    {
        return "<h1>Aucun resultat</h1>";
    }

    private function ajouterUneListe(): string
    {
        $url = $this->container->router->pathFor('sajouterUneListe');
        $html = <<<FIN
<form method="POST" action="$url">
	<label>Code de modification :<br> <input type="text" name="token" required/></label><br>
	<button class="button" type="submit">Ajouter</button>
</form>	
FIN;
        return $html;
    }

    private function donnerTokenModif(): string
    {
        $html = <<<END
<h1>Informations importantes : </h1>
<p>
Voici le code qui va vous servir d'ajouter des items et de gerer votre liste ! <br>
Garder le bien il ne vous sera pas recommuniqué : {$this->tab['tokenModif']} <br><br>
Et voici votre code de patarge a donner a vos amis / familles / etc : {$this->tab['token']}
</p>
END;
        return $html;
    }

    private function uneListe(): string
    {
        $html = "<h1>Liste : {$this->tab['titre']}</h1>";
        $html .= "<h3>Description : {$this->tab['description']}</h3>";
        $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
        $html .= "<table class='styled-table' ><thead><tr><td>Item</td><td>Description</td><td>Url</td><td>Etat de reservation</td></tr></thead><tbody>";
        if(count($this->tab['item']) != 0) {
            foreach ($this -> tab['item'] as $item) {
                $html .= "<tr><td>{$item['nom']}</td> <td>{$item['descr']}</td> <td>{$item['url']}</td><td>{$item['etat']}</td>";
            }
        }else{
            $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td></tr>";
        }
        $html .= "</tbody></table>";
        if(isset($_SESSION['iduser']) == $this->tab['user_id']){
            if($this->tab['date'] >= date("Y-m-d") ){
                $url_additem = $this -> container -> router -> pathFor ( 'additem' , ["no" => $this->tab['no']]);
                $html .= "<a class='button' href='$url_additem'>Ajouter un item</a>";
            }
        }

        return $html;
    }




    private function uneListeModif(): string
    {
        $html = "<h1>Mode modification</h1>";
        $html .= "<h1>Liste : {$this->tab['titre']}</h1>";
        $html .= "<h3>Description : {$this->tab['description']}</h3>";
        $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
        $html .= $this->afficherItems();
        if ($this->tab['date'] >= date("Y-m-d")) {
            $url_additem = $this->container->router->pathFor('additem', ["no" => $this->tab['no']]);
            $url_modif = $this->container->router->pathFor('listemodif', ['tokenModif' => $this->tab['tokenModif']]);
            $url_suppr = $this->container->router->pathFor('supprimerliste', ['tokenModif' => $this->tab['tokenModif']]);
            $html .= "<a class='button' href='$url_additem'>Ajouter un item</a>
                      <a class='button' href='$url_modif'>Modifier la liste</a>
                      <a class='button' href='$url_suppr'>Supprimer la liste</a>";
        }else{
            $url_suppr = $this->container->router->pathFor('supprimerliste', ['tokenModif' => $this->tab['tokenModif']]);
            $html .= "<a class='button' href='$url_suppr'>Supprimer la liste</a>";
        }

        return $html;
    }

    private function afficherItems() : String {
        $html = "<table class='styled-table' ><thead><tr><td>Item</td><td>Description</td><td>Url</td><td>Etat de reservation</td><td>Action</td></tr></thead><tbody>";
        if (count($this->tab['item']) != 0) {
            foreach ($this->tab['item'] as $item) {
                $url_modif = $this->container->router->pathFor('modifitem', ['no' => $item['id']]);
                $url_suppr = $this->container->router->pathFor('supprimeritem', ['no' => $item['id']]);
                $html .= "<tr><td>{$item['nom']}</td> <td>{$item['descr']}</td><td>{$item['url']}</td><td>{$item['etat']}</td>
                          <td><a href='$url_modif'><i class='fa fa-edit'></i></a>
                          <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
            }
        } else {
            $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td><td>--</td></tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    }

    public function render(int $select): string
    {
        switch ($select) {
            case 0 :
            {
                VuePrincipale::$content = $this->lesListes();
                break;
            }
            case 1 :
            {
                VuePrincipale::$content = $this->creerliste();
                break;
            }
            case 2 :
            {
                VuePrincipale::$content = $this->lesListesexpire();
                break;
            }
            case 3 :
            {
                VuePrincipale::$content = $this->uneListe();
                break;
            }
            case 4 :
            {
                VuePrincipale::$content = $this->modifliste();
                break;
            }
            case 5 :
            {
                VuePrincipale::$content = $this->recherchenulle();
                break;
            }
            case 6 :
            {
                VuePrincipale::$content = $this->ajouterUneListe();
                break;
            }
            case 7 :
            {
                VuePrincipale::$content = $this->donnerTokenModif();
                break;
            }
            case 8 :
            {
                VuePrincipale::$content = $this->uneListeModif();
                break;
            }
            case 9 :
            {
                VuePrincipale::$content = $this->modifieritem();
                break;
            }
        }

        VuePrincipale::$inMenu = $this->menulistes();

        return substr(include("html/index.php"), 1, -1);
    }

}