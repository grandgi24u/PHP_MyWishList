
<head>
    <div class="header">
        <a href="./" class="logo">MyWishList</a>
        <div class="header-right">

            <?php

            if(isset($_SESSION['iduser'])){
                echo '<a href="./">Mes Participations</a>';
                echo '<a href="./listes">Mes listes</a>';
                echo '<a href="./compte">Mon Compte</a>';
                echo '<a class="active" href="./deconnexion">Deconnexion</a>';
            }else{
                echo '<a href="./connexion">Se connecter</a>';
                echo '<a href="./formEnregistrement">Creer un compte</a>';
            }

            ?>

        </div>
    </div>
</head>
