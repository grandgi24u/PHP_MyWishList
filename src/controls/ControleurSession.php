<?php


namespace mywishlist\controls;

use mywishlist\models\User;
use mywishlist\vue\VueSession;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurSession
{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }


    //Controleur du formulaire pour créer un compte
    public function formEnregistrement(Request $rq, Response $rs, $args) : Response {
        $vue = new VueSession( [] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }

    //Controleur pour verifier l'existance du login ou pas
    public function nouvelEnregistrement(Request $rq, Response $rs, $args) : Response {
        $post = $rq->getParsedBody() ;
        $nom = filter_var($post['nom']       , FILTER_SANITIZE_STRING) ;
        $prenom = filter_var($post['prenom']       , FILTER_SANITIZE_STRING) ;
        $login = filter_var($post['login']       , FILTER_SANITIZE_STRING) ;
        $pass = filter_var($post['pass'] , FILTER_SANITIZE_STRING) ;

        $nb = User::where('login','=',$login)->count();
        if ($nb == 0) {
            $u = new User();
            $u->nom = $nom;
            $u->prenom = $prenom;
            $u->login = $login;
            $u->pass = password_hash($pass, PASSWORD_DEFAULT);
            $u->save();
        } else {
            $login = 'existe déjà';
        }

        $vue = new VueSession( [ 'login' => $login ] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 1 ) ) ;
        return $rs;
    }


    //Controleur pour se connecter
    public function Connexion(Request $rq, Response $rs, $args) : Response {
        $vue = new VueSession( [] , $this->container ) ;
        if (isset($_SESSION['iduser'])) {
            $rs->getBody()->write( $vue->render( 2 ) ) ;
        } else {
            $rs->getBody()->write( $vue->render( 3 ) ) ;
        }
        return $rs;
    }

    //Verification du mot de passe
    public function testerConnexion(Request $rq, Response $rs, $args) : Response {
        $post = $rq->getParsedBody() ;
        $login = filter_var($post['login'], FILTER_SANITIZE_STRING) ;
        $pass = filter_var($post['pass'], FILTER_SANITIZE_STRING) ;
        $u = User::where('login','=',$login)->first();
        $res = password_verify($pass, $u->pass);

        if ($res) $_SESSION['iduser'] = $u->id;

        $vue = new VueSession( [ 'res' => $res ] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 4 ) ) ;
        return $rs;
    }

}