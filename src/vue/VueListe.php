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

    //Cette methode genere la liste des boutons qui mene vers les listes
    private function menulistesPubliques(): string
    {
        //Definition du chemin qui mene vers les listes publiques
        $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
        //Definition du chemin qui mene vers les listes expires
        $url_listesexpire = $this -> container -> router -> pathFor ( 'afficherlistesexpire' );
        //Definition du chemin qui mene vers la page de creation de liste
        $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
        //On definie l'html du menu
        $html = <<<END
<div class="vertical-menu">
  <a class="active">Les listes publiques</a>
  <a href="$url_listes">Les listes en cours</a>
  <a href="$url_listesexpire">Les listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
</div>
END;
        //retoure l'html
        return $html;
    }
    //Cette methode genere la liste des boutons qui mene vers les listes
    //lorqu'un utilisateur est connecter
    private function menuMesListes(): string
    {
        //Definition du chemin qui mene vers les listes de l'utilisateur
        $url_listes = $this -> container -> router -> pathFor ( 'affichermeslistes' );
        //Definition du chemin qui mene vers les listes expires de l'utilisateur
        $url_listesexpire = $this -> container -> router -> pathFor ( 'affichermeslistesexpire' );
        //Definition du chemin qui mene vers la page de creation de liste
        $url_creerlistes = $this -> container -> router -> pathFor ( 'creerliste' );
        //Definition du chemin qui mene vers la page pour ajouter une liste
        $url_ajouteruneliste = $this -> container -> router -> pathFor ( 'ajouterUneListe' );
        //On definie l'html du menu
        $html = <<<END
<div class="vertical-menu">
  <a class="active">Mes listes</a>
  <a href="$url_listes">Mes listes en cours</a>
  <a href="$url_listesexpire">Mes listes expirées</a>
  <a href="$url_creerlistes">Créer une liste</a>
  <a href='$url_ajouteruneliste'>Ajouter une liste au compte</a>
</div>
END;
        //retoure l'html
        return $html;
    }

    //Creer la vue des listes publiques en cours
    private function lesListes(): string
    {
        //Titre de la page
        $html = '<h2>Les listes en cours : </h2>';

        //Si il y a des listes dans le tableau
        if (sizeof ( $this -> tab ) > 0) {
            //Definition de la forme html d'une liste
            //Correspond au nom de colonne du tableau
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            //pour chaque liste dans le tableau
            foreach ($this -> tab as $liste) {
                //si la liste est publique
                if ($liste['acces'] == "public") {
                    //Definition du chemin qui mene a la liste
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    //ON remplie l'html avec les information de la liste
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";
                }
            }
            //Ferme les balises html
            $html .= "</tbody></table>";
        } else {
            //Si il n'y a pas de liste dans le tableau
            //on affiche
            $html .= "Aucune liste";
        }
        //on place l'html dans des balises de liste
        $html = "<ul>$html</ul>";
        //on retourne le resultat
        return $html;
    }

    //Creer la vue des listes le l'utilisateur en cours
    private function meslistes(): string
    {
        //Titre de la page
        $html = '<h2>Vos listes en cours : </h2>';
        //Si il y a des listes dans le tableau
        if (sizeof ( $this -> tab ) > 0) {
            //Definition de la forme html d'une liste
            //Correspond au nom de colonne du tableau
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            //pour chaque liste dans le tableau
            foreach ($this -> tab as $liste) {
                //si la liste est privee
                if (isset( $_SESSION['iduser'] )) {
                    //Definition du chemin qui mene a la liste
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    //ON remplie l'html avec les information de la liste
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                                    <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    //Definition du chemin qui mene a la modification de la liste
                    $url_modif = $this -> container -> router -> pathFor ( 'listemodif', ['tokenModif' => $liste['tokenModif']] );
                    //Definition du chemin qui mene a la suppression de la liste
                    $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $liste['tokenModif']] );
                    //on les implementes dans les information de la liste sous les icones
                    $html .= " <a href='$url_modif'><i class='fa fa-edit'></i></a>
                                      <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                }
                //Ferme les balises html
                $html .= "</tbody></table>";
            }
        } else {
            //Si il n'y a pas de liste dans le tableau
            //on affiche
            $html .= "Aucune liste";
        }
        //on place l'html dans des balises de liste
        $html = "<ul>$html</ul>";
        //on retourne le resultat
        return $html;
    }

    //Creer l'affichage des listes expirees
    private function lesListesexpire(): string
    {
        //Titre de la page
        $html = '<h2>Les listes expirées : </h2>';
        //Si il y a des listes dans le tableau
        if (sizeof ( $this -> tab ) > 0) {
            //Definition de la forme html d'une liste
            //Correspond au nom de colonne du tableau
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            //pour chaque liste dans le tableau
            foreach ($this -> tab as $liste) {
                //si la liste est publique
                if ($liste['acces'] == "public") {
                    //Definition du chemin qui mene a la liste
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    //on remplie l'html avec les information de la liste
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                            <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a></td></tr>";
                }
            }
            //Ferme les balises html
            $html .= "</tbody></table>";
        } else {
            //Si il n'y a pas de liste dans le tableau
            //on affiche
            $html .= "Aucune liste";
        }
        //on place l'html dans des balises de liste
        $html = "<ul>$html</ul>";
        //on retourne le resultat
        return $html;
    }

    //Creer l'affichage des listes expirees de l'utilisateur
    private function meslistesexpires(): string
    {
        //Titre de la page
        $html = '<h2>Vos listes expirées : </h2>';
        //Si il y a des listes dans le tableau
        if (sizeof ( $this -> tab ) > 0) {
            //Definition de la forme html d'une liste
            //Correspond au nom de colonne du tableau
            $html .= "<table class='styled-table' ><thead><tr><td>Acces</td><td>Titre</td><td>Description</td><td>Date d'expiration</td><td>Code de partage</td><td>Action</td></tr></thead><tbody>";
            //pour chaque liste dans le tableau
            foreach ($this -> tab as $liste) {
                //si la liste est privee
                if (isset( $_SESSION['iduser'] )) {
                    //Definition du chemin qui mene a la liste
                    $url_show = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $liste['token']] );
                    //on remplie l'html avec les information de la liste
                    $html .= "<tr><td>{$liste['acces']}</td><td>{$liste['titre']}</td> <td>{$liste['description']}</td> <td>{$liste['expiration']}</td>
                                    <td>{$liste['token']}</td><td><a href='$url_show'><i class='fa fa-eye'></i></a>";
                    //Definition du chemin qui mene a la suppression de la liste
                    $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $liste['tokenModif']] );
                    //on les implementes dans les information de la liste sous les icones
                    $html .= " <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
                }
            }
            //Ferme les balises html
            $html .= "</tbody></table>";
        } else {
            //Si il n'y a pas de liste dans le tableau
            //on affiche
            $html .= "Aucune liste";
        }
        //on retourne le resultat
        return $html;
    }
    //Creer la page de creation de liste
    private function creerliste(): string
    {
        //Definition du format de la date
        $today = date ( 'Y-m-d' );
        //Definition du chemin qui mene a la creation d'une nouvelle liste
        $url_new_liste = $this -> container -> router -> pathFor ( 'nouvelleliste' );
        //on creer l'html qui met en forme le formulaire de creation
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
        //on retourne le formulaire html
        return $html;
    }
    //Creer le formulaire de modification de liste
    private function modifliste(): string
    {
        //Chemin qui appelle a une modification de liste
        $url = $this -> container -> router -> pathFor ( 'modifierliste', ['tokenModif' => $this -> tab['tokenModif']] );
        //si la liste est publique
        if ($this -> tab['acces'] == "public") {
            //on affiche la checkbox checker
            $a = "<label>Liste publique?</label><input type='checkbox' name='etat' value='yes' checked><br><br>";
        } else {
            //si elle est privee
            //on affiche la checkbox non checker
            $a = "<label>Liste publique?</label><input type='checkbox' name='etat' value='yes'><br><br>";
        }
        //on definie le reste du formulaire
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
        //retourne le formulaire html
        return $html;
    }

    //creer la page d'ajout de liste
    private function ajouterUneListe(): string
    {
        //chemin qui appelle un ajout de liste
        $url = $this -> container -> router -> pathFor ( 'sajouterUneListe' );
        //creation du formulaire et des boutons
        $html = <<<FIN
<form method="POST" action="$url">
	<label>Code de modification :<br> <input type="text" name="token" required/></label><br>
	<button class="button" type="submit">Ajouter</button>
</form>	
FIN;
        //retourne le formulaire html
        return $html;
    }

    //creer la page qui donne le token de modification de la liste
    private function donnerTokenModif(): string
    {
        //chemin qui applelle la page de modification de liste
        $url_additem = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $this -> tab['tokenModif']] );
        //creation le page
        $html = <<<END
