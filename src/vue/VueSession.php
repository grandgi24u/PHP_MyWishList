<?php

namespace mywishlist\vue;

class VueSession extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t,$c){
        $this->tab = $t;
        $this->container = $c;
        parent::__construct($t,$c);
    }

    private function formEnregistrement(): String {
        $url_nouveaulogin = $this->container->router->pathFor( 'nouvelEnregistrement' ) ;
        $html = <<<FIN
<form method="POST" action="$url_nouveaulogin">
    <label>Nom : <br><input type="text" name="nom"/></label><br>
    <label>Prenom : <br><input type="text" name="prenom"/></label><br>
	<label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="text" name="pass"/></label><br>
	
	<button type="submit">Creer le compte</button>
</form>	
FIN;
        return $html;
    }

    private function connexion() : string {
        $url_testpass = $this->container->router->pathFor( 'testerConnexion' ) ;
        $html = <<<FIN
<form method="POST" action="$url_testpass">
	<label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="text" name="pass"/></label><br>
	<button type="submit">Se connecter</button>
</form>	
FIN;
        return $html;
    }

    public function render(int $select): String {

        switch($select){
            case 0 : {
                VuePrincipale::$content = $this->formEnregistrement();
                break;
            }
            case 1 : {
                VuePrincipale::$content = 'Login <b>'.$this->tab['login'].'</b> enregistré';
                break;
            }
            case 2 : {
                $url_deconnexion    = $this->container->router->pathFor( 'deconnexion' ) ;
                VuePrincipale::$content = "<a href='$url_deconnexion'>Deconnexion</a>";
                break;
            }
            case 3 : {
                VuePrincipale::$content = $this->connexion();
                break;
            }
            case 4 : {
                $res = ($this->tab['res'])? 'OK' : 'KO';
                VuePrincipale::$content = 'Mot de passe <b>'.$res.'</b>';
                break;
            }
        }

        return include("html/index.php");
    }

}