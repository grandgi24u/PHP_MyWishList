<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <title> MyWishList </title>
    <meta charset='utf-8'>
  </head>
<body>

<?php

require ("header.php"); // header (bare de navigation)

require("body.php"); // contenu de la page

require("footer.php"); // footer (bas de page)

?>


</body>


</html>
<style>

    .foot {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #1E90FF;
        color: white;
        text-align: center;
    }

    * {box-sizing: border-box;}

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 10px 10px;
    }

    .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }

    .header a:hover {
        background-color: #ddd;
        color: black;
    }

    .header a.active {
        background-color: #1e90ff;
        color: white;
    }

    .header-right {
        float: right;
    }

    @media screen and (max-width: 500px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }

        .header-right {
            float: none;
        }
    }


</style>