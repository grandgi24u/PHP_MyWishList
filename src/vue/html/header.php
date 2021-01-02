<head>
    <div class="header">
        <?php

        use mywishlist\models\User;

        $url_accueil = $this -> container -> router -> pathFor ( 'racine' );

        echo "<a href='$url_accueil' class='logo'>MyWishList</a>";

        $url_rechercher = $this -> container -> router -> pathFor ( 'rechercher' );
        echo <<<End
<div class="search-container">
    <form method="POST" action="$url_rechercher" style="margin-left: 2%">
	    <input type="text" name="token" placeholder="Entrer une clé de partage" required/></label>
    </form>	
</div>
End;

        ?>
        <div class="header-right">

            <?php

            if (isset( $_SESSION['iduser'] )) {
                $url_items = $this -> container -> router -> pathFor ( 'afficheritems' );
                $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
                $url_comptes = $this -> container -> router -> pathFor ( 'compte', ["login" => User::find($_SESSION['iduser'])->login] );
                $deco = $this -> container -> router -> pathFor ( 'deconnexion' );

                echo "<a href='$url_items'>Mes Participations</a>";
                echo "<a href='$url_listes'>Mes listes</a>";
                echo "<a href='$url_comptes'>Mon Compte</a>";
                echo "<a class='active' href='$deco'>Deconnexion</a>";

            } else {
                $url_creerliste = $this -> container -> router -> pathFor ( 'afficherlistes' );
                $url_connecter = $this -> container -> router -> pathFor ( 'connexion' );
                $url_enregistrement = $this -> container -> router -> pathFor ( 'formEnregistrement' );
                echo "<a href='$url_creerliste'>Les listes</a>";
                echo "<a class='active' href='$url_connecter'>Se connecter</a>";
                echo "<a href='$url_enregistrement'>Creer un compte</a>";

            }

            ?>

        </div>
    </div>
</head>
