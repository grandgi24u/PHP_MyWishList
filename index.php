<?php

declare(strict_types=1);

session_start ();

use mywishlist\controls\ControleurPrincipal;

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
$app->get('/listes', ControleurPrincipal::class.':afficherListes')->setName ('aff_listes');
$app->get('/liste/{no}', ControleurPrincipal::class.':afficherListe')->setName ('aff_liste');
$app->get('/item/{id}', ControleurPrincipal::class.':afficherItem')->setName ('aff_item');

$app->get('/nouvelleliste' , ControleurPrincipal::class.':formListe'  )->setName('formListe'  );
$app->post('/nouvelleliste' , ControleurPrincipal::class.':newListe'  )->setName('newListe'  );

$app->get('/formlogin'    , ControleurPrincipal::class.':formlogin'   )->setName('formlogin'  );
$app->post('/nouveaulogin', ControleurPrincipal::class.':nouveaulogin')->setName('nouveaulogin'  );

$app->get('/testform' , ControleurPrincipal::class.':testform'  )->setName('testform'  );
$app->post('/testpass', ControleurPrincipal::class.':testpass'  )->setName('testpass'  );

$app->run();

