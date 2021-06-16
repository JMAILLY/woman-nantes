# STARTER KIT WORDPRESS - Avec Déploiement Auto

Ceci est un starter kit Wordpress prêt à l'emploi pour vos projets de thèmes Wordpress. Ce starter kit propose toute une organisation avec des fichiers de base déjà présents, ainsi qu'une installation complète de Gulp pour gérer les tâches automatiques et optimiser le code. Le wiki de ce Starter Kit est disponible ici : http://intranet.gingerminds.fr/2018/06/26/starter-kit-wordpress/

Pensez quand même à lire l'article sur le Starter Kit HTML/PHP avant pour connaître toutes les subtilités de la configuration du kit ici : http://intranet.gingerminds.fr/2018/06/22/starter-kit-html/.
Enfin vous pourrez trouver une liste de plugins utiles à installer dans votre site Wordpress ici : http://intranet.gingerminds.fr/2018/06/27/optimiser-la-construction-dun-theme-wordpress/#plugins


Si vous souhaitez utiliser ACF, nous avons un compte PRO : 
https://www.advancedcustomfields.com/my-account/
Les identifiants sont sur TeamPass : Dossier GM > ACF Wordpress

***

# GESTION MULTISITE

Pour installer un réseau multisite avec Bedrock il faut : 

1. Ajouter la ligne suivante dans le fichier "config/application" :

    ```html
    Config::define('WP_ALLOW_MULTISITE', true);
    ```
2. Procéder à l'installation normale de Wordpress avec Bedrock

3. Aller dans Outils > Création du réseau, et créer le réseau du site. Bien sélectionner l'option "Sous domaines".

4. Rajouter le code donné en BO dans les fichier .htaccess et "config/application", exemple :

    ```html
    Config::define('MULTISITE', true);
    Config::define('SUBDOMAIN_INSTALL', true); // Set to true if using subdomains
    Config::define('DOMAIN_CURRENT_SITE', env('DOMAIN_CURRENT_SITE'));
    Config::define('PATH_CURRENT_SITE', env('PATH_CURRENT_SITE') ?: '/');
    Config::define('SITE_ID_CURRENT_SITE', env('SITE_ID_CURRENT_SITE') ?: 1);
    Config::define('BLOG_ID_CURRENT_SITE', env('BLOG_ID_CURRENT_SITE') ?: 1);
    ```

5. Ca y est, le multisite est activé ! Pour pouvoir gérer vos sous-domaines en local, pensez à bien configurer vos sous domaines avec Lando. 

***

# DEPLOIEMENT AUTO

Ce starter-kit vous permet de gérer du déploiement auto grâce à BEDROCKS, COMPOSER et GITHUB ! 
Pour ceci, votre serveur doit avoir composer d'installé et être en PHP >= 7.1.
Pensez à bien configurer le fichier .env ! Actuellement il est configuré pour être lancé avec Lando en local.
Plus d'infos : https://roots.io/bedrock/docs/

Pour gérer le déploiement auto, vous devez configurer les variables dans le GITLAB, et gérez les branches develop, release et master. 

Sinon, ce Starter Kit est prêt à l'emploi pour travailler en local avec lando (le fichier est déjà pré-configuré).

# UTILISER GULP

Si vous n'avez jamais utilisé GULP, vous devez d'abord commencer par l'installer en lisant le point suivant ["Installer Gulp"](#installer-gulp).
Une fois Gulp installé, il faut lancer cette commande :
```html
"yarn" ou "npm install" (si vous n'avez pas installé yarn)
```
> Celle-ci va installer tous les modules nécessaires pour faire fonctionner Gulp et les outils que l'on a défini dans le fichier package.json

Normalement vous devrez voir apparaître un dossier "**node_modules**" dans votre projet une fois cette commande lancée. Ce dernier contient tous les modules et librairies dont on a besoin pour lancer GULP.


Voilà, maintenant que vous avez installé Gulp nous allons pouvoir l'utiliser.
En fonction des projets vous pourrez commencer par lancer cette commande : 

```html
gulp init
```
> Elle va lancer les fonctions à n'éxecuter qu'une fois, comme la génération du favicon, et la convertion des polices en woff/woff2, ainsi que les fonctions qui doivent être systématiquement lancées (compilation du sass, etc)...

Puis une fois que vous aurez lancé au moins une fois "gulp init" dans votre projet, les prochaines fois vous n'aurez besoin de lancer que cette commande :
 ```html
 gulp
 ```
L'utilitaire Gulp doit se lancer et les tâches configurées dans le fichier gulpfile.js s'executer. 

