<?php

namespace mywishlist\vue;

use mywishlist\models\User;

class VueSession extends VuePrincipale
{

    private $tab;
    private $container;
    //Constructeur de vue VueSession
    public function __Construct($t, $c)
    {
        //herite du constructeur de VuePrincipale
        parent ::__construct ( $t, $c );
    }
    //Cette methode genere du formulaire d'enregistrement
    private function formEnregistrement(): string
    {
        //Definition du path qui appelle un nouvelle enregistement
        $url_nouveaulogin = $this -> container -> router -> pathFor ( 'nouvelEnregistrement' );
        //definition du formulaire html qui recupere les informations d'enregistremnts
        $html = <<<FIN
<form method="POST" action="$url_nouveaulogin">
    <br><label>Nom : <br><input type="text" name="nom"/></label><br>
    <label>Prenom : <br><input type="text" name="prenom"/></label><br>
	<label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	
	<button class="button" type="submit">Creer le compte</button>
</form>	
FIN;
        //retourne le formulaire
        return $html;
    }
    //Cette methode genere le formulaire de connexion
    private function connexion(): string
    {
        //Definition du path qui appelle un nouvelle tentative de connexion
        $url_testpass = $this -> container -> router -> pathFor ( 'testerConnexion' );
        //definition du formulaire html qui recupere les informations de connexion
        $html = <<<FIN
<form method="POST" action="$url_testpass">
	<br><label>Identifiant :<br> <input type="text" name="login"/></label><br>
	<label>Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	<button class="button" type="submit">Se connecter</button>
</form>	
FIN;
        //retourne le formulaire
        return $html;
    }
    //Cette methode retourne la vue des information de l'utilisateur
    private function compte(): string
    {
        //si la variable de session iduser existe
        //l'utilisateur est connecte
        if(isset($_SESSION['iduser'])){
            //definition de la route du bouton qui mene a la suppression du compte
            $url = $this->container->router->pathFor('supprimercompte', ["login" => User::find($_SESSION['iduser'])->login]);
            //definition de la route du bouton qui mene a la modification des informations du compte
            $url_2 = $this->container->router->pathFor('modifierCompte', ["login" => User::find($_SESSION['iduser'])->login]);
            //Contenue html de la vue Session lorsque l'utilisateur est connecte
            $html = <<<FIN
<h1>Votre compte</h1>

<p>Votre login : {$this->tab['login']}</p>
<p>Votre nom : {$this->tab['nom']}</p>
<p>Votre prénom : {$this->tab['prenom']}</p><br>

<a class='button' href='$url_2'>Modifier le compte</a>
<a class='button red' href='$url'>Supprimer le compte</a>

FIN;
        }else{
            //si iduser n'existe pas
            //un message previens que l'utilisateur dois ce connecter
            $html = "<h1>Vous devez etre connecté</h1>";
        }
        //retourne le les information du compte
        //ou l'alerte
        return $html;
    }

    private function modifierCompte(): string
    {
        $url = $this -> container -> router -> pathFor ( 'modifierCompteA' );
        $html = <<<FIN
<form method="POST" action="$url">
	<br><label>Nom :<br> <input type="text" name="nom" value="{$this->tab['nom']}"/></label><br>
	<label>Prenom :<br> <input type="text" name="prenom" value="{$this->tab['prenom']}"/></label><br>
	<label>Ancien Mot de passe : <br><input type="password" name="oldpass"/></label><br><br>
	
	<h2>Ne pas remplir pour ne pas changer son mot de passe</h2>
	<label>Nouveau Mot de passe : <br><input type="password" name="pass"/></label><br><br>
	
	<button class="button" type="submit">Enregistrer</button>
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
                ($this -> tab['res']) ? VuePrincipale ::$content = 'Vous etes <b>connecté</b>' : VuePrincipale ::$content = 'Votre mot de passe est <b>Incorrect</b>';
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