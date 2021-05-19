# Hotelio
> Interface de réservation de chambre d'hotel

Ce projet à été réalisé afin de valider le diplôme RNCP de la formation
développeur web au sein de l'école numérique 3W Academy.

L'application à été réaliser from scratch et sur une période assez courte,
de plus aucun test unitaire ou d'audit à été effectuer.
Elle est donc sûrement pourvus de bug ou de faille et
n'est donc pas utilisable dans un environnement de production.

En cas de réutilisation, à votre charge de faire le nécessaire.

## Choix technique

Je suis partie sur un modèle Vue/Controller simpliste,
le point d'entré est le controller, qui va tout simplement fournir
une vue avec un jeu de donnée. Afin d'ajouter un côté dynamique à
l'interface avec javascript, j'ai ajouté la possibilité aux controllers
de retourner du json, cela me permet de gérer toutes ma logique au même
endroit.

Pour la partie vue, c'est des pages php tout ce qu'il y à de plus basique,
je n'ai pas utilisé de module de templating comme twig pour des raisons
de performance,
l'application étant assez légère, les vues reste très lisible. 

# Pré-requis
- PHP 8 (avec les extensions pdo et pdo-mysql)
- MariaDB 10.5.7 (ou MySQL)