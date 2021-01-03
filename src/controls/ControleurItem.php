<?php

namespace mywishlist\controls;


use mywishlist\models\Item;
use mywishlist\models\Liste;
use mywishlist\models\Participation;
use mywishlist\models\User;
use mywishlist\vue\VueAlert;
use mywishlist\vue\VueItem;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ControleurItem
{

    private $container;

    public function __construct($container)
    {
        $this -> container = $container;
    }

    public function afficherItems(Request $rq, Response $rs, $args): Response
    {
        $particpation = Participation ::all ();
        $lf = array();
        foreach ($particpation as $i) {
            if ($i -> id_user == $_SESSION['iduser']) {
                $item = Item ::find ( $i -> id_item );
                $liste = Liste ::find ( $item -> liste_id );
                if ($liste -> expiration > date ( "Y-m-d" )) {
                    $lf[] = $item;
                }
            }
        }
        $vue = new VueItem( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 0 ) );
        return $rs;
    }

    public function afficherItemsexpire(Request $rq, Response $rs, $args): Response
    {
        $particpation = Participation ::all ();
        $lf = array();
        foreach ($particpation as $i) {
            if ($i -> id_user == $_SESSION['iduser']) {
                $item = Item ::find ( $i -> id_item );
                $liste = Liste ::find ( $item -> liste_id );
                if ($liste -> expiration < date ( "Y-m-d" )) {
                    $lf[] = $item;
                }
            }
        }
        $vue = new VueItem( $lf, $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 1 ) );
        return $rs;
    }

    public function retournerItemsListe($no): array
    {
        $item = Item ::all ();
        $array = array();
        foreach ($item as $i) {
            if ($i -> liste_id == $no) {
                $array[] = $i;
            }
        }
        return $array;
    }

    public function additem(Request $rq, Response $rs, $args): Response
    {
        $liste = Liste ::find ( $args['no'] );
        $vue = new VueItem( $liste -> toArray (), $this -> container );
        $rs -> getBody () -> write ( $vue -> render ( 2 ) );
        return $rs;
    }

    public function modifitem(Request $rq, Response $rs, $args): Response
    {
        $i = Item ::where ( "id", "=", $args['no'] ) -> first ();

        if($i->etat == 1){
            $vue = new VueAlert([], $this->container);
            $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        }else{
            $vue = new VueItem( $i -> toArray (), $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 3 ) );
        }

        return $rs;
    }

    public function modifieritem(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $descr = filter_var ( $post['descr'], FILTER_SANITIZE_STRING );
        $url = filter_var ( $post['url'], FILTER_SANITIZE_STRING );


        if (empty( filter_var ( $post['img'], FILTER_SANITIZE_STRING ) )) {
            if (empty( filter_var ( $post['fileToUpload'], FILTER_SANITIZE_STRING ) )) {
                $img = null;
            } else {
                $url_ = $this -> container -> router -> pathFor ( 'racine' );
                $target_dir = "$url_/uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;

                $img = basename($_FILES["fileToUpload"]["name"]);
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }

                if (file_exists($target_file)) {
                    $uploadOk = 0;
                }

                if ($_FILES["fileToUpload"]["size"] > 1000000) {
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        } else {
            $img = filter_var ( $post['img'], FILTER_SANITIZE_STRING );
        }

        $tarif = filter_var ( $post['tarif'], FILTER_SANITIZE_STRING );

        $i = Item ::where ( "id", "=", $args['no'] ) -> first ();
        $i -> nom = $nom;
        $i -> descr = $descr;
        $i -> url = $url;
        $i -> img = $img;
        $i -> tarif = $tarif;
        $i -> save ();

        $url = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $args['tokenModif']] );
        return $rs -> withRedirect ( $url );
    }

    public function ajouteritem(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $descr = filter_var ( $post['descr'], FILTER_SANITIZE_STRING );
        $tarif = filter_var ( $post['tarif'], FILTER_SANITIZE_STRING );

        $item = new Item();
        $item -> liste_id = $args['no'];
        $item -> nom = $nom;
        $item -> descr = $descr;
        $item -> tarif = $tarif;
        if (filter_var ( $post['url'], FILTER_SANITIZE_STRING ) !== null) {
            $item -> url = filter_var ( $post['url'], FILTER_SANITIZE_STRING );
        }
        $item -> save ();

        $url = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $args['tokenModif']] );
        return $rs -> withRedirect ( $url );
    }

    public function supprimeritem(Request $rq, Response $rs, $args): Response
    {
        $i = Item ::where ( "id", "=", $args['no'] ) -> first ();
        if($i->etat == 1){
            $url = $this -> container -> router -> pathFor ( 'itemreserver' );
        }else{
            $i->delete();
            $url = $this -> container -> router -> pathFor ( 'afficherUneListeWithModif', ['tokenModif' => $args['tokenModif']] );
        }
        return $rs -> withRedirect ( $url );
    }

    public function reserver(Request $rq, Response $rs, $args): Response
    {
        $i = Item ::where ( "id", "=", $args['id'] ) -> first ();
        if($i->etat == 1){
            $vue = new VueAlert([], $this->container);
            $rs -> getBody () -> write ( $vue -> render ( 4 ) );
        }else{
            $array = array('item' => $i -> toArray (),'token' => $args['token']);
            $vue = new VueItem( $array , $this -> container );
            $rs -> getBody () -> write ( $vue -> render ( 4 ) );
        }
        return $rs;
    }

    public function reserverform(Request $rq, Response $rs, $args): Response
    {
        $post = $rq -> getParsedBody ();
        $nom = filter_var ( $post['nom'], FILTER_SANITIZE_STRING );
        $commentaire = filter_var ( $post['commentaire'], FILTER_SANITIZE_STRING );

        $participant = new Participation();
        $participant->id_item = $args['id'];
        $participant->commentaire = $commentaire;
        if(isset($_SESSION['iduser'])){
            $participant->id_user = $_SESSION['iduser'];
            $participant->nom = User::find($_SESSION['iduser'])->nom;
        }else{
            $participant->nom = $nom;
        }
        $participant->save();

        $item = Item::where("id","=",$args["id"])->first();
        $item->etat = 1;
        $item->save();

        $url = $this -> container -> router -> pathFor ( 'afficherUneListe', ["token" => $args['token']] );
        return $rs -> withRedirect ( $url );
    }

}