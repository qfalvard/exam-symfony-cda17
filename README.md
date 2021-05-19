# Exam Symfony Cda17

Pour travailler sur ce projet :

- (Optionnel) Créer un fork du projet (sur la page [https://github.com/Dreeckan/exam-symfony-cda17](https://github.com/Dreeckan/exam-symfony-cda17), cliquer sur le bouton `fork`, en haut à droite de la page)
- Cloner le projet (commande `git clone` par exemple)
- Vérifier et adapter le contenu du fichier `.env` pour la configuration à la base de données
- Lancer les commandes `composer install` et `php bin/console doctrine:database:create` dans le projet
- Une migration a déjà été créée, mettez à jour votre fichier `.env` pour vous connecter à la BdD et lancer la commande `php bin/console doctrine:migrations:migrate`
- Créer une branche pour faire tout l'examen
- À la fin de l'examen, vous **devez** envoyer un zip de votre code sur Moodle (pour alléger le fichier, vous pouvez supprimer le contenu du dossier `vendor`)

La durée prévue est d'environ 4h. Des points peuvent être perdus pour le retard du rendu :

- 1 point si le rendu est fait après 19h
- 2 point si le rendu est fait après 23h59

Liste des exercices :

1. Contrôleurs et routes
2. Vues avec Twig
3. Doctrine et la base de données
4. Formulaires et entités
5. Créer et utiliser des services
6. Débugguer un code existant

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
- [ ] Si ça n'est pas déjà fait, lancer la commande `php bin/console doctrine:migrations:migrate` pour appliquer la migration déjà existante

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
  
- [ ] Créer une migration

- [ ] Installer le [DoctrineFixturesBundle](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
  - [ ] créer un jeu de fausses données (données que vous voulez, je vous conseille de rester très simple et d'[utiliser du faux texte](https://fr.lipsum.com/) ou des nombres d'une boucle)
- [ ] Vérifier leur ajout

- [ ] Afficher tous les posts dont la propriété `published` vaut `true` dans la page `blog/index.html.twig`, dans un tableau HTML
- [ ] Les lignes du tableau vont être de la forme :

```html

<tr>
    <td>Afficher l'id ici</td>
    <td>
        <a href="lien-vers-un-post">Titre du post</a>
    </td>
    <td>
        Date de création (format 'd/m/Y H:i')
    </td>
    <td>Liste des tags</td>
    <td>Nombre de commentaires</td>
</tr>
```

## 4. Formulaires et entités

- [ ] Créer une route pour le chemin `/blog/new`
- [ ] Sur la page `/blog`, ajouter un lien "Créer un nouveau" qui pointe vers cette route
- [ ] Créer un formulaire pour créer un `Post` avec des champs pour :
  - [ ] Entrer un titre
  - [ ] Entrer le contenu
  - [ ] une case à cocher pour demander s'il est publié ou non (champ `CheckboxType`, non requis)
  - [ ] Choisir un ou des tags (parmis le liste des tags déjà créés)
- [ ] Afficher ce formulaire dans la vue `blog/new.html.twig`
- Lors de la soumission du formulaire, s'assurer que les données répondent aux contraintes suivantes :
  - [ ] Le titre doit avoir une longueur entre 10 et 200 caractères
  - [ ] Le contenu doit avoir une longueur entre 200 et 2500 caractères
  - [ ] Le poste doit avoir au moins un tag associé
- [ ] Si les données sont valides à la soumission du formulaire, enregistrer l'entité en base
  - [ ] Après enregistrement, rediriger l'utilisateur vers la page `/blog` (liste des postes)

## 5. Créer et utiliser des services

### 5.1. Un lanceur de dés

- [ ] Créer une classe `App\Services\DiceThrower` (lanceur de dés) et y implémenter :
  - [ ] Une méthode `rollDices` (lance des dés) prenant en paramètres un nombre de dés (nombre entier > 0) et le nombre de faces des dés à lancer (nombre entier > 1) et renvoyant un tableau contenant le résultat de chaque dé
    - Exemple d'utilisation : `rollDices(5, 8)` (lance 5 dés à 8 faces)
    - Exemple de résultat : `[5, 3, 2, 6, 8]` (renvoie séparément le résultat des 5 dés)
  - [ ] Une méthode `rollHundred` (lance un dé à 100 faces) prenant en paramètre un nombre de dés (nombre entier > 0) et renvoyant un tableau contenant le résultat de chaque dé
    - Exemple d'utilisation : `rollHundred(3)` (lance 3 dés à 100 faces)
    - Exemple de résultat : `[75, 13, 6]` (renvoie séparément le résultat des 3 dés)
  - [ ] Une méthode `bestResult` renvoyant le résultat le plus élevé d'un ensemble de lancers
    - Exemple d'utilisation : `bestResult([75, 13, 6])` (lance 3 dés à 100 faces)
    - Exemple de résultat : `75`
  - [ ] Une méthode `worstResult` renvoyant le résultat le plus bas d'un ensemble de lancers
    - Exemple d'utilisation : `worstResult([75, 13, 6])` (lance 3 dés à 100 faces)
    - Exemple de résultat : `6`
  
### 5.2. Résoudre des actions

- Créer une classe `App\Services\ActionResolver` (résolveur d'actions) :
  - [ ] Faire en sorte qu'elle puisse utiliser notre classe `App\Services\DiceThrower`
  - [ ] Ajouter une méthode `attack` :
    - [ ] Qui prend en paramètre 2 objets `Character`. Le premier est l'attaquant, le second est le défenseur.
    - [ ] Renvoie `null` si l'attaque a échoué, la quantité de dégâts infligés sinon
      
    - Fonctionnement de la méthode : 
      - Lance 2 dés à 100 faces (méthode `rollHundred`) et en prend le meilleur résultat (méthode `bestResult`). Si le résultat est supérieur à l'attribut `strength` de l'attaquant, alors l'attaque échoue (renvoyer `null`)
      - Si l'attaque réussie, le défenseur lance 1 dé à 100 faces (méthode `rollHundred`) et on conserve le plus mauvais résultat (méthode `worstResult`)
          - Si le résultat est inférieur ou égal à l'attribut `defense` du défenseur, alors l'attaque échoue (renvoyer `null`)
      - Si rien n'a été renvoyé jusqu'à cette étape, lancer 6 dés à 6 faces et en faire la somme. Renvoyer cette somme.

### 5.3. Utilisation

- [ ] Dans `src/Controller/BattleController.php`, vous trouverez un programme ayant besoin de votre `App\Services\ActionResolver`.
  - [ ] Injecter votre service `App\Services\ActionResolver` dans le controller
  - [ ] Mettre à jour le programme pour qu'il fonctionne
  - [ ] Tester que la route `/battle/` fonctionne et vous affiche un résultat

## 6. Débugguer un code existant

- [ ] Les fichiers `src/Controller/BugController.php` et `templates/bug/index.html.twig` sont inutilisables et plein de bugs. Faites en sorte qu'ils fonctionnent ! Normalement, vous devriez obtenir :
  - [ ] Une liste de personnages venus de la BdD (table `characters`, liée à l'entité `Character`)
  - [ ] Affichage de cette liste dans un tableau HTML
  - [ ] Affichage d'un lien
  - [ ] Utilisation du DiceThrower pour afficher / utiliser le résultat d'un jet de dés
