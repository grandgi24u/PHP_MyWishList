<?php


namespace mywishlist\controls;

use mywishlist\vue\VueErreur;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurErreur
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function besoinconnection(Request $rq, Response $rs, $args) : Response {
        $vue = new VueErreur([], $this->container);
        $rs->getBody()->write($vue->render(0));
        return $rs;
    }


    public function listnotfound(Request $rq, Response $rs, $args) : Response {
        $vue = new VueErreur([], $this->container);
        $rs->getBody()->write($vue->render(1));
        return $rs;
    }

    public function listappartient(Request $rq, Response $rs, $args) : Response {
        $vue = new VueErreur([], $this->container);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function itemreserver(Request $rq, Response $rs, $args) : Response {
        $vue = new VueErreur([], $this->container);
        $rs->getBody()->write($vue->render(3));
        return $rs;
    }

}