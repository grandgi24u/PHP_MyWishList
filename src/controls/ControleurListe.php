<?php


namespace mywishlist\controls;


use mywishlist\models\Liste;
use mywishlist\vue\VueListe;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurListe
{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function afficherListes(Request $rq, Response $rs, $args) : Response {
        $listl = Liste::all() ;
        $lf = array();
        foreach ($listl as $l){
            if($l->user_id == $_SESSION['iduser']){
                $lf[] = $l;
            }
        }
        $vue = new VueListe( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }

    public function creerliste(Request $rq, Response $rs, $args) : Response {
        $vue = new VueListe( [] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 1 ) ) ;
        return $rs;
    }

    public function nouvelleListe(Request $rq, Response $rs, $args) : Response  {

        $post = $rq->getParsedBody() ;
        $titre       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $user_id = $_SESSION['iduser'] ;
        $l = new Liste();
        $l->titre = $titre;
        $l->description = $description;
        $l->user_id = $user_id;
        $l->save();

        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }


}