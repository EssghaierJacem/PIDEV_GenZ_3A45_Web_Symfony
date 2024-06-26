# PIDEV_3A45_GenZ_Web_Symfony

Partie Web d'une application web base sur 3 platform web (Symfony 5.4) Mobile (FlutterFlow) desktop (JavaFX)
## Projet développement Web Java Mobile
## 🧰 Présentation du PIDEV
 Projet permettant de créer une application ayant 3 clients Java Web et mobile tout en assurant la communication entre ces derniers à travers une base de données commune
 ### Sprint 1:
 Sprint Web
 ## Objectifs Sprint Web
 1. Développer une application WEB avec Symfony 5.4 `Front
Office + Back Office` en respectant le modèle `MVC`.
1. Organiser la couche métier en respectant les principes `OO`
1. Utiliser `l'ORM Doctrine` dans la couche persistance
1. Intégrer des templates avec `TWIG`
1. Gérer des formulaires avancés `avec la validation des champs de saisies`
1. Intégrer des bundles externes `Rating, Statistiques, Partage sur les réseaux sociaux etc....`.


## Planning
![image](https://user-images.githubusercontent.com/61393700/221413444-e838c951-b1f0-4c1c-be96-a29660d96fb0.png)
## Répartition des séances
![image](https://user-images.githubusercontent.com/61393700/221413682-1d31d083-0554-4bed-a27d-188c5e534030.png)

## 🛡️ Les contraintes techniques à prendre en considération
Chaque module doit contenir au minimum deux entités liées avec jointure 
- Une Seule Base de données partagée entre les 3 clients
- Pas d’utilisation du bundle `FOSUSER `
- Pas d’utilisation du Bundle `adminBundle` pour la gestion de la partie backoffice pour le Sprint Web

## 🛡️ Important to Run the project ## 
  ** composer require dompdf/dompdf ** 
  ** composer require knplabs/knp-paginator-bundle **
  ** composer require symfony/mailer ** 
  ** composer require endroid/qr-code **
  ** composer require twilio/sdk **
