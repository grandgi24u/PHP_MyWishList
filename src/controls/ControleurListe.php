<?php

namespace mywishlist\controls;

use mywishlist\models\Commentaire;
use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\models\Participation;
use mywishlist\vue\VueAlert;
use mywishlist\vue\VueListe;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControleurListe
{

    private $container;

    //Constructeur du controleurListe
    public function __construct($container)
    {
        $this -> container = $container;
    }

    // Afficher toutes les listes non expirée (fonction public ou non)
    public function afficherListes(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste ::all () -> sortBy ( 'expiration' );
        $lf = array();
        foreach ($listl as $l) {
            if ($l -> acces == "public") {
                if ($l -> expiration >= date ( "Y-m-d" )) {
                    $lf[] = $l;
                }
            }
        }
        $vue = new VueListe( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        return $rs;
    }

    // Afficher toutes les listes expirées (fonction public ou non)
    public function afficherlistesexpire(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste ::all () -> sortBy ( 'expiration' );
        $lf = array();
        foreach ($listl as $l) {

                if ($l -> acces == "public") {
                    if ($l -> expiration < date ( "Y-m-d" )) {
                        $lf[] = $l;
                    }
                }

        }
        $vue = new VueListe( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 2 ) );
        return $rs;
    }

    // Afficher les listes qui m'appartiennent
    public function affichermeslistes(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste ::all () -> sortBy ( 'expiration' );
        $lf = array();
        foreach ($listl as $l) {
            if (isset( $_SESSION['iduser'] )) {
                if ($l -> user_id == $_SESSION['iduser']) {
                    if ($l -> expiration >= date ( "Y-m-d" )) {
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 9 ) );
        return $rs;
    }

    public function affichermeslistesexpire(Request $rq, Response $rs, $args): Response
    {
        $listl = Liste ::all () -> sortBy ( 'expiration' );
        $lf = array();
        foreach ($listl as $l) {
            if (isset( $_SESSION['iduser'] )) {
                if ($l -> user_id == $_SESSION['iduser']) {
                    if ($l -> expiration < date ( "Y-m-d" )) {
                        $lf[] = $l;
                    }
                }
            }
        }
        $vue = new VueListe( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 10 ) );
        return $rs;
    }

    // pour afficher le formulaire de création de liste
    public function creerliste(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueListe( [], $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 1 ) );
        return $rs;
    }

    // fonction pour ajouter une nouvelle liste qui viens d'etre créer
    public function nouvelleListe(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();

        $l = new Liste();
        $l -> titre = filter_var ( $post['titre'], FILTER_SANITIZE_STRING );
        $l -> description = filter_var ( $post['description'], FILTER_SANITIZE_STRING );
        $l -> expiration = filter_var ( $post['date'], FILTER_SANITIZE_STRING );
        $token = $this -> creerToken ();
        $tokenModif = $this -> creerToken ();

        if ($post['etat'] == "yes") {
            $l -> acces = "public";
        }

        if (isset( $_SESSION['iduser'] )) {
            $user_id = $_SESSION['iduser'];
            $url = $this -> container -> router -> pathFor ( 'afficherUneListe', ["token" => $token] );
        } else {
            $user_id = NULL;
            $url = $this -> container -> router -> pathFor ( 'donnerTokenModif', ["tokenModif" => $tokenModif] );
        }

        $l -> token = $token;
        $l -> tokenModif = $tokenModif;
        $l -> user_id = $user_id;
        $l -> save ();

        if(isset($_COOKIE['liste'])){
            $a = count($_COOKIE['liste']);
            $a++;
            setcookie ("liste[$a]", $l->tokenModif, $l->expiration, '/');
        }else{
            $a = 0;
            setcookie ("liste[$a]", $l->tokenModif, $l->expiration, '/');
        }


        return $rs -> withRedirect ( $url );
    }

    // création de token qui n'existe pas dans la base de données
    public function creerToken(): string
    {
        $random = bin2hex ( random_bytes ( 10 ) );;//bin2hex(random_bytes(10));
        $liste = Liste ::all ();
        $same = true;
        $array = array();
        while ($same) {
            foreach ($liste as $l) {
                $array[] = $l -> token;
                $array[] = $l -> tokenModif;
            }
            if (in_array ( $random, $array )) {
                $same = true;
                $random = bin2hex ( random_bytes ( 10 ) );
            } else {
                $same = false;
            }
        }
        return $random;
    }

    // afficher une liste en fonction du token de partage
    public function afficherUneListe(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste ::where ( "token", "=", $args['token'] ) -> first ();

        $array = array();

        $array['no'] = $liste -> no;
        $array['user_id'] = $liste -> user_id;
        $array['titre'] = $liste -> titre;
        $array['description'] = $liste -> description;
        $array['date'] = $liste -> expiration;
        $array['token'] = $liste -> token;
        $array['tokenModif'] = $liste -> tokenModif;
        $array['item'] = ControleurItem ::retournerItemsListe ( $liste -> no );

        $vue = new VueListe( $array, $this -> container );
        if (isset( $_SESSION['iduser'] ) && $_SESSION['iduser'] == $liste -> user_id) {
            $rs -> getBody () -> write ( $vue -> render ( 8 ) );
        } else {
            $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        }
        return $rs;
    }

    // suppresion d'une liste
    public function supprimerliste(Request $rq, Response $rs, $args): Response
    {
        $l = Liste ::where ( "tokenModif", "=", $args['tokenModif'] ) -> first ();
        $items = Item ::all ();
        $participations = Participation ::all ();
        foreach ($items as $i) {
            foreach ($participations as $p) {
                if ($p -> id_item == $i -> id) {
                    if ($i -> liste_id == $l -> no) {
                        $p -> delete ();
                    }
                }
            }
            if ($i -> liste_id == $l -> no) {
                $i -> delete ();
            }
        }
        $l -> delete ();
        $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
        return $rs -> withRedirect ( $url_listes );

    }

    // affichage du formulaire pour modifier une liste
    public function listemodif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste ::where ( "tokenModif", "=", $args['tokenModif'] ) -> first ();
        $vue = new VueListe( $liste -> toArray (), $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 4 ) );
        return $rs;
    }

    // modification dans la base de donnée d'une liste en fonction du formulaire
    public function modifierliste(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $acces = filter_var ( $post['etat'], FILTER_SANITIZE_STRING );

        $l = Liste ::where ( "tokenModif", "=", $args['tokenModif'] ) -> first ();
        $l -> titre = filter_var ( $post['titre'], FILTER_SANITIZE_STRING );
        $l -> description = filter_var ( $post['description'], FILTER_SANITIZE_STRING );
        $l -> expiration = filter_var ( $post['date'], FILTER_SANITIZE_STRING );
        if ($acces == "yes") {
            $l -> acces = "public";
        } else {
            $l -> acces = "private";
        }
        $l -> save ();

        $url_listes = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ["tokenModif" => $l -> tokenModif] );
        return $rs -> withRedirect ( $url_listes );

    }

    // fonction pour afficher une liste grace a la recherche
    public function rechercher(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $token = filter_var ( $post['token'], FILTER_SANITIZE_STRING );

        $array = array();
        $arraymodif = array();
        foreach (Liste ::all () as $li) {
            $array[] = $li -> token;
            $arraymodif[] = $li -> tokenModif;
        }
        if (in_array ( $token, $array )) {
            $url_listes = $this -> container -> router -> pathFor ( 'afficherUneListe', ['token' => $token] );
        } else if (in_array ( $token, $arraymodif )) {
            $url_listes = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $token] );
        } else {
            $url_listes = $this -> container -> router -> pathFor ( 'listnotfound' );
        }

        return $rs -> withRedirect ( $url_listes );
    }

    // fonction pour afficher le formulaire pour ajouter une liste existante a son compte
    public function ajouterUneListe(Request $rq, Response $rs, $args): Response
    {
        $vue = new VueListe( [], $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 6 ) );
        return $rs;
    }

    // permet de modifier la base de donnée pour ajouter une liste a son compte
    public function sajouterUneListe(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $token = filter_var ( $post['token'], FILTER_SANITIZE_STRING );

        $liste = Liste ::where ( "tokenModif", "=", $token ) -> first ();

        $array = array();
        foreach (Liste ::all () as $li) {
            $array[] = $li -> tokenModif;
        }
        if (in_array ( $token, $array )) {
            if (isset( $_SESSION['iduser'] )) {
                if ($liste -> user_id == null) {
                    $url = $this -> container -> router -> pathFor ( 'afficherlistes' );
                    $liste -> user_id = $_SESSION['iduser'];
                    $liste -> save ();
                } else {
                    $url = $this -> container -> router -> pathFor ( 'listappartient' );
                }
            } else {
                $url = $this -> container -> router -> pathFor ( 'besoinconnection' );
            }
        } else {
            $url = $this -> container -> router -> pathFor ( 'listnotfound' );
        }

        return $rs -> withRedirect ( $url );
    }

    // pour donnée le token de modification lors de la création d'une liste
    public function donnerTokenModif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste ::where ( "tokenModif", "=", $args['tokenModif'] ) -> first ();

        if ($liste == null) {
            $vue = new VueAlert( [], $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 1 ) );
        } else {
            $vue = new VueListe( $liste -> toArray (), $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 7 ) );
        }

        return $rs;
    }

    // afficher une liste grace au token de modification
    public function afficherUneListeWithModif(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste ::where ( "tokenModif", "=", $args['tokenModif'] ) -> first ();

        $array = array();

        $array['no'] = $liste -> no;
        $array['user_id'] = $liste -> user_id;
        $array['titre'] = $liste -> titre;
        $array['description'] = $liste -> description;
        $array['date'] = $liste -> expiration;
        $array['token'] = $liste -> token;
        $array['tokenModif'] = $liste -> tokenModif;
        $array['item'] = ControleurItem ::retournerItemsListe ( $liste -> no );

        $vue = new VueListe( $array, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 8 ) );
        return $rs;
    }

    // ajout d'un commentaire sur une liste
    public function ajouterCom(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();

        setcookie("commentaire", filter_var ( $post['nom'], FILTER_SANITIZE_STRING ), time() + (10 * 365 * 24 * 60 * 60), '/') ;

        $commentaire = new Commentaire();
        $commentaire -> id_liste = Liste ::where ( "token", "=", $args['token'] ) -> first () -> no;
        $commentaire -> nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $commentaire -> text = filter_var ( $post['commentaire'], FILTER_SANITIZE_STRING );

        $commentaire -> save ();

        return $rs -> withRedirect ( $this -> container -> router -> pathFor ( 'creationReussi' ) );
    }
}

//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe

//Controleu
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//Con
//ControleurListe//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe//ControleurListe
//ControleurListe
//ControleurListe
//ControleurListe
