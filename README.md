# Projet MyWishList

## Description du projet
A détailler

## Membre du groupe
* GRANDGIRARD Clément
* BLAISE Aurélien
* BIENVENOT Hugo
* THIRION Valentin

## Instalation
Cloner le depot :
```
git clone https://github.com/grandgi24u/PHP_MyWishList.git
```
Créer une base de données lancer le script sql suivant pour créer les tables dont nous aurons besoins :
```
installation/prerequis.sql
```
Configurer l'accès à la base de données :
  * Creer un repertoire nommer "conf" dans le dossier "src/"
    * créer le fichier *conf.ini* dans ce dossier
    * Modifier le pour qu'il corresponde aux informations de votre base de données :
    ```
    driver=mysql
    host=localhost
    database=nomBDD
    username=userBDD
    password=motDePasseBDD
    charset=utf8
    collation=utf8_unicode_ci
    prefix= 
    ```
Télécharger le fichier ".htaccess" et le placer dans la racine du projet :

Le fichier : [.htaccess](https://drive.google.com/file/d/1-vl4Fv9f-n4OHAnRzL78svyLRJxrqSwb/view?usp=sharing)

## Suivi du projet

Suivi : [Carnet de bord](https://docs.google.com/spreadsheets/d/1624796koU7YWj593UP73e4uDMPmXC7ZdKhuX9dDsz7I/edit?usp=sharing)

## Descriptif des fonctionnalités réalisées

### 1 Afficher une liste de souhaits
• L'affichage du détail d'une liste présente toutes les informations de la liste accompagnées de
la liste des items
• Chaque item est affiché avec son nom, son image et l'état de la réservation
• L'affichage de l'état de la réservation est restreint pour le propriétaire de la liste (basé sur un
cookie) : le nom du participant et les messages n'apparaissent pas avant la date d'échéance
• un clic sur un item donne accès à son détail
• Pour afficher une liste, il faut connaître son URL contenant un token


