<?php

declare(strict_types=1);

session_start ();

use mywishlist\controls\ControleurPrincipal;
use mywishlist\controls\ControleurListe;
use \mywishlist\controls\ControleurSession;
use \mywishlist\controls\ControleurItem;

require 'vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection (parse_ini_file ('src/conf/conf.ini'));
$db->setAsGlobal ();
$db->bootEloquent ();

$container = new \Slim\Container($config);
$app = new \Slim\App($container);


/** Route de base, racine */
$app->get('/', ControleurPrincipal::class.':accueil')->setName ('racine');


/** Route pour les sessions */

//Route pour créer un nouvelle utilisateur
$app->get('/formEnregistrement', ControleurSession::class.':formEnregistrement')->setName('formEnregistrement'  );
$app->post('/nouvelEnregistrement', ControleurSession::class.':nouvelEnregistrement')->setName('nouvelEnregistrement'  );

//Route pour se connecter
$app->get('/connexion', ControleurSession::class.':connexion')->setName('connexion'  );
$app->post('/testerConnexion', ControleurSession::class.':testerConnexion')->setName('testerConnexion'  );

//Route pour se deconnecter
$app->get('/deconnexion', ControleurSession::class.':deconnexion')->setName ('deconnexion');

//Route pour le bouton "Mon Compte"
$app->get('/compte', ControleurSession::class.':compte')->setName ('compte');



/** Route pour les listes */

//Route pour afficher les détails d'une liste
$app->get('/liste/{no}', ControleurListe::class.':afficherUneListe')->setName ('afficherUneListe');

//Route pour afficher les listes en cours de la personnes connectée
$app->get('/listes', ControleurListe::class.':afficherlistes')->setName ('afficherlistes');

//Route pour afficher les listes en passées de la personnes connectée
$app->get('/listesexpire', ControleurListe::class.':afficherlistesexpire')->setName ('afficherlistesexpire');

//Route pour le formulaire de création de liste
$app->get('/creerliste', ControleurListe::class.':creerliste')->setName ('creerliste');
$app->post('/nouvelleliste' , ControleurListe::class.':nouvelleliste'  )->setName('nouvelleliste'  );

//Route pour modifier une liste
$app->get('/listemodif/{no}', ControleurListe::class.':listemodif')->setName ('listemodif');
$app->post('/modifierliste/{no}' , ControleurListe::class.':modifierliste'  )->setName('modifierliste'  );

//Route pour supprimer une liste
$app->get('/supprimerliste/{no}', ControleurListe::class.':supprimerliste')->setName ('supprimerliste');



/** Route pour les items */

//Route pour afficher les items de la personnes connectée
$app->get('/items', ControleurItem::class.':afficheritems')->setName ('afficheritems');

//Route pour afficher les items qui sont dans une listes expirées
$app->get('/itemsexpire', ControleurItem::class.':afficheritemsexpire')->setName ('afficheritemsexpire');

//Route pour ajouter un item dans une liste
$app->get('/additem/{no}', ControleurItem::class.':additem')->setName ('additem');
$app->post('/ajouteritem/{no}' , ControleurItem::class.':ajouteritem'  )->setName('ajouteritem'  );



$app->run();

/* Mettez votre nom pour vérifier que vous arrivez à push (sauf Clément) :
    * Valentin
    * Aurelien
    *
*/