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
        if (empty(filter_var($post['img'], FILTER_SANITIZE_STRING))) {
            if (empty(filter_var($post['photo'], FILTER_SANITIZE_STRING))) {
                $img = NULL;
            } else {
                /* pas terminé ($_FILES ne marche pas)
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
                $filetype = $post['photo']["type"];
                $filesize = $post['photo']["size"];

                // Vérifie l'extension du fichier
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

                // Vérifie la taille du fichier - 10Mo maximum
                $maxsize = 10 * 1024 * 1024;
                if ($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

                // Vérifie le type MIME du fichier
                if (in_array($filetype, $allowed)) {
                    // Vérifie si le fichier existe avant de le télécharger.
                    if (file_exists("img/" . $_FILES["photo"]["name"])) {
                        $img = "img/" . $_FILES["photo"]["name"];
                    } else {
                        // On met la photo dans le dossier img
                        move_uploaded_file($_FILES["photo"]["tmp_name"], "img/" . $_FILES["photo"]["name"]);
                        $img = "img/" . $_FILES["photo"]["name"];
                        echo "Votre fichier a été téléchargé avec succès.";
                    }
                } else {
                    echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
                }*/
            }
        } else {
            $img = filter_var($post['img'], FILTER_SANITIZE_STRING);
        }
        $tarif = filter_var($post['tarif'], FILTER_SANITIZE_STRING);

        $i = Item::where("id", "=", $args['no'])->first();
        $i->nom = $nom;
        $i->descr = $descr;
        $i->url = $url;
        $i->img = $img;
        $i->tarif = $tarif;
        $i->save();

        $url = $this->container->router->pathFor( 'afficherUneListeWithModif' , ['tokenModif' => $args['tokenModif']]) ;
        return $rs->withRedirect($url);
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

        $url = $this->container->router->pathFor( 'afficherUneListeWithModif' , ['tokenModif' => $args['tokenModif']]) ;
        return $rs->withRedirect($url);
    }

    public function supprimeritem(Request $rq, Response $rs, $args): Response
    {
        Item::where("id", "=", $args['no'])->first()->delete();
        $url = $this->container->router->pathFor( 'afficherUneListeWithModif' , ['tokenModif' => $args['tokenModif']]) ;
        return $rs->withRedirect($url);
    }


}