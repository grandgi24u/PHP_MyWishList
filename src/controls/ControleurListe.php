<?php


namespace mywishlist\controls;

use mywishlist\models\Liste;
use mywishlist\vue\VueErreur;
use mywishlist\vue\VueListe;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurListe
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function afficherListes(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste::all();
        $lf = array();
        foreach ($listl as $l) {
            if (isset($_SESSION['iduser'])) {
                if ($l->user_id == $_SESSION['iduser']) {
                    if ($l->expiration >= date("Y-m-d")) {
                        $lf[] = $l;
                    }
                }
            } else {
                if ($l->acces == "public") {
                    if ($l->expiration >= date("Y-m-d")) {
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe($lf, $this->container);
        $rs->getBody()->write($vue->render(0));
        return $rs;
    }

    public function afficherlistesexpire(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste::all();
        $lf = array();
        foreach ($listl as $l) {
            if (isset($_SESSION['iduser'])) {
                if ($l->user_id == $_SESSION['iduser']) {
                    if ($l->expiration < date("Y-m-d")) {
                        $lf[] = $l;
                    }
                }
            } else {
                if ($l->acces == "public") {
                    if ($l->expiration < date("Y-m-d")) {
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe($lf, $this->container);
        $rs->getBody()->write($vue->render(2));
        return $rs;
    }

    public function creerliste(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueListe([], $this->container);
        $rs->getBody()->write($vue->render(1));
        return $rs;
    }

    public function nouvelleListe(Request $rq, Response $rs, $args): Response
    {
        $post = $rq->getParsedBody();
        $titre = filter_var($post['titre'], FILTER_SANITIZE_STRING);
        $description = filter_var($post['description'], FILTER_SANITIZE_STRING);
        $date = filter_var($post['date'], FILTER_SANITIZE_STRING);

        $l = new Liste();
        $l->titre = $titre;
        $l->description = $description;
        $l->expiration = $date;
        $token = $this->creerToken();
        $tokenModif = $this->creerToken();

        if($post['etat'] == "yes"){
            $l->acces = "public";
        }

        if (isset($_SESSION['iduser'])) {
            $user_id = $_SESSION['iduser'];
            $url = $this->container->router->pathFor('afficherUneListe', ["token" => $token]);
        } else {
            $user_id = NULL;
            $url = $this->container->router->pathFor('donnerTokenModif', ["tokenModif" => $tokenModif]);
        }

        $l->token = $token;
        $l->tokenModif = $tokenModif;
        $l->user_id = $user_id;
        $l->save();

        return $rs->withRedirect($url);
    }

    public function creerToken(): string
    {
        $random = bin2hex(random_bytes(10));;//bin2hex(random_bytes(10));
        $liste = Liste::all();
        $same = true;
        $array = array();
        while ($same) {
            foreach ($liste as $l) {
                $array[] = $l->token;
                $array[] = $l->tokenModif;
            }
            if (in_array($random, $array)) {
                $same = true;
                $random = bin2hex(random_bytes(10));
            } else {
                $same = false;
            }
        }
        return $random;
    }

    public function afficherUneListe(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste::where("token", "=", $args['token'])->first();

        $array = array();

        $array['no'] = $liste->no;
        $array['user_id'] = $liste->user_id;
        $array['titre'] = $liste->titre;
        $array['description'] = $liste->description;
        $array['date'] = $liste->expiration;
        $array['token'] = $liste->token;
        $array['item'] = ControleurItem::retournerItemsListe($liste->no);

        $vue = new VueListe($array, $this->container);
        $rs->getBody()->write($vue->render(3));
        return $rs;
    }

    public function supprimerliste(Request $rq, Response $rs, $args): Response
    {
        Liste::where("tokenModif", "=", $args['tokenModif'])->first()->delete();
        $url_listes = $this->container->router->pathFor('afficherlistes');
        return $rs->withRedirect($url_listes);
    }

    public function listemodif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste::where("tokenModif", "=", $args['tokenModif'])->first();
        $vue = new VueListe($liste->toArray(), $this->container);
        $rs->getBody()->write($vue->render(4));
        return $rs;
    }

    public function modifierliste(Request $rq, Response $rs, $args): Response
    {
        $post = $rq->getParsedBody();
        $titre = filter_var($post['titre'], FILTER_SANITIZE_STRING);
        $description = filter_var($post['description'], FILTER_SANITIZE_STRING);
        $date = filter_var($post['date'], FILTER_SANITIZE_STRING);

        $l = Liste::where("tokenModif", "=", $args['tokenModif'])->first();
        $l->titre = $titre;
        $l->description = $description;
        $l->expiration = $date;
        $l->save();

        $url_listes = $this->container->router->pathFor('afficherUneListe', ["token" => $l->token]);
        return $rs->withRedirect($url_listes);
    }

    public function rechercher(Request $rq, Response $rs, $args): Response
    {
        $post = $rq->getParsedBody();
        $token = filter_var($post['token'], FILTER_SANITIZE_STRING);

        $array = array();
        $arraymodif = array();
        foreach (Liste::all() as $li) {
            $array[] = $li->token;
            $arraymodif[] = $li->tokenModif;
        }
        if (in_array($token, $array)) {
            $url_listes = $this->container->router->pathFor('afficherUneListe', ['token' => $token]);
        } else if(in_array($token, $arraymodif)){
            $url_listes = $this->container->router->pathFor('afficherUneListeWithModif', ['tokenModif' => $token]);
        } else {
            $url_listes = $this->container->router->pathFor('recherchenulle');
        }

        return $rs->withRedirect($url_listes);
    }

    public function recherchenulle(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueListe([], $this->container);
        $rs->getBody()->write($vue->render(5));
        return $rs;
    }

    public function ajouterUneListe(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueListe([], $this->container);
        $rs->getBody()->write($vue->render(6));
        return $rs;
    }

    public function sajouterUneListe(Request $rq, Response $rs, $args): Response
    {
        $post = $rq->getParsedBody();
        $token = filter_var($post['token'], FILTER_SANITIZE_STRING);

        $liste = Liste::where("tokenModif", "=", $token)->first();

        $array = array();
        foreach (Liste::all() as $li) {
            $array[] = $li->tokenModif;
        }
        if (in_array($token, $array)) {
            if (isset($_SESSION['iduser'])) {
                if ($liste->user_id == null) {
                    $url = $this->container->router->pathFor('afficherlistes');
                    $liste->user_id = $_SESSION['iduser'];
                    $liste->save();
                } else {
                    $url = $this->container->router->pathFor('listappartient');
                }
            } else {
                $url = $this->container->router->pathFor('besoinconnection');
            }
        } else {
            $url = $this->container->router->pathFor('listnotfound');
        }

        return $rs->withRedirect($url);
    }

    public function donnerTokenModif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste::where("tokenModif", "=", $args['tokenModif'])->first();

        if($liste == null){
            $vue = new VueErreur([], $this->container);
            $rs->getBody()->write($vue->render(1));
        }else{
            $vue = new VueListe($liste->toArray(), $this->container);
            $rs->getBody()->write($vue->render(7));
        }

        return $rs;
    }

    public function afficherUneListeWithModif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste::where("tokenModif", "=", $args['tokenModif'])->first();

        $array = array();

        $array['no'] = $liste->no;
        $array['user_id'] = $liste->user_id;
        $array['titre'] = $liste->titre;
        $array['description'] = $liste->description;
        $array['date'] = $liste->expiration;
        $array['token'] = $liste->token;
        $array['tokenModif'] = $liste->tokenModif;
        $array['item'] = ControleurItem::retournerItemsListe($liste->no);

        $vue = new VueListe($array, $this->container);
        $rs->getBody()->write($vue->render(8));
        return $rs;
    }

}