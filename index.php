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

//Route pour afficher les listes de la personnes connectée
$app->get('/listes', ControleurListe::class.':afficherlistes')->setName ('afficherlistes');

//Route pour le formulaire de création de liste
$app->get('/creerliste', ControleurListe::class.':creerliste')->setName ('creerliste');
$app->post('/nouvelleliste' , ControleurListe::class.':nouvelleliste'  )->setName('nouvelleliste'  );



/** Route pour les items */

//Route pour afficher les items de la personnes connectée
$app->get('/items', ControleurItem::class.':afficheritems')->setName ('afficheritems');

$app->run();

/* Mettez votre nom pour vérifier que vous arrivez à push (sauf Clément) :
    * Valentin
    * Aurelien
    *
*/