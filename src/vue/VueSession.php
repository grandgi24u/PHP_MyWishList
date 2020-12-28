<?php

namespace mywishlist\vue;

class VueSession extends VuePrincipale
{

    private $tab;
    private $container;

    public function __Construct($t, $c)
    {
        $this -> tab = $t;
        $this -> container = $c;
        parent ::__construct ( $t, $c );
    }

    private function formEnregistrement(): string
    {
        $url_nouveaulogin = $this -> container -> router -> pathFor ( 'nouvelEnregistrement' );
        $html = <<<FIN
<form method="POST" action="$url_nouveaulogin">
    <br><label>Nom : <br><input type="text" name="nom"/></label><br>
    <label>Prenom : <br><input type="text" name="prenom"/></label><br>
	<label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	
	<button class="button" type="submit">Creer le compte</button>
</form>	
FIN;
        return $html;
    }

    private function connexion(): string
    {
        $url_testpass = $this -> container -> router -> pathFor ( 'testerConnexion' );
        $html = <<<FIN
<form method="POST" action="$url_testpass">
	<br><label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	<button class="button" type="submit">Se connecter</button>
</form>	
FIN;
        return $html;
    }

    private function compte(): string
    {
        if(isset($_SESSION['iduser'])){
            $login = $this -> tab['login'];
            $nom = $this -> tab['nom'];
            $prenom = $this -> tab['prenom'];

            $html = <<<FIN
<ul>
<li><p>Votre login : $login</p></li>
<li><p>Votre nom : $nom</p></li>
<li><p>Votre prenom : $prenom</p></li>
</ul>

FIN;
        }else{
            $html = "<h1>Vous devez etre connecté</h1>";
        }

        return $html;
    }

    public function render(int $select): string
    {

        switch ($select) {
            case 0 :
            {
                VuePrincipale ::$content = $this -> formEnregistrement ();
                break;
            }
            case 1 :
            {
                VuePrincipale ::$content = 'Votre compte avec le login <b>' . $this -> tab['login'] . '</b> a été créé';
                break;
            }
            case 2 :
            {
                $url_deconnexion = $this -> container -> router -> pathFor ( 'deconnexion' );
                VuePrincipale ::$content = "<a href='$url_deconnexion'>Deconnexion</a>";
                break;
            }
            case 3 :
            {
                VuePrincipale ::$content = $this -> connexion ();
                break;
            }
            case 4 :
            {
                $res = ($this -> tab['res']) ? 'connecté' : 'pas connecté';
                VuePrincipale ::$content = 'Vous etes <b>' . $res . '</b>';
                break;
            }
            case 5 :
            {
                VuePrincipale ::$content = $this -> compte ();
            }
        }

        VuePrincipale::$inMenu = "";

        return substr(include ("html/index.php"), 1,-1);
    }

}