<h1>Informations importantes : </h1>
<p>
Voici le code qui va vous servir d'ajouter des items et de gerer votre liste ! <br>
<strong>Garder le bien </strong>il ne vous sera pas recommuniqué : {$this -> tab['tokenModif']} <br><br>
Et voici votre code de patarge a donner a vos amis / familles / etc : {$this -> tab['token']}
</p>
<br><a class='button' href='$url_additem'>Accéder en modification à la liste</a>
END;
        //retourne l'html de la page
        return $html;
    }

    //affice une liste
    private function uneListe(): string
    {
        //si il y a une liste dans les cookies et que le token de modification est present
        if(isset($_COOKIE['liste']) && in_array ($this->tab['tokenModif'],$_COOKIE['liste'])){
            //renvois vers l'affichage de modification
            $html = $this -> uneListeModif ();
        }else{
            //sinon
            //ecrit le titre de la liste
            $html = "<h1>Liste : {$this->tab['titre']}</h1>";
            //implemente la description de la liste
            $html .= "<h3>Description : {$this->tab['description']}</h3>";
            //implemente la cle de partage de la liste
            $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
            //implemente le tableau qui contien les items
            $html .= "<table class='styled-table' ><thead><tr><td>Image</td><td>Item</td><td>Description</td><td>Url</td><td>Tarif</td><td>Etat de reservation</td></tr></thead><tbody>";
            //si il y a des items
            if (count ( $this -> tab['item'] ) != 0) {
                //pour chaque items
                foreach ($this -> tab['item'] as $item) {
                    //si il y a une image
                    if (file_exists ( "../uploads/{$item['img']}" )) {
                        //elle est ajouter a la vu
                        $img = "../uploads/{$item['img']}";
                    } else {
                        //si non
                        //on mais l'image de base
                        $img = "../uploads/base.png";
                    }
                    //si l'item n'est pas reserver
                    if ($item['etat'] == 0) {
                        //si la liste n'est pas expirer
                        if(Liste ::where ( "no", "=", $item['liste_id'] ) -> first () -> expiration >= date ( "Y-m-d" )){
                            //on defini l'url qui permet de reserver l'item
                            $url_additem = $this -> container -> router -> pathFor ( 'reserver', ['token' => $this -> tab['token'], "id" => $item['id']] );
                            //on creer le bouton
                            $etat = "<a class='button red' href='$url_additem'>Reserver</a>";
                        }else{
                            //si la liste est expirer
                            //on affiche le message suivant
                            $etat = "<p>Pas de réservation</p>";
                        }
                    } else {
                        //si l'item est reserver
                        //on recupere le participant
                        $p = Participation ::where ( "id_item", "=", $item["id"] ) -> first ();
                        //affiche les detail de la participation
                        $etat = "<pre>Réserver par : " . $p -> nom . " <br>Commentaire : " . $p -> commentaire . "</pre>";
                    }
                    //remplie le tableau avec les informations de l'item
                    $html .= "<tr><td><img style='height:80px; width: 80px;' src='$img'></td><td>{$item['nom']}</td> 
                          <td>{$item['descr']}</td> <td>{$item['url']}</td><td>{$item['tarif']}</td><td>{$etat}</td>";
                }
            } else {
                //si il n'y a pas d'item
                //on affiche aucun item
                $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
            }
            //ferme les balises html
            $html .= "</tbody></table>";
            //ajoute le formulaire pour les commentaires
            $html .= $this -> ajouterCommentaire ();
            //ajoute les commentaires precedement poster
            $html .= $this -> affichageCommentaire ();
        }
        //retourne la page
        return $html;
    }

    //creer le formulaire de commentaire
    public function ajouterCommentaire(): string
    {
        //url associe le chemin qui appelle l'enregistrement d'un commentaire
        $url = $this -> container -> router -> pathFor ( 'ajouterCom', ['token' => $this -> tab['token']] );
        //si il a un commentaire dans les cookies
        if(isset($_COOKIE['commentaire'])){
            //si l'utilisateur est connecter
            if(isset($_COOKIE['iduser'])){
                //on tire le nom du compte utilisateur
                $value = User::find($_COOKIE['iduser'])->nom;
            }else{
                //si n'est pas connecter
                //on tire le nom de la variable commentaire
                $value = $_COOKIE['commentaire'];

            }
            //
            //ajoute la valeur au contenue html
            $content = "<label>Nom :<br> <input type='text' name='nom' value='$value' required/></label><br> ";
        }else{
            //sinon
            //l'input est vide
            $content = "<label>Nom :<br> <input type='text' name='nom' required/></label><br> ";
        }
        //creation du module complet
        $html = <<<FIN
<hr><h1>Ajouter un commentaire a cette liste</h1>
<form method="POST" action="$url">
	$content
	<label>Commentaire : <br><input type='text' name='commentaire' required/></label><br>
	<button class="button" type="submit">Publier</button>
</form>	<br>
FIN;
        //retourne l'html
        return $html;
    }

    //affiche les commentaires de la liste
    public function affichageCommentaire(): string
    {
        //on recupere tout les commentaires
        $com = Commentaire ::all ();
        //si il y a des commentaires pour cette liste
        if (Commentaire ::where ( "id_liste", "=", Liste ::where ( "token", "=", $this -> tab['token'] ) -> first () -> no ) -> first () != null) {
            //on affiche
            $html = "<hr><h1>Commentaires</h1>";
        } else {
            //si il n'y a pas de commentaire
            //on affiche
            $html = "<hr><h1>Aucun commentaires</h1>";
        }
        //pour chaque commentaire dans com
        foreach ($com as $c) {
            //si il appartient a la liste
            if ($c -> id_liste == Liste ::where ( "token", "=", $this -> tab['token'] ) -> first () -> no) {
                //on l'ajoute a l'html
                $html .= "<h3>$c->nom : $c->text</h3>";
            }
        }
        //retourne l'html
        return $html;
    }

    //affiche le mode modification
    private function uneListeModif(): string
    {
        //on affiche les caracteristique de la liste
        $html = "<h1 class='important'>Mode modification</h1>";
        $html .= "<h1>Liste : {$this->tab['titre']}</h1>";
        $html .= "<h3>Description : {$this->tab['description']}</h3>";
        $html .= "<h3>Clé de partage : {$this->tab['token']}</h3>";
        $html .= $this -> afficherItems ();
        //si elle n'est pas expirer
        if ($this -> tab['date'] >= date ( "Y-m-d" )) {
            //on definie les routes des diferentes fonctions
            $url_additem = $this -> container -> router -> pathFor ( 'additem', ['tokenModif' => $this -> tab['tokenModif'], "no" => $this -> tab['no']] );
            $url_modif = $this -> container -> router -> pathFor ( 'listemodif', ['tokenModif' => $this -> tab['tokenModif']] );
            $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $this -> tab['tokenModif']] );
            //creer les boutons
            $html .= "<a class='button' href='$url_additem'>Ajouter un item</a>
                      <a class='button' href='$url_modif'>Modifier la liste</a>
                      <a class='button red' href='$url_suppr'>Supprimer la liste</a>";
        } else {
            //si elle est expirer
            //definie le chemin de suppression de liste
            $url_suppr = $this -> container -> router -> pathFor ( 'supprimerliste', ['tokenModif' => $this -> tab['tokenModif']] );
            //place le bouton dans l'html
            $html .= "<a class='button' href='$url_suppr'>Supprimer la liste</a>";
        }
        //retourn l'html
        return $html;
    }

    private function afficherItems(): string
    {
        //initialise le tableau
        $html = "<table class='styled-table' ><thead><tr><td>Image</td><td>Item</td><td>Description</td><td>Url</td><td>Tarif</td><td>Réservation</td><td>Action</td></tr></thead><tbody>";
        //si il y a des items
        if (count ( $this -> tab['item'] ) != 0) {
            //pour chaque item
            foreach ($this -> tab['item'] as $item) {
                //creation des chemins
                $url_modif = $this->container->router->pathFor('modifitem', ['tokenModif' => $this->tab['tokenModif'], 'no' => $item['id']]);
                $url_suppr = $this->container->router->pathFor('supprimeritem', ['tokenModif' => $this->tab['tokenModif'], 'no' => $item['id']]);
                //si il y a une image
                if (file_exists("../uploads/{$item['img']}")) {
                    //on l'ajoute au module de l'item
                    $img = "../uploads/{$item['img']}";
                } else {
                    //sinon
                    //on met l'image de base
                    $img = "../uploads/base.png";
                }
                //si la liste est expirer et que l'item est reserver
                if (Liste::where("no", "=", $item['liste_id'])->first()->expiration < date("Y-m-d") && $item['etat'] == 1) {
                    //on recupere le participant
                    $p = Participation::where("id_item", "=", $item["id"])->first();
                    //on affiche les detailles dans l'html
                    $etat = "<pre>Réserver par : " . $p->nom . " <br>Commentaire : " . $p->commentaire . "</pre>";
                } else {
                    //sinon
                    //si l'etat vos 1
                    if ($item['etat'] == 1) {
                        //on met l'etat a reservé
                        $etat = "Réservé";
                    } else {
                        //sinon
                        //on met l'etat a disponible
                        $etat = "Disponible";
                    }
                }
                //on creer l'html
                $html .= "<tr><td><img style='height:80px; width: 80px;' src='$img'></td>
                          <td>{$item['nom']}</td> <td>{$item['descr']}</td> <td>{$item['url']}</td><td>{$item['tarif']}</td><td>{$etat}</td>
                          <td><a href='$url_modif'><i class='fa fa-edit'></i></a>
                          <a href='$url_suppr'><i class='fa fa-trash'></i></a></td></tr>";
            }
        //si il n'y a pas d'item
        } else {
            //on affiche aucun item
            $html .= "<tr><td>Aucun item</td> <td>--</td><td>--</td><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
        }
        //ferme les baises
        $html .= "</tbody></table>";
        //return le resultat
        return $html;
    }
    //methode de rendu
    public function render(int $select): string
    {
        switch ($select) {
            //dans le cas 0
            case 0 :
            {
                //affiche les listes publiques
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> lesListes ();
                break;
            }
            //dans le cas 1
            case 1 :
            {
                //affiche la creation de liste
                $menu = "";
                VuePrincipale ::$content = $this -> creerliste ();
                break;
            }
            //dans le cas 2
            case 2 :
            {
                //affiche les listes publiques expirer
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> lesListesexpire ();
                break;
            }
            //dans le cas 3
            case 3 :
            {
                //affiche la liste courante
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> uneListe ();
                break;
            }
            //dans le cas 4
            case 4 :
            {
                //affiche la modification de liste
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> modifliste ();
                break;
            }
            //dans le cas 6
            case 6 :
            {
                //affiche l'ajout de liste
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> ajouterUneListe ();
                break;
            }
            //dans le cas 7
            case 7 :
            {
                //affiche le token de modification
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> donnerTokenModif ();
                break;
            }
            //dans le cas 8
            case 8 :
            {
                //affiche la modification de liste
                $menu = $this -> menulistesPubliques ();
                VuePrincipale ::$content = $this -> uneListeModif ();
                break;
            }
            //dans le cas 9
            case 9 :
            {
                //affiche les listes privees
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> meslistes ();
                break;
            }
            //dans le cas 10
            case 10 :
            {
                //affiche les listes privees expirees
                $menu = $this -> menuMeslistes ();
                VuePrincipale ::$content = $this -> meslistesexpires ();
                break;
            }
        }

        VuePrincipale ::$inMenu = $menu;





        return substr ( include ("html/index.php"), 1, -1 );
    }

}
