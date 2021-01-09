<?php


namespace mywishlist\vue;


use mywishlist\models\Commentaire;
use mywishlist\models\Liste;
use mywishlist\models\Participation;
use mywishlist\models\User;

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

    private function menulistesPubliques(): string
    {
        $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
        $url_listesexpire = $this -> container -> router -> pathFor ( 'afficherlistesexpire' );
        $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
        $html = <<<END
<div class="vertical-menu">
  <a class="active">Les listes publiques</a>
  <a href="$url_listes">Les listes en cours</a>
  <a href="$url_listesexpire">Les listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
</div>
END;
        return $html;
    }

    private function menuMesListes(): string
    {
        $url_listes = $this -> container -> router -> pathFor ( 'affichermeslistes' );
        $url_listesexpire = $this -> container -> router -> pathFor ( 'affichermeslistesexpire' );
        $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
        $url_ajouteruneliste = $this -> container -> router -> pathFor ( 'ajouterUneListe' );
        $html = <<<END
<div class="vertical-menu">
  <a class="active">Mes listes</a>
  <a href="$url_listes">Mes listes en cours</a>
  <a href="$url_listesexpire">Mes listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
  <a href='$url_ajouteruneliste'>Ajouter une liste au compte</a>
</div>
END;
        return $html;
    }

    private function lesListes(): string
    {
        $html = '<h2>Les listes en cours : </h2>';

        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                if ($liste['acces'] == "public") {
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";
                }
            }
            $html .= "</tbody></table>";
        } else {
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function meslistes(): string
    {
        $html = '<h2>Vos listes en cours : </h2>';
        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                if (isset( $_SESSION['iduser'] )) {
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                                    <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    $url_modif = $this -> container -> router -> pathFor ( 'listemodif', ['tokenModif' => $liste['tokenModif']] );
                    $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $liste['tokenModif']] );
                    $html .= " <a href='$url_modif'><i class='fa fa-edit'></i></a>
                                      <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                }
                $html .= "</tbody></table>";
            }
        } else {
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";

        return $html;
    }

    private function lesListesexpire(): string
    {
        $html = '<h2>Les listes expirées : </h2>';

        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                if ($liste['acces'] == "public") {
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";
                }
            }
            $html .= "</tbody></table>";
        } else {
            $html .= "Aucune liste";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function meslistesexpires(): string
    {
        $html = '<h2>Vos listes expirées : </h2>';
        if (sizeof ( $this -> tab ) > 0) {
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            foreach ($this -> tab as $liste) {
                if (isset( $_SESSION['iduser'] )) {
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                                    <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $liste['tokenModif']] );
                    $html .= " <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                }
            }
            $html .= "</tbody></table>";
        } else {
            $html .= "Aucune liste";
        }
        return $html;
    }

    private function creerliste(): string
    {
        $today = date ( 'Y-m-d' );
        $url_new_liste = $this -> container -> router -> pathFor ( 'nouvelleliste' );

        $html = <<<FIN
<h1>Créer une liste</h1>
<form method="POST" action="$url_new_liste">
	<label>Titre :<br> <input type="text" name="titre" required/></label><br><br>
	<label>Description : <br><input type="text" name="description" required/></label><br><br>
	<label>Date d'expiration : <br><input type="date" name="date" value=$today min=$today required/></label><br><br>
	<label>Liste publique?</label><input type='checkbox' name='etat' value='yes'><br><br>
	<button class="button" type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    private function modifliste(): string
    {
        $url = $this -> container -> router -> pathFor ( 'modifierliste', ['tokenModif' => $this -> tab['tokenModif']] );
        if ($this -> tab['acces'] == "public") {
            $a = "<label>Liste publique?</label><input type='checkbox' name='etat' value='yes' checked><br><br>";
        } else {
            $a = "<label>Liste publique?</label><input type='checkbox' name='etat' value='yes'><br><br>";
        }
        $html = <<<FIN
<h1>Modifier une liste</h1>
<form method="POST" action="$url">
	<label>Titre :<br> <input type="text" name="titre" value="{$this -> tab['titre']}"/></label><br>
	<label>Description : <br><input type="text" name="description" value="{$this -> tab['description']}"/></label><br>
	<label>Date d'expiration : <br><input type="date" name="date" value="{$this -> tab['expiration']}"/></label><br>
	$a
	<button class="button" type="submit">Enregistrer la modification</button>
</form>	
FIN;
        return $html;
    }

    private function ajouterUneListe(): string
    {
        $url = $this -> container -> router -> pathFor ( 'sajouterUneListe' );
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
        $url_additem = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $this -> tab['tokenModif']] );
        $html = <<<END