Vous trouverez aussi deux autres fonctions Gulp que vous pouvez utiliser si vous ne souhaitez pas utiliser de watch via le navigateur, ou si vous voulez juste builder le projet une fois pour l'uploader sur le FTP ensuite par exemple : 

 ```html
 gulp watch
 ```
> Cette tâche permet de générer le projet en local et de ne pas utiliser le Live Reload sur les fichiers.

 ```html
 gulp build
 ```
> Cette tâche permet de permet de builder le projet complet (polices, favicon, css, js, etc...). Prêt à l'emploi !


##### NB : Les commandes précisées ici sont executées dans le dossier racine de votre projet avec un terminal de commande, là où se trouve votre fichier "gulpfile.js".

### NB2 : Si les commandes Gulp ne fonctionnent pas, je vous invite à faire un tour sur cet article du wiki : http://intranet.gingerminds.fr/2018/10/10/faire-fonctionner-les-commandes-gulp-grunt-et-npm-sur-son-terminal-phpstorm/ 


# INSTALLER GULP

### 1. Pré-requis

Pour pouvoir utiliser Gulp, il faut avoir installé **NODE JS** sur votre ordinateur. En effet, c'est à travers cet outil que Gulp fonctionne. 

Pour installer Node-JS, rendez-vous sur le site officiel : https://nodejs.org/en/.

Téléchargez ensuite **Yarn**, c'est un "package manager" que l'on utilise ici pour optimiser l'ajout des dépendances au projet, il va remplacer l'utilisation de bower également. Son utilisation n'est pas obligatoire, mais cela permet d'installer les modules utilisés par le site et par Gulp notamment beaucoup plus rapidement, et de façon plus sécurisée.

Pour installer Yarn, rendez-vous sur le site officiel : https://yarnpkg.com/

### 2. Installation de Gulp

Pour installer Gulp voici les étapes à suivre : 

1 - Créer un fichier "**package.json**" ou vérifier qu'il en existe un dans le projet (dans ce starter il est déjà créé et configuré, vous n'avez pas besoin d'y toucher à priori).
>Il va permettre d'installer les modules que l'on a besoin pour lancer nos tâches configurées. On peut également le créer sois-même ou en récupérer un déjà prêt à l'emploi. 

2 - Créer un fichier "**gulpfile.js**" à la racine du projet ou vérifier qu'il en existe un dans le projet (dans ce starter il est déjà créé et configuré, vous n'avez pas besoin d'y toucher à priori)
>Ce dernier va définir les différentes tâches que l'on veut automatiser sur notre projet (compiler le sass, minimifier les fichiers, recharger automatiquement la page, etc...). On peut le créer sois-même ou en récupérer un déjà prêt à l'emploi. Ce starter kit possède déjà un fichier gulpfile configuré et prêt à l'emploi !

Ces deux fichiers à configurer ont chacun une syntaxe particulière à respecter. L'idéal est d'utiliser des fichiers déjà pré-configurés de base pour gagner du temps, comme c'est le cas dans ce kit. 

***
***

Une fois que vous avez vérifié que ces fichiers sont présents et bien configurés, vous pouvez commencer l'installation de GULP : 

Installez Gulp sur votre ordinateur (si c'est la première fois que vous l'utilisez) en lançant les commandes suivantes sur votre terminal de commande (genre cmd.exe) : 
```html
npm install gulp@3.9.1 -g
```
```html
npm install gulp-cli -g
```
```html
npm install gulp-util -g
```
> Ces commandes vont installer Gulp de façon globale sur votre ordinateur. 

Pour vérifier que Gulp est bien installé, lancez la commande "gulp" sur votre terminal. Normalement vous devez avoir en réponse à votre commande ce message : 
> Local gulp not found in ~

Si ce n'est pas le cas, et que vous avez le message ci-dessous : 
> 'gulp' is not recognized as an internal or external command

Alors vous avez un problème au niveau de vos variables d'environnement. Dans ce cas, je vous invite à suivre ce wiki pour résoudre le problème (qui survient plutôt sur PC visiblement) : http://intranet.gingerminds.fr/2018/10/10/faire-fonctionner-les-commandes-gulp-grunt-et-npm-sur-son-terminal-phpstorm/

***


# INSTALLER DES LIBRAIRIES JS DE FACON AUTOMATISEE

Vous avez besoin d'utiliser une librairie JS dans votre projet, comme Masonry, Slick Slider, Owl Slider, etc... par exemple ? Plusieurs possibilités s'offrent à vous ! 
Vous pouvez ainsi :

