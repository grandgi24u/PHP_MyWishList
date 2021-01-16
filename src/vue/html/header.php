<head>
    <div class="header">
        <?php

        use mywishlist\models\User;
        //definition de l'url de la page d'accueil
        $url_accueil = $this -> container -> router -> pathFor ( 'racine' );
        //bouton logo qui mene vers l'accueil
        echo "<a href='$url_accueil' class='logo'><img src = '{$this -> container -> router -> pathFor ( "racine" )}/img/logo.svg'></a>";
        //definition du path de la recherche
        $url_rechercher = $this -> container -> router -> pathFor ( 'rechercher' );
        //definition du module de recherche par cle de partage
        echo <<<End
<div class="search-container">
    <form method="POST" action="$url_rechercher" style="margin-left: 2%">
	    <input type="text" name="token" placeholder="Entrer une clé de partage" required/></label>
    </form>	
</div>
End;

        ?>
        //partie droite du header
        <div class="header-right">

            <?php
            //si la variable de session iduser existe
            //l'utilisateur est connecter
            if (isset( $_SESSION['iduser'] )) {
                //on definie les routes des differente boutons
                $url_items = $this -> container -> router -> pathFor ( 'afficheritems' );
                $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
                $url_meslistes = $this -> container -> router -> pathFor ( 'affichermeslistes' );
                $url_comptes = $this -> container -> router -> pathFor ( 'compte', ["login" => User::find($_SESSION['iduser'])->login] );
                $deco = $this -> container -> router -> pathFor ( 'deconnexion' );
                //on creer les balise Html des bountons correspondant au cas ou l'utilisateur est connecter
                echo "<a href='$url_listes'>Les listes publiques</a>";
                echo "<a href='$url_items'>Mes Participations</a>";
                echo "<a href='$url_meslistes'>Mes listes</a>";
                echo "<a href='$url_comptes'>Mon Compte</a>";
                echo "<a class='active' href='$deco'>Deconnexion</a>";

            } else {
                //si la variable de session iduser n'existe pas
                //l'utilisateur n'est pas connecter
                //on definie les routes des differente boutons
                $url_creerliste = $this -> container -> router -> pathFor ( 'afficherlistes' );
                $url_connecter = $this -> container -> router -> pathFor ( 'connexion' );
                $url_enregistrement = $this -> container -> router -> pathFor ( 'formEnregistrement' );
                //on creer les balise Html des bountons correspondant au cas ou l'utilisateur n'est pas connecter
                echo "<a href='$url_creerliste'>Les listes</a>";
                echo "<a class='active' href='$url_connecter'>Se connecter</a>";
                echo "<a href='$url_enregistrement'>Creer un compte</a>";

            }

            ?>

        </div>
    </div>
</head>
