<?php

namespace mywishlist\controls;

use mywishlist\vue\VuePrincipale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class ControleurPrincipal{

    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function accueil(Request $rq, Response $rs, $args) : Response {
        $vue = new VuePrincipale( [] , $this->container ) ;
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        return $rs;
    }


}