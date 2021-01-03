<?php

namespace mywishlist\vue;

use mywishlist\models\User;

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
            $url = $this->container->router->pathFor('supprimercompte', ["login" => User::find($_SESSION['iduser'])->login]);
            $url_2 = $this->container->router->pathFor('modifierCompte', ["login" => User::find($_SESSION['iduser'])->login]);
            $html = <<<FIN
<h1>Votre compte</h1>

<p>Votre login : {$this->tab['login']}</p>
<p>Votre nom : {$this->tab['nom']}</p>
<p>Votre prénom : {$this->tab['prenom']}</p><br>

<a class='button' href='$url_2'>Modifier le compte</a>
<a class='button red' href='$url'>Supprimer le compte</a>

FIN;
        }else{
            $html = "<h1>Vous devez etre connecté</h1>";
        }

        return $html;
    }

    private function modifierCompte(): string
    {
        $url = $this -> container -> router -> pathFor ( 'modifierCompteA' );
        $html = <<<FIN
<form method="POST" action="$url">
	<br><label>Nom :<br> <input type="text" name="nom" value="{$this->tab['nom']}"/></label><br>
	<label>Prenom :<br> <input type="text" name="prenom" value="{$this->tab['prenom']}"/></label><br>
	<label>Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	<button class="button" type="submit">Se connecter</button>
</form>	
FIN;
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
                VuePrincipale ::$content = "<h1>Vous etes déjà connecté</h1>";
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
                break;
            }
            case 6 :
            {
                VuePrincipale ::$content = $this -> modifierCompte ();
                break;
            }
        }

        VuePrincipale::$inMenu = "";

        return substr(include ("html/index.php"), 1,-1);
    }

}