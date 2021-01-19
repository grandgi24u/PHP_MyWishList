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
        $this->tab = $t;
        $this->container = $c;
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
        //Definition du path qui appelle une nouvelle tentative de connexion
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
    //Cette methode contient le formulaire de modification de compte
    private function modifierCompte(): string
    {
        //Definition du path qui appelle une nouvelle tentative de modificationn de compte
        $url = $this -> container -> router -> pathFor ( 'modifierCompteA' );
        //Contenue html de la vue Session lorsque l'utilisateur souhaite modifier son compte
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
        //retourne le formulaire
        return $html;
    }
    //Cette Methode envoie la reponse de la vu en fonction du paramettre select
    public function render(int $select): string
    {
        //switch sur le paramettre select
        switch ($select) {
            //Si select vaut 0
            case 0 :
            {
                //Le contenue est le formulaire d'enregistrement
                VuePrincipale ::$content = $this -> formEnregistrement ();
                break;
            }
            //Si select vaut 1
            case 1 :
            {
                //Le contenue est le message de validation
                VuePrincipale ::$content = 'Votre compte avec le login <b>' . $this -> tab['login'] . '</b> a été créé';
                break;
            }
            //Si select vaut 2
            case 2 :
            {
                //Le contenue est un message qui dit qu'il est deja connecte
                VuePrincipale ::$content = "<h1>Vous etes déjà connecté</h1>";
                break;
            }
            //Si select vaut 3
            case 3 :
            {
                //Le contenue est le formulaire de connexion
                VuePrincipale ::$content = $this -> connexion ();
                break;
            }
            //Si select vaut 4
            case 4 :
            {
                //Le contenue est un message d'erreur d'idantification
                ($this -> tab['res']) ? VuePrincipale ::$content = 'Vous etes <b>connecté</b>' : VuePrincipale ::$content = 'Votre mot de passe est <b>Incorrect</b>';
                break;
            }
            //Si select vaut 5
            case 5 :
            {
                //Le contenue est la liste des information du compte
                VuePrincipale ::$content = $this -> compte ();
                break;
            }
            //Si select vaut 6
            case 6 :
            {
                //Le contenue est le formulaire de modification de compte
                VuePrincipale ::$content = $this -> modifierCompte ();
                break;
            }
            //Si select vaut 7
            case 7 :
            {
                //Le contenue est le formulaire de modification de compte
                VuePrincipale ::$content = "<h1>Ce login est déjà pris</h1>";
                break;
            }
        }
        //on vide la variable inMenu
        VuePrincipale::$inMenu = "";
        //on retourn egalement le script index.php qui contient principalement le css
        return substr(include ("html/index.php"), 1,-1);
    }

}