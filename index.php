<?php

declare(strict_types=1);

session_start ();

use mywishlist\controls\ControleurPrincipal;
use mywishlist\controls\ControleurListe;
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

$app->get('/', ControleurPrincipal::class.':accueil')->setName ('racine');
$app->get('/listes', ControleurListe::class.':afficherlistes')->setName ('afficherlistes');
$app->get('/liste/{no}', ControleurListe::class.':afficherNoliste')->setName ('afficherNolistes');
$app->get('/item/{id}', ControleurItem::class.':afficherItem')->setName('afficherItem');


$app->post('/creer', ControleurPrincipal::class.':nouveaulogin')->setName('nouveaulogin'  );


$app->run();

/* Mettez votre nom pour vérifier que vous arrivez à push (sauf Clément) :
    * Valentin
    *
    *
*/