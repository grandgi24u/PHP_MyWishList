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
        $vue = new VueSession( [], $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        return $rs;
    }

    //Controleur pour verifier l'existance du login ou pas
    public function nouvelEnregistrement(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $prenom = filter_var ( $post['prenom'], FILTER_SANITIZE_STRING );
        $login = filter_var ( $post['login'], FILTER_SANITIZE_STRING );
        $pass = filter_var ( $post['pass'], FILTER_SANITIZE_STRING );

        $nb = User ::where ( 'login', '=', $login ) -> count ();
        if ($nb == 0) {
            $u = new User();
            $u -> nom = $nom;
            $u -> prenom = $prenom;
            $u -> login = $login;
            $u -> pass = password_hash ( $pass, PASSWORD_DEFAULT );
            $u -> save ();
        } else {
            $login = 'existe déjà';
        }

        $vue = new VueSession( ['login' => $login], $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 1 ) );
        return $rs;
    }


    //Controleur pour se connecter
    public function Connexion(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueSession( [], $this -> container );
        if (isset( $_SESSION['iduser'] )) {
            $rs -> getBody () -> write ( $vue -> render ( 2 ) );
        } else {
            $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        }
        return $rs;
    }

    //Verification du mot de passe
    public function testerConnexion(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $login = filter_var ( $post['login'], FILTER_SANITIZE_STRING );
        $pass = filter_var ( $post['pass'], FILTER_SANITIZE_STRING );
        if(User ::where ( 'login', '=', $login ) -> first () !== null){
            $u = User ::where ( 'login', '=', $login ) -> first ();
            if (password_verify ( $pass, $u -> pass )) $_SESSION['iduser'] = $u -> id;
            $vue = new VueSession( ['res' => password_verify ( $pass, $u -> pass )], $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 4 ) );
        }else{
            $vue = new VueAlert( [], $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 6 ) );
        }

        return $rs;
    }

    //Fin de la session
    public function deconnexion(Request $rq, Response $rs, $args): Response
    {
        session_destroy ();
        $_SESSION = [];

        $vue = new VueSession( [], $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        return $rs;
    }

    //Affichage mon compte
    public function compte(Request $rq, Response $rs, $args): Response
    {
        if(isset($_SESSION['iduser'])){
            $user = User ::find ( $_SESSION['iduser'] );
            $vue = new VueSession( [
                'login' => $user -> login,
                'nom' => $user -> nom,
                'prenom' => $user -> prenom
            ], $this -> container );
        }else{
            $vue = new VueSession([], $this->container);
        }
        $rs -> getBody () -> write ( $vue -> render ( 5 ) );
        return $rs;
    }

    // Pour supprimer son compte de la base de données
    public function supprimercompte(Request $rq, Response $rs, $args): Response
    {
        if(isset($_SESSION['iduser'])){
            User::find($_SESSION['iduser'])->delete();
            $url = $this -> container -> router -> pathFor ( 'deconnexion' );
            $rs = $rs -> withRedirect ( $url );
        }else{
            $vue = new VueAlert([], $this->container);
            $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        }
        return $rs;
    }

    public function modifierCompte(Request $rq, Response $rs, $args): Response
    {
        if(isset($_SESSION['iduser'])){
            $vue = new VueSession( User::find($_SESSION['iduser'])->toArray(), $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 6 ) );
        }else{
            $vue = new VueAlert([], $this->container);
            $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        }
        return $rs;
    }

    public function modifierCompteA(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $u = User::find($_SESSION['iduser']);

        $u->nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $u->prenom = filter_var ( $post['prenom'], FILTER_SANITIZE_STRING );

        if(filter_var ( $post['pass'], FILTER_SANITIZE_STRING ) !== "" ){
            if(password_verify ( filter_var ( $post['oldpass'], FILTER_SANITIZE_STRING ), $u -> pass )){
                $u->pass = password_hash ( filter_var ( $post['pass'], FILTER_SANITIZE_STRING ), PASSWORD_DEFAULT );
                $url = $this -> container -> router -> pathFor ( 'motdepasse' );
            }else{
                $url = $this -> container -> router -> pathFor ( 'echecmotdepasse' );
            }
        }else{
            $url = $this -> container -> router -> pathFor ( 'compte', ['login' => $_SESSION['iduser']] );
        }

        $u->save();

        return $rs -> withRedirect ($url);
    }

}