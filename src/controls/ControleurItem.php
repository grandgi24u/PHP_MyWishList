<?php

namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\models\Participation;
use mywishlist\vue\VueItem;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurItem
{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function afficherItems(Request $rq, Response $rs, $args) : Response {
        $particpation = Participation::all() ;
        $lf = array();
        foreach ($particpation as $i){
            if($i->id_user == $_SESSION['iduser']){
                $item = Item::where('id','=', $i->id_item)->first();
                if(Liste::where('no','=',$item->liste_id)->first()->expiration > date("Y-m-d")){
                    $lf[] = $item;
                }
            }
        }
        $vue = new VueItem( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }

    public function afficherItemsexpire(Request $rq, Response $rs, $args) : Response {
        $particpation = Participation::all() ;
        $lf = array();
        foreach ($particpation as $i){
            if($i->id_user == $_SESSION['iduser']){
                $item = Item::where('id','=', $i->id_item)->first();
                $liste = Liste::where('no','=',$item->liste_id)->first();
                if($liste->expiration < date("Y-m-d")){
                    $lf[] = $item;
                }
            }
        }
        $vue = new VueItem( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 1 ) ) ;
        return $rs;
    }

    public function retournerItemsListe($no) : array {
        $item = Item::all();
        $array = array();
        foreach ($item as $i){
            if($i->liste_id == $no){
                $array[] = $i;
            }
        }
        return $array;
    }

    public function additem(Request $rq, Response $rs, $args) : Response {
        $liste = Liste::find( $args['no'] );
        $vue = new VueItem( $liste->toArray() , $this->container ) ;
        $rs->getBody()->write( $vue->render( 2 ) ) ;
        return $rs;
    }

    public function ajouteritem(Request $rq, Response $rs, $args) : Response {
        $post = $rq->getParsedBody() ;
        $nom = filter_var($post['nom'] , FILTER_SANITIZE_STRING) ;
        $descr = filter_var($post['descr'] , FILTER_SANITIZE_STRING) ;
        $tarif = filter_var($post['tarif'] , FILTER_SANITIZE_STRING) ;

        $item = new Item();
        $item->liste_id = $args['no'];
        $item->nom = $nom;
        $item->descr = $descr;
        $item->tarif = $tarif;
        $item->save();

        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }

}