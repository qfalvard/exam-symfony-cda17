# Exam Symfony Cda17

Pour travailler sur ce projet : 
- (Optionnel) Créer un fork du projet (sur la page [https://github.com/Dreeckan/exam-symfony](https://github.com/Dreeckan/exam-symfony), cliquer sur le bouton `fork`, en haut à droite de la page)
- Cloner le projet (commande `git clone` par exemple)
- Vérifier et adapter le contenu du fichier `.env` pour la configuration à la base de données
- Lancer les commandes `composer install` et `php bin/console doctrine:database:create` dans le projet
- Créer une branche pour faire tout l'examen
- À la fin de l'examen, vous **devez** envoyer un zip de votre code sur Moodle (pour alléger le fichier, vous pouvez supprimer le contenu du dossier `vendor`)

La durée prévue est d'environ 4h. Des points peuvent être perdus pour le retard du rendu :

- 1 point si le rendu est fait après 19h
- 2 point si le rendu est fait après 23h59

Liste des exercices :

1. Contrôleurs et routes (1)
2. Vues avec Twig (2)
3. Doctrine et la base de données (3)
4. Formulaires et entités (4)
5. Créer et utiliser des services (4)
6. Débugguer un code existant (4)
7. Questions de cours (2)


## 1. Contrôleurs et routes

- [ ] Créer un controller `BlogController` 
- [ ] Y ajouter une action `index`, répondant au chemin `/blog`
- [ ] Cette action doit afficher un template `blog/index.html.twig` (que l'on modifiera dans l'exercice 2)

- [ ] Dans le même controller, ajouter une action `post`, répondant au chemin `/blog/{id}`, servant à afficher un article de blog
- [ ] Récupérer le contenu du paramètre `id` de la route
- [ ] Cette action doit afficher un template `blog/post.html.twig` (que l'on modifiera dans les exercices suivants)
- [ ] Transmettre le paramètre `id` à la vue

## 2. Vues avec Twig

- [ ] Créer un template `layout.html.twig` héritant de `base.html.twig`
- [ ] Faire en sorte que les vues créées précédemment (`blog/index.html.twig` et `blog/post.html.twig`) héritent de `layout.html.twig`
- [ ] Dans `layout.html.twig`, créer un bloc `header`, un bloc `footer` et un bloc `content` qui permettront d'ajouter du contenu dans la balise `<body>` du html

- [ ] Adapter `blog/index.html.twig` et `blog/post.html.twig` pour utiliser les blocs de `layout.html.twig`

- [ ] Dans `blog/index.html.twig`
  - [ ] afficher un titre (dans le bloc `header`) : `<h1>LisTe des articLes</h1>`.
  - [ ] Avec un filtre Twig, faire en sorte que chaque mot commence par une majuscule et que le reste soit en minuscule
  
- [ ] Dans `blog/post.html.twig`
  - [ ] afficher un titre (dans le bloc `header`) : `<h1></h1>`.
  - [ ] Dans le `<h1>`, afficher le contenu de la variable `id` que vous avez transmis à la vue dans l'exercice 1.

## 3. Doctrine et la base de données

- [ ] Vérifier la connexion à la BdD (dans `.env`)

- Créer des entités pour gérer notre blog :
  - [ ] `Post` avec les propriétés suivantes
    - [ ] `id` entier, auto-incrémenté
    - [ ] `title` chaine de caractères (255)
    - [ ] `content` texte
    - [ ] `created_at` datetime
    - [ ] `updated_at` datetime
    - [ ] `published` booléen
    
  - [ ] `Comment` avec les propriétés suivantes
    - [ ] `id` entier, auto-incrémenté
    - [ ] `title` chaine de caractères (255)
    - [ ] `content` texte
    - [ ] `created_at` datetime
    
  - [ ] `Tag` avec les propriétés suivantes
    - [ ] `id` entier, auto-incrémenté
    - [ ] `name` chaine de caractères (255)
  
- Créer les relations entre ces entités :
  - [ ] Un `Post` peut être lié à plusieurs commentaires, un `Comment` est lié à un seul `Post`
  - [ ] Un `Post` peut être lié à plusieurs tags, un `Tag` est lié à plusieurs `Post`

- [ ] Installer le [DoctrineFixturesBundle](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
  - [ ] créer un jeu de fausses données (données que vous voulez, je vous conseille de rester très simple et d'[utiliser du faux texte](https://fr.lipsum.com/) ou des nombres d'une boucle)
- [ ] Vérifier leur ajout

## 4. Formulaires et entités



## 5. Créer et utiliser des services



## 6. Débugguer un code existant



## 7. Questions de cours