#### 1. Utiliser le CDN de la librairie
Si votre librairie met à disposition un CDN pour que vous puissiez l'intégrer directement dans le code sans la stocker sur le serveur vous pouvez le faire si vous préférez fonctionner comme cela. 

#### 2. Utiliser YARN ou NPM pour ajouter la librairie dans votre projet
L'autre solution, s'il est possible d'installer votre librairie avec **NPM** (*généralement cette information est renseignée dans la documentation du projet*), vous pouvez le faire ainsi. 
Si vous avez Yarn sur votre ordinateur, préférez utiliser la commande Yarn que NPM pour installer la librairie. Il vous suffira donc d'executer une des commandes suivantes :

```html
yarn add nomdupackage_renseigne_dans_la_doc --save
```

ou si vous utilisez NPM uniquement : 

```html
npm install nomdupackage_renseigne_dans_la_doc --save-dev
```

exemple réél : 
```html 
npm install masonry-layout --save-dev
```

Il est important de ne pas oublier la partie "**--save**" (yarn) ou "**--save-dev**" (npm), car c'est elle qui va ajouter la dépendance de votre projet à la librairie dans le fichier **package.json**. Ainsi si quelqu'un récupère votre projet et doit travailler dessus, il va lui aussi bien récupérer les mêmes dépendances.

Pour inclure les scripts JS de vos librairies installés, il vous suffira de retrouver le dossier correspondant à votre librairie dans le dossier "**node_modules**". Une fois trouvé, vous pouvez étudier l'architecture du dossier de la librairie. 

Il vous suffira ensuite d'ouvrir le fichier "**site.json**", où vous allez pouvoir ajouter une ligne comme ci-dessous, pour que la librairie soit ajoutée dans le script minimifié complet généré par Gulp avec toutes vos librairies déclarées dans le fichier, ainsi que vos scripts (situé dans le dossier src > js). 
```html 
{
  "title": "Scripts JS du site - Librairies et Scripts sur mesure",
  "description": "",
  "jsFiles": [
    "./node_modules/jquery/dist/jquery.js",
    "./node_modules/svgxuse/svgxuse.js",
    Exemple ci-dessus ^ de lignes ajoutées pour inclure votre librairie dans votre script JS généré
    "./src/js/*.js"
  ]
}
```

Voilà, vous pourrez désormais utiliser votre librairie dans vos Scripts JS fait sur mesure pour votre projet !


***

# FOCUS SUR _BASE.SCSS
Voici l'explication des classes rajoutées dans _base.scss :

#### 1. La classe .sr-only

>La classe a été MAJ avec le nouveau code (on supprime les !important notamment)

#### 2. La classe .sr-only-focusable

>La classe doit etre utilisée en complément de sr-only pour rendre le texte caché sélectionnable.
Ceci est utile pour les liens d'évitement, ex :

```html
<a class="sr-only sr-only-focusable" href="#content">Aller au contenu</a>
```


# FOCUS SUR LA GÉNÉRATION DE SPRITES SVG

Si vous souhaitez utiliser des icones SVG de façon dynamique dans votre code, ce starter kit le permet. Pour cela, quand vous souahitez ajouter une icone SVG dans le fichier Sprite SVG (un seul fichier est généré avec toutes les icones SVG réutilisables, dans le dossier images du thème généré par Gulp), suivez les étapes suivantes : 

### 1. Nettoyez le picto

Nettoyez d'abord l'image avec Illustrator ainsi : 

    - Ouvrez l'image sur Illustrator
    - Retirez les calques "<desc>", "<title>" et "mask-...."
    - Faites en sorte de placer le picto le plus haut possible dans le calque (évitez d'avoir pleins de calques intermédiaires)
    - Changez la couleur du picto en noir (#000000)
    
### 2. Enregistrez le picto nettoyé

Enregistrez le avec comme nom : "icone-nomdupicto.svg", dans le dossier "sprites" du dossier src > images. 

Voilà, votre picto viens d'être ajouté au dossier Sprite généré, et vous pouvez désormais l'utiliser. 

### 3. Utiliser le picto

Pour utiliser le picto où vous voulez dans votre code, utilisez le code suivant : 

```html
    <svg class="icon">
        <use xlink:href="./images/sprites.svg#icone-nomdupicto"></use>
    </svg>
```

Vous pouvez désormais changer les propriété CSS de cette icone grâce à sa classe. Si l'icône ne s'affiche pas bien, essayer d'enlever le code HTML et de le remettre, ou de réenregistrer le picto SVG dans le dossier src > images > sprites.

##### NB : Pour changer la couleur du picto il faut utiliser la propriété CSS fill : #000000;