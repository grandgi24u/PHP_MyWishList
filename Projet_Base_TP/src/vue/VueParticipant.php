<?php


namespace mywishlist\vue;


class VueParticipant
{

    private $tab;
    private $container;

    public function __construct($t, $c)
    {
        $this -> tab = $t;
        $this->container = $c;
    }

    private function lesListes()
    {
        $html = '';
        foreach ($this -> tab as $liste) {
            $html .= "<li>$liste[titre]</li>";
        }
        return "<ul>$html</ul>";
    }

    private function unItem(){
        $i = $this->tab[0];
        $html = "Nom : $i[nom], Description : $i[descr]<br>";
        return $html;
    }

    public function render($select)
    {
        switch ($select) {
            case 1 :
            {
                $content = $this -> lesListes ();
                break;
            }
            case 3 :
            {
                $content = $this -> unItem ();
                break;
            }
        }

        $url = $this->container->router->pathFor('racine');


        $html = <<<FIN
<!DOCTYPE html>
<html>
  <head>
    <title>Test</title>
  </head>
  <body>
    <div>
        <h1><a href="$url">Wish List</a></h1>
        $content
    </div>
  </body>
</html>
FIN;
        return $html;
    }


}