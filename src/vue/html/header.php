<head>
    <div class="header">
        <?php
        $url_accueil = $this -> container -> router -> pathFor ( 'racine' );

        echo "<a href='$url_accueil' class='logo'>MyWishList</a>";
        ?>
        <div class="header-right">

            <?php

            if (isset( $_SESSION['iduser'] )) {
                $url_items = $this -> container -> router -> pathFor ( 'afficheritems' );
                $url_listes = $this -> container -> router -> pathFor ( 'afficherlistes' );
                $url_comptes = $this -> container -> router -> pathFor ( 'compte' );
                $deco = $this -> container -> router -> pathFor ( 'deconnexion' );

                echo "<a href='$url_items'>Mes Participations</a>";
                echo "<a href='$url_listes'>Mes listes</a>";
                echo "<a href='$url_comptes'>Mon Compte</a>";
                echo "<a class='active' href='$deco'>Deconnexion</a>";

            } else {
                $url_connecter = $this -> container -> router -> pathFor ( 'connexion' );
                $url_enregistrement = $this -> container -> router -> pathFor ( 'formEnregistrement' );
                echo "<a class='active' href='$url_connecter'>Se connecter</a>";
                echo "<a href='$url_enregistrement'>Creer un compte</a>";

            }

            ?>

        </div>
    </div>
</head>
