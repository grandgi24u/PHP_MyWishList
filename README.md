![logo](https://user-images.githubusercontent.com/55753363/104508375-6c23ef00-55e8-11eb-92c3-b76b240f0a70.jpg)


# Projet MyWishList

Lien du projet : https://webetu.iutnc.univ-lorraine.fr/www/grandgi24u/MyWishList/

## Description du projet

MyWishList est une application en ligne pour créer, partager et gérer des listes de cadeaux. L'application permet de créer une liste de souhaits à l'occasion d'un événement particulier (anniversaire, fin d'année, mariage, retraite …) et lui permet de diffuser cette liste de souhaits à un ensemble de personnes concernées. Vous pouvez donc consulter cette liste et s'engager à offrir 1 élément de la liste. 

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
```
Participant :

Fonctionalitées : 1 - 2 - 3 - 4 - 5
```
### Afficher une liste de souhaits
* L'affichage du détail d'une liste présente toutes les informations de la liste accompagnées de la liste des items
* Chaque item est affiché avec son nom, son image et l'état de la réservation
* le nom du participant et les messages n'apparaissent pas avant la date d'échéance
* un clic sur un item donne accès à son détail (pas d'affichage d'item -> tout sur l'affichage d'une liste)
* Pour afficher une liste, il faut connaître son URL contenant un token (sauf si elle est publique)

### Afficher un item d'une liste
* L'affichage d'un item présente toutes ses informations détaillées, son image, et l'état de la réservation (nom du participant sans message)
* L'état de la réservation est restreint pour le propriétaire de la liste (basé sur un cookie) : le nom du participant n’apparaît pas
* Un item appartenant à aucune liste validée (par son créateur) ne peut pas être affiché
* Pour afficher un item d'une liste, il faut connaître l'URL de sa liste contenant un token

### Réserver un item
* Dans la page de l'item, si l'item n'est pas réservé, un formulaire permet de saisir le nom du participant
* La validation du formulaire enregistre la participation

### Ajouter un message avec sa réservation
* Dans la page de l'item, si l'item n'est pas réservé, le formulaire de participation permet également de saisir un message destiné le créateur
* La validation du formulaire enregistre le message avec la participation

### Ajouter un message sur une liste
* Dans la page d'une liste, un formulaire permet d'ajouter un message public rattaché à la liste
* Les messages sur la liste seront affichés avec le détail de la liste

```
Créateur :

Fonctionalitées : 6 - 7 - 8 - 9 - 10 - 14 - 15 - 16
```
### Créer une liste
* Un utilisateur non authentifié peut créer une nouvelle liste de souhaits
* Un formulaire lui permet de saisir les informations générales de la liste
* les informations sont : titre, description et date d'expiration
* Les balises HTML sont interdites dans ces champs
* Lors de sa création un token est créé pour accéder à cette liste en modification 

### Modifier les informations générales d'une de ses listes
* Le créateur d'une liste peut modifier les informations générales de ses listes
* Pour modifier il doit connaître son URL de modification (avec token)

### Ajouter des items
* Le créateur d'une liste peut ajouter des items à une de ses listes après l'avoir sélectionnée par son URL de modification (avec token)
* Un formulaire permet de saisir les informations de l'item
* les informations sont : nom et description et prix
* il peut aussi fournir l'URL d'une page externe qui détaille le produit (sur un site de ecommerce par exemple)

### Modifier un item
* Le créateur d'une liste peut modifier les informations des items de ses listes
* Une fois réservé, un item ne peut plus être modifié

### Supprimer un item
* Le créateur d'une liste peut supprimer un item d'un de ses listes si il n'est pas reservé

### Partager une liste
* Une fois la liste entièrement saisie, le créateur peut la partager
* Le partage d'une liste génère une URL avec un token (jeton unique différent du token de modification) destiné à être envoyé aux futurs participants

### Consulter les réservations d'une de ses listes avant échéance
* Le créateur d'une liste partagée peut consulter les réservations effectuées sur sa liste
* Seul l'état réservé ou non s'affiche avant la date d'échéance

### Consulter les réservations et messages d'une de ses listes après échéance
* Après la date d'échéance de la liste, le créateur authentifié d'une liste partagée peut consulterles réservations effectuées sur sa liste avec les noms des participants et les message associés aux réservations
```
Extensions :

Fonctionnalitées : 17 - 18 - 19 - 20 - 21 - 25 - 27 - 28
```
### Créer un compte
* Tout utilisateur non inscrit peut créer un compte à l'aide d'un formulaire
* Il choisit alors un login et un mot de passe

### S'authentifier
* Un utilisateur inscrit peut s'authentifier
* Une variable de session permet de maintenir l'état authentifié

### Modifier son compte
* Un utilisateur authentifié peut modifier son compte
* Seul le login ne peut pas être modifié
* Si il modifie son mot de passe, il doit alors à nouveau s'authentifier

### Rendre une liste publique
* Le créateur d'une liste peut la rendre publique
* Les listes publiques apparaissent dans la liste publique des listes de souhaits

### Afficher les listes de souhaits publiques
* Tout utilisateur non enregistré peut consulter la liste des listes de souhaits publiques à partir de la page d'accueil
* Seuls les titres de liste apparaissent
* Les listes en cours de création (non validées par leur créateur) et les listes expirées n'apparaissent pas
* Les listes sont triées par date d'expiration croissante
* Un clic sur une liste redirige vers l'affichage du détail de cette liste
* En option, peuvent s'ajouter une recherche par auteur ou par intervalle de date.

### Créer un compte participant
* La création d'un compte peut aussi être utile aux participants afin de consulter les participations qu'ils ont saisies et de ne plus saisir leur nom lors d'une participation

### Supprimer son compte
* Tous les utilisateurs enregistrés peuvent supprimer leur compte
* La suppression de son compte entraîne la suppression des listes, des items et images, des participations uniquement avant échéance et de tous les messages

### Joindre des listes à son compte
* Un utilisateur authentifié peut joindre des listes existantes à son compte en fournissant leurs tokens de modification
* Quand un utilisateurs authentifié crée une nouvelle liste, elle est automatiquement jointe à son compte
