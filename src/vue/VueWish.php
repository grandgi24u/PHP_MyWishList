<?php


namespace mywishlist\vue;


class VueWish
{
    private $tab; // tab array PHP
    private $container;

    public function __construct($tab, $container) {
        $this->tab = $tab;
        $this->container = $container;
    }

    private function lesListes() : string {
        $html = '';
        foreach($this->tab as $liste){
            $html .= "<li>{$liste['titre']}, {$liste['description']}</li>";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }

    private function uneListe() : string {
        $l = $this->tab[0];
        $html = "<h2>Liste {$l['no']}</h2>";
        $html .= "<b>Titre:</b> {$l['titre']}<br>";
        $html .= "<b>Description:</b> {$l['description']}<br>";
        return $html;
    }

    private function unItem() : string {
        $i = $this->tab[0];
        $html = "<h2>Item {$i['id']}</h2>";
        $html .= "<b>Nom:</b> {$i['nom']}<br>";
        $html .= "<b>Descr:</b> {$i['descr']}<br>";
        return $html;
    }

    private function formListe() : string {
        $url_new_liste = $this->container->router->pathFor( 'newListe' ) ;
        $html = <<<FIN
<form method="POST" action="$url_new_liste">
	<label>Titre:<br> <input type="text" name="titre"/></label><br>
	<label>Description: <br><input type="text" name="description"/></label><br>
	<button type="submit">Enregistrer la liste</button>
</form>	
FIN;
        return $html;
    }

    private function formlogin() : string {
        $url_nouveaulogin = $this->container->router->pathFor( 'nouveaulogin' ) ;
        $html = <<<FIN
<form method="POST" action="$url_nouveaulogin">
	<label>Login:<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe: <br><input type="text" name="pass"/></label><br>
	<button type="submit">Enregistrer le login</button>
</form>	
FIN;
        return $html;
    }

    private function testform() : string {
        $url_testpass = $this->container->router->pathFor( 'testpass' ) ;
        $html = <<<FIN
<form method="POST" action="$url_testpass">
	<label>Login:<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe: <br><input type="text" name="pass"/></label><br>
	<button type="submit">Tester le login</button>
</form>	
FIN;
        return $html;
    }

    public function render( int $select ) : string {

        switch ($select) {
            case 0 : {
                $content = 'accueil racine du site';
                break;
            }
            case 1 : { // liste des listes
                $content = $this->lesListes();
                break;
            }
            case 2 : { // liste 1
                $content = $this->uneListe();
                break;
            }
            case 3 : { // un item
                $content = $this->unItem();
                break;
            }
            case 5 : {
                $content = $this->formListe();
                break;
            }
            case 6 : {
                $content = $this->formlogin();
                break;
            }
            case 7 : {
                $content = 'Login <b>'.$this->tab['login'].'</b> enregistré';
                break;
            }
            case 8 : {
                $content = $this->testform();
                break;
            }
            case 9 : {
                $res = ($this->tab['res'])? 'OK' : 'KO';
                $content = 'Mot de passe <b>'.$res.'</b>';
                break;
            }
            case 10 : {
                $url_deconnexion    = $this->container->router->pathFor( 'deconnexion' ) ;
                $content = "<a href='$url_deconnexion'>Deconnexion</a>";
                break;
            }

        }

        $url_accueil    = $this->container->router->pathFor( 'racine'                 ) ;
        $url_listes     = $this->container->router->pathFor( 'aff_listes'             ) ;
        $url_liste_1    = $this->container->router->pathFor( 'aff_liste', ['no' => 1] ) ;
        $url_item_2     = $this->container->router->pathFor( 'aff_item' , ['id' => 2] ) ;
        $url_form_liste = $this->container->router->pathFor( 'formListe'              ) ;
        $url_formlogin  = $this->container->router->pathFor( 'formlogin'              ) ;
        $url_testform   = $this->container->router->pathFor( 'testform'               ) ;

        $html = <<<FIN
<!DOCTYPE html>
<html>
  <head>
    <title>Exemple</title>
  </head>
  <body>
		<h1><a href="$url_accueil">Wish List</a></h1>
		<nav>
			<ul>
				<li><a href="$url_accueil">Accueil</a></li>
				<li><a href="$url_listes">Listes</a></li>
				<li><a href="$url_liste_1">Liste 1</a></li>
				<li><a href="$url_item_2">Item 2</a></li>
				<li><a href="$url_form_liste">Nouvelle Liste</a></li>
				<li><a href="$url_formlogin">Nouveau login</a></li>
				<li><a href="$url_testform">Test login</a></li>
			</ul>
		</nav>
    $content
  </body>
</html>
FIN;
        return $html;
    }

}