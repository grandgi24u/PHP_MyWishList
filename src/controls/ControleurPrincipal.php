<?php

namespace mywishlist\controls;

use mywishlist\vue\VuePrincipale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class ControleurPrincipal{

    private $container;
    //contructeur du Controleur
    public function __construct($container) {
        $this->container = $container;
    }
    //Cette Methode envoie la vue principale
    public function accueil(Request $rq, Response $rs, $args) : Response {
        //creation de l'instanbce de la vue principale
        $vue = new VuePrincipale( [] , $this->container ) ;
        //implementation du contenue de la page dans le body avec le parametre 0
        $rs->getBody()->write( $vue->render( 0 ) ) ;
        //retoutrn la reponse
        return $rs;
    }
}