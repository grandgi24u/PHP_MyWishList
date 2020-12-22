
<head>
    <div class="header">

        <?php

        if(isset($_SESSION['iduser'])){
            echo '<a class="active" href="./deconnexion">Deconnexion</a>';
        }else{
            echo '<a href="./connexion">Se connecter</a>';
            echo '<a href="./formEnregistrement">Creer un compte</a>';
        }

        ?>

    </div>
    <div class="header">
        <a href="./" class="logo">MyWishList</a>
        <div class="header-right">
            <a href="./">Accueil</a>

            <?php

            if(isset($_SESSION['iduser'])){
                echo '<a href="./listes">Mes listes</a>';
                echo '<a href="./">Créer</a>';
                echo '<a href="./compte">Mon Compte</a>';
            }

            ?>

        </div>
    </div>
</head>