<h1>Informations importantes : </h1>
<p>
Voici le code qui va vous servir d'ajouter des items et de gerer votre liste ! <br>
<strong>Garder le bien </strong>il ne vous sera pas recommuniqué : {$this -> tab['tokenModif']} <br><br>
Et voici votre code de patarge a donner a vos amis / familles / etc : {$this -> tab['token']}
</p>
<br><a class='button' href='$url_additem'>Accéder en modification à la liste</a>
END;
        return $html;
    }

    private function uneListe(): string
    {
        if(isset($_COOKIE['liste']) && in_array ($this->tab['tokenModif'],$_COOKIE['liste'])){
            $html = $this -> uneListeModif ();
        }else{
            $html = "<h1>Liste : {$this->tab['titre']}</h1>";
            $html .= "<h3>Description : {$this->tab['description']}</h3>";
            $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
            $html .= "<table class='styled-table' ><thead><tr><td>Image</td><td>Item</td><td>Description</td><td>Url</td><td>Tarif</td><td>Etat de reservation</td></tr></thead><tbody>";
            if (count ( $this -> tab['item'] ) != 0) {
                foreach ($this -> tab['item'] as $item) {
                    if (file_exists ( "../uploads/{$item['img']}" )) {
                        $img = "../uploads/{$item['img']}";
                    } else {
                        $img = "../uploads/base.png";
                    }
                    if ($item['etat'] == 0) {
                        if(Liste ::where ( "no", "=", $item['liste_id'] ) -> first () -> expiration >= date ( "Y-m-d" )){
                            $url_additem = $this -> container -> router -> pathFor ( 'reserver', ['token' => $this -> tab['token'], "id" => $item['id']] );
                            $etat = "<a class='button red' href='$url_additem'>Reserver</a>";
                        }else{
                            $etat = "<p>Pas de réservation</p>";
                        }
                    } else {
                        $p = Participation ::where ( "id_item", "=", $item["id"] ) -> first ();
                        $etat = "<pre>Réserver par : " . $p -> nom . " <br>Commentaire : " . $p -> commentaire . "</pre>";
                    }
                    $html .= "<tr><td><img style='height:80px; width: 80px;' src='$img'></td><td>{$item['nom']}</td> 
                          <td>{$item['descr']}</td> <td>{$item['url']}</td><td>{$item['tarif']}</td><td>{$etat}</td>";
                }
            } else {
                $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
            }
            $html .= "</tbody></table>";
            $html .= $this -> ajouterCommentaire ();
            $html .= $this -> affichageCommentaire ();
        }
        return $html;
    }

    public function ajouterCommentaire(): string
    {
        $url = $this -> container -> router -> pathFor ( 'ajouterCom', ['token' => $this -> tab['token']] );
        if(isset($_COOKIE['commentaire'])){
            if(isset($_COOKIE['iduser'])){
                $value = User::find($_COOKIE['iduser'])->nom;
            }else{
                $value = $_COOKIE['commentaire'];
            }
            $content = "<label>Nom :<br> <input type='text' name='nom' value='$value' required/></label><br> ";
        }else{
            $content = "<label>Nom :<br> <input type='text' name='nom' required/></label><br> ";
        }
        $html = <<<FIN
<hr><h1>Ajouter un commentaire a cette liste</h1>
<form method="POST" action="$url">
	$content
	<label>Commentaire : <br><input type='text' name='commentaire' required/></label><br>
	<button class="button" type="submit">Publier</button>
</form>	<br>
FIN;
        return $html;
    }

    public function affichageCommentaire(): string
    {
        $com = Commentaire ::all ();
        if (Commentaire ::where ( "id_liste", "=", Liste ::where ( "token", "=", $this -> tab['token'] ) -> first () -> no ) -> first () != null) {
            $html = "<hr><h1>Commentaires</h1>";
        } else {
            $html = "<hr><h1>Aucun commentaires</h1>";
        }

        foreach ($com as $c) {
            if ($c -> id_liste == Liste ::where ( "token", "=", $this -> tab['token'] ) -> first () -> no) {
                $html .= "<h3>$c->nom : $c->text</h3>";
            }
        }

        return $html;
    }

    private function uneListeModif(): string
    {
        $html = "<h1 class='important'>Mode modification</h1>";
        $html .= "<h1>Liste : {$this->tab['titre']}</h1>";
        $html .= "<h3>Description : {$this->tab['description']}</h3>";
        $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
        $html .= $this -> afficherItems ();
        if ($this -> tab['date'] >= date ( "Y-m-d" )) {
            $url_additem = $this -> container -> router -> pathFor ( 'additem', ['tokenModif' => $this -> tab['tokenModif'], "no" => $this -> tab['no']] );
            $url_modif = $this -> container -> router -> pathFor ( 'listemodif', ['tokenModif' => $this -> tab['tokenModif']] );
            $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $this -> tab['tokenModif']] );
            $html .= "<a class='button' href='$url_additem'>Ajouter un item</a>
                      <a class='button' href='$url_modif'>Modifier la liste</a>
                      <a class='button red' href='$url_suppr'>Supprimer la liste</a>";
        } else {
            $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $this -> tab['tokenModif']] );
            $html .= "<a class='button' href='$url_suppr'>Supprimer la liste</a>";
        }

        return $html;
    }

    private function afficherItems(): string
    {
        $html = "<table class='styled-table' ><thead><tr><td>Image</td><td>Item</td><td>Description</td><td>Url</td><td>Tarif</td><td>Réservation</td><td>Action</td></tr></thead><tbody>";
        if (count ( $this -> tab['item'] ) != 0) {
            foreach ($this -> tab['item'] as $item) {
                $url_modif = $this -> container -> router -> pathFor ( 'modifitem', ['tokenModif' => $this -> tab['tokenModif'], 'no' => $item['id']] );
                $url_suppr = $this -> container -> router -> pathFor ( 'supprimeritem', ['tokenModif' => $this -> tab['tokenModif'], 'no' => $item['id']] );

                if (file_exists ( "../uploads/{$item['img']}" )) {
                    $img = "../uploads/{$item['img']}";
                } else {
                    $img = "../uploads/base.png";
                }
                if (Liste ::where ( "no", "=", $item['liste_id'] ) -> first () -> expiration < date ( "Y-m-d" ) && $item['etat'] == 1) {
                    $p = Participation ::where ( "id_item", "=", $item["id"] ) -> first ();
                    $etat = "<pre>Réserver par : " . $p -> nom . " <br>Commentaire : " . $p -> commentaire . "</pre>";
                } else {
                    if ($item['etat'] == 1) {
                        $etat = "Réservé";
                    } else {
                        $etat = "Disponible";
                    }
                }

                $html .= "<tr><td><img style='height:80px; width: 80px;' src='$img'></td>
                          <td>{$item['nom']}</td> <td>{$item['descr']}</td> <td>{$item['url']}</td><td>{$item['tarif']}</td><td>{$etat}</td>
                          <td><a href='$url_modif'><i class='fa fa-edit'></i></a>
                          <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
            }
        } else {
            $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
        }
        $html .= "</tbody></table>";
        return $html;
    }

    public function render(int $select): string
    {
        switch ($select) {
            case 0 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> lesListes ();
                break;
            }
            case 1 :
            {
                $menu = "";
                VuePrincipale ::$content = $this -> creerliste ();
                break;
            }
            case 2 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> lesListesexpire ();
                break;
            }
            case 3 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> uneListe ();
                break;
            }
            case 4 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> modifliste ();
                break;
            }
            case 6 :
            {
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> ajouterUneListe ();
                break;
            }
            case 7 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> donnerTokenModif ();
                break;
            }
            case 8 :
            {
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> uneListeModif ();
                break;
            }
            case 9 :
            {
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> meslistes ();
                break;
            }
            case 10 :
            {
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> meslistesexpires ();
                break;
            }
        }

        VuePrincipale ::$inMenu = $menu;

        return substr ( include ("html/index.php"), 1, -1 );
    }

}