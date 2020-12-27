<?php


namespace mywishlist\controls;


use mywishlist\controls\ControleurItem;
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
            if (isset($_SESSION['iduser'])) {
                if($l->user_id == $_SESSION['iduser']){
                    if($l->expiration >= date("Y-m-d")){
                        $lf[] = $l;
                    }
                }
            } else {
                if($l->user_id == NULL) {
                    if($l->expiration >= date("Y-m-d")){
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }

    public function afficherlistesexpire(Request $rq, Response $rs, $args) : Response {
        $listl = Liste::all() ;
        $lf = array();
        foreach ($listl as $l){
            if (isset($_SESSION['iduser'])) {
                if($l->user_id == $_SESSION['iduser']){
                    if($l->expiration < date("Y-m-d")){
                        $lf[] = $l;
                    }
                }
            } else {
                if($l->user_id == NULL){
                    if($l->expiration < date("Y-m-d")){
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 2 ) ) ;
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
        $date = filter_var($post['date'] , FILTER_SANITIZE_STRING) ;
        if (isset($_SESSION['iduser'])) {
            $user_id = $_SESSION['iduser'] ;
        } else {
            $user_id = NULL ;
        }
        $l = new Liste();
        $l->titre = $titre;
        $l->description = $description;
        $l->expiration = $date;
        $l->user_id = $user_id;
        $l->token = $this->creerToken ();
        $l->save();

        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }

    public function creerToken() : String {
        return bin2hex(random_bytes(10));
    }

    public function afficherUneListe(Request $rq, Response $rs, $args) : Response {
        $liste = Liste::find( $args['no'] );

        $array = array();

        $array['no'] = $liste->no;
        $array['titre'] = $liste->titre;
        $array['description'] = $liste->description;
        $array['date'] = $liste->expiration;
        $array['token'] = $liste->token;
        $array['item'] = ControleurItem::retournerItemsListe($args['no']);

        $vue = new VueListe( $array , $this->container ) ;
        $rs->getBody()->write( $vue->render( 3 ) ) ;
        return $rs;
    }

    public function supprimerliste(Request $rq, Response $rs, $args) : Response {
        Liste::find( $args['no'] )->delete();
        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }

    public function listemodif(Request $rq, Response $rs, $args) : Response {
        $liste = Liste::find( $args['no'] );
        $vue = new VueListe( $liste->toArray() , $this->container ) ;
        $rs->getBody()->write( $vue->render( 4 ) ) ;
        return $rs;
    }

    public function modifierliste(Request $rq, Response $rs, $args) : Response {
        $post = $rq->getParsedBody() ;
        $titre       = filter_var($post['titre']       , FILTER_SANITIZE_STRING) ;
        $description = filter_var($post['description'] , FILTER_SANITIZE_STRING) ;
        $date = filter_var($post['date'] , FILTER_SANITIZE_STRING) ;

        $l = Liste::find($args['no']);
        $l->titre = $titre;
        $l->description = $description;
        $l->expiration = $date;
        $l->save();

        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }

    public function rechercher(Request $rq, Response $rs, $args) : Response {
        $post = $rq->getParsedBody() ;

        $token = filter_var($post['token'], FILTER_SANITIZE_STRING) ;

        $l = Liste::where("token", "=", $token)->first();

        $no = $l->no;

        $url_listes = $this->container->router->pathFor( 'afficherUneListe', ['no' => $no]);

        return $rs->withRedirect($url_listes);
    }

    public function recherchenul(Request $rq, Response $rs, $args) : Response {
        $vue = new VueListe( [] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 5 ) ) ;
        return $rs;
    }

}