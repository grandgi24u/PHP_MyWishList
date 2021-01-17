<?php


namespace mywishlist\controls;

use mywishlist\models\User;
use mywishlist\vue\VueAlert;
use mywishlist\vue\VueSession;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurSession
{

    private $container;

    public function __construct($container)
    {
        $this -> container = $container;
    }


    //Controleur du formulaire pour créer un compte
    public function formEnregistrement(Request $rq, Response $rs, $args): Response
    {
        //creation de l'instance vueSession
        $vue = new VueSession( [], $this -> container );
        //Implementation de la reponse de la vue dans le body
        $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        //envoi de la reponse
        return $rs;
    }

    //Controleur pour verifier l'existance du login ou pas
    public function nouvelEnregistrement(Request $rq, Response $rs, $args): Response
    {
        //Recuperation des informations du formulaire dans un tableau post
        $post = $rq -> getParsedBody ();
        //nom associe le nom entré par l'utisateur
        $nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        //prenom associe le prenom entré par l'utisateur
        $prenom = filter_var ( $post['prenom'], FILTER_SANITIZE_STRING );
        //login associe le login entré par l'utisateur
        $login = filter_var ( $post['login'], FILTER_SANITIZE_STRING );
        //nom pass le mot de passe entré par l'utisateur
        $pass = filter_var ( $post['pass'], FILTER_SANITIZE_STRING );

        //Virifie qu'il n'exite pas un utilisateur avec ce login dans la base de donnée
        $nb = User ::where ( 'login', '=', $login ) -> count ();
        if ($nb == 0) {
            //s'il n y en a pas
            //on creer un instance user
            $u = new User();

            $u -> nom = $nom;
            $u -> prenom = $prenom;
            $u -> login = $login;
            //On hash le mot de passe avec l'algorithme "PASSWORD_DEFAULT"
            $u -> pass = password_hash ( $pass, PASSWORD_DEFAULT );
            //enfin on envoie l'utilsateur dans la db
            $u -> save ();
        } else {
            //Si il existe deja on remplce le login par ce message
            $login = 'existe déjà';
        }
        //On instancie une nouvelle vu session
        $vue = new VueSession( ['login' => $login], $this -> container );
        //on implement le body venant d'une vueSession dans le cas 1
        $rs -> getBody () -> write ( $vue -> render ( 1 ) );
        //On envoie la reponse
        return $rs;
    }


    //Controleur pour se connecter
    public function Connexion(Request $rq, Response $rs, $args): Response
    {
        //on insantie une nouvelle vueSession
        $vue = new VueSession( [], $this -> container );
        //si la variable de session iduser existe
        //alors l' utilisateur est deja connecter
        if (isset( $_SESSION['iduser'] )) {
            //La vue sessions rend le cas 2 (utilisateur deja connecter)
            $rs -> getBody () -> write ( $vue -> render ( 2 ) );
        } else {
            //si il n'est pas connetcé
            //La vue sessions rend le cas 3 (formulaire de connexion)
            $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        }
        //on retourne la reponse
        return $rs;
    }

    //Verification du mot de passe
    public function testerConnexion(Request $rq, Response $rs, $args): Response
    {
        //Recuperation des informations du formulaire dans un tableau post
        $post = $rq -> getParsedBody ();
        //login associe le login entré par l'utisateur
        $login = filter_var ( $post['login'], FILTER_SANITIZE_STRING );
        //pass associe le mot de passe entré par l'utisateur
        $pass = filter_var ( $post['pass'], FILTER_SANITIZE_STRING );
        //Si un utilisateur possede ce login dans la db
        if(User ::where ( 'login', '=', $login ) -> first () !== null){
            //u associe l'utilisateur unique du meme login de la db
            $u = User ::where ( 'login', '=', $login ) -> first ();
            //si le mot de passe correspond
            //on creer une variable de session iduser qui contient l'id de l'utilisateur
            if (password_verify ( $pass, $u -> pass )) $_SESSION['iduser'] = $u -> id;
            //On creer un instance de session qui prend en parametre le resultat du password verify
            $vue = new VueSession( ['res' => password_verify ( $pass, $u -> pass )], $this -> container );
            //On implement le rendu 4 de la vueSessionn au body de la reponse (validation)
            $rs -> getBody () -> write ( $vue -> render ( 4 ) );
        }else{
            //si il n'y a pas d'utilisateur
            //on creer une alerte
            $vue = new VueAlert( [], $this -> container );
            //a la quelle demande le rendue 6 (erreur de connection)
            $rs -> getBody () -> write ( $vue -> render ( 6 ) );
        }
        //on renvoie la reponse
        return $rs;
    }

    //Fin de la session
    public function deconnexion(Request $rq, Response $rs, $args): Response
    {
        //detruit la session
        session_destroy ();
        //Reinitialisation de la session a []
        $_SESSION = [];
        //creation d'une nouvelle vue session
        $vue = new VueSession( [], $this -> container );
        //Implementation du rendu 3 dans la reponse
        $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        //retourne la response
        return $rs;
    }

    //Affichage mon compte
    public function compte(Request $rq, Response $rs, $args): Response
    {
        //Si l'utilisateur est connecter
        if(isset($_SESSION['iduser'])){
            //recuperation de l'utilisateur dans la db
            $user = User ::find ( $_SESSION['iduser'] );
            //creation d'une vue session
            //Elle contient les informations du user
            $vue = new VueSession( [
                'login' => $user -> login,
                'nom' => $user -> nom,
                'prenom' => $user -> prenom
            ], $this -> container );
        }else{
            //si personnes n'est conétcet
            //on renvoie une sessions vide
            $vue = new VueSession([], $this->container);
        }
        //Implementation du rendu 5 dans la reponse
        $rs -> getBody () -> write ( $vue -> render ( 5 ) );
        //on envoie la reponse
        return $rs;
    }

    // Pour supprimer son compte de la base de données
    public function supprimercompte(Request $rq, Response $rs, $args): Response
    {
        //Si l'utilisateur est connecter
        if(isset($_SESSION['iduser'])){
            //recuperation de l'utilisateur dans la db
            User::find($_SESSION['iduser'])->delete();
            //definition du chemin pour deconnecter le client
            $url = $this -> container -> router -> pathFor ( 'deconnexion' );
            //Implementation du chemin en redirection dans la reponse
            $rs = $rs -> withRedirect ( $url );
        }else{
            //si il n'est pas connecter
            //on cree une alerte
            $vue = new VueAlert([], $this->container);
            //Implementation du rendu 0 dans la reponse
            $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        }
        //retourne reponse
        return $rs;
    }

    public function modifierCompte(Request $rq, Response $rs, $args): Response
    {
        //Si l'utilisateur est connecter
        if(isset($_SESSION['iduser'])){
            //creation d'une vue session
            //elle contient les informations du user
            $vue = new VueSession( User::find($_SESSION['iduser'])->toArray(), $this -> container );
            //Implementation du rendu 6 dans la reponse
            $rs -> getBody () -> write ( $vue -> render ( 6 ) );
        }else{
            //si il n'est pas connecter
            //on cree une alerte
            $vue = new VueAlert([], $this->container);
            //Implementation du rendu 0 dans la reponse
            $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        }
        //retourne reponse
        return $rs;
    }

    public function modifierCompteA(Request $rq, Response $rs, $args): Response
    {
        //Recuperation des informations du formulaire dans un tableau post
        $post = $rq -> getParsedBody ();
        //recuperation de l'utilisateur dans la db
        $u = User::find($_SESSION['iduser']);
        //on modifie les variables par celle donner par le client
        //on remplace le nom
        $u->nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        //on remplace le prenom
        $u->prenom = filter_var ( $post['prenom'], FILTER_SANITIZE_STRING );
        //Si le mot de passe n'est pas vide
        if(filter_var ( $post['pass'], FILTER_SANITIZE_STRING ) !== "" ){
            //Si l'anciens mot de passe correspond a celui donné par l'utilisateur
            if(password_verify ( filter_var ( $post['oldpass'], FILTER_SANITIZE_STRING ), $u -> pass )){
                //On remplace le nouveau mot de passe
                $u->pass = password_hash ( filter_var ( $post['pass'], FILTER_SANITIZE_STRING ), PASSWORD_DEFAULT );
                //definition du chemin vers le message de validation
                $url = $this -> container -> router -> pathFor ( 'motdepasse' );
            }else{
                //si le mot de passe ne correspond pas
                //definition du chemin vers le message d'echec
                $url = $this -> container -> router -> pathFor ( 'echecmotdepasse' );
            }
        }else{
            //definition du chemin l'affichage du compte
            $url = $this -> container -> router -> pathFor ( 'compte', ['login' => $_SESSION['iduser']] );
        }
        //sauvegarde de l'utilisateur modifié
        $u->save();
        //retourne la reponse
        return $rs -> withRedirect ($url);
    }

}