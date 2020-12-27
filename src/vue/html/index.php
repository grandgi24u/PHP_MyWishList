<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title> MyWishList </title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php

require ("header.php"); // header (bare de navigation)

require ("body.php"); // contenu de la page

require ("footer.php"); // footer (bas de page)

?>


</body>


</html>
<style>





    .button {
        padding: 12px;
        text-decoration: none;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
        background-color: #1e90ff;
        color: white;
    }



    .inMenu {
        display: inline-block;
        width: 25%;
    }

    .content {
        display: inline-block;
        width: 75%;
    }



    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #1e90ff;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #1e90ff;
    }

    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #1e90ff;
    }



    .vertical-menu {
        position: absolute;
        top: 50%;
        left: 10%;
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        width: 200px;
    }

    .vertical-menu a {
        background-color: #eee;
        color: black;
        display: block;
        padding: 12px;
        text-decoration: none;
    }

    .vertical-menu a:hover {
        background-color: #ccc;
    }

    .vertical-menu a.active {
        background-color: #1e90ff;
        color: white;
    }



    .foot {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #1E90FF;
        color: white;
        text-align: center;
    }

    * {
        box-sizing: border-box;
    }

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

    .header .search-container {
        float: left;
    }

    .header input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
    }

    .header .search-container button {
        float: left;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    .header .search-container button:hover {
        background: #ccc;
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