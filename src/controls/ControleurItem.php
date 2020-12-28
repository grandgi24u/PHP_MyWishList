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
                $item = Item::find($i->id_item);
                $liste = Liste::find($item->liste_id);
                if($liste->expiration > date("Y-m-d")){
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
                $item = Item::find($i->id_item);
                $liste = Liste::find($item->liste_id);
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

    public function modifitem(Request $rq, Response $rs, $args): Response
    {
        $i = Item::where("id", "=", $args['no'])->first();
        $vue = new VueItem($i->toArray(), $this->container);
        $rs->getBody()->write($vue->render(3));
        return $rs;
    }

    public function modifieritem(Request $rq, Response $rs, $args): Response
    {
        $post = $rq->getParsedBody();
        $nom = filter_var($post['nom'], FILTER_SANITIZE_STRING);
        $descr = filter_var($post['descr'], FILTER_SANITIZE_STRING);
        $url = filter_var($post['url'], FILTER_SANITIZE_STRING);
        $tarif = filter_var($post['tarif'], FILTER_SANITIZE_STRING);

        $i = Item::where("id", "=", $args['no'])->first();
        $i->nom = $nom;
        $i->descr = $descr;
        $i->url = $url;
        $i->tarif = $tarif;
        $i->save();

        $url_liste = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_liste);
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
        if(filter_var($post['url'] , FILTER_SANITIZE_STRING) !== null){
            $item->url = filter_var($post['url'] , FILTER_SANITIZE_STRING);
        }
        $item->save();

        $url_listes = $this->container->router->pathFor( 'afficherlistes' ) ;
        return $rs->withRedirect($url_listes);
    }

    public function supprimeritem(Request $rq, Response $rs, $args): Response
    {
        Item::where("id", "=", $args['no'])->first()->delete();
        $url_listes = $this->container->router->pathFor('afficherlistes');
        return $rs->withRedirect($url_listes);
    }


}