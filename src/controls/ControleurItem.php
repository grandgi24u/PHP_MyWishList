<?php

namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Participation;
use mywishlist\vue\VueItem;
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
                $lf[] = Item::where('id','=', $i->id_item)->first();
            }
        }
        $vue = new VueItem( $lf , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }

}