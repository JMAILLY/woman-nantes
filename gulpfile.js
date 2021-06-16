/* CONFIGURATION DU GULP POUR AUTOMATISER LES TACHES */

var gulp = require("gulp"),
    fs = require('fs'),
    cleanCSS = require('gulp-clean-css'),
    browserSync = require('browser-sync').create(); // à désactiver si vous ne souhaitez pas que le navigateur se recharge automatiquement à chaque modification d'un fichier (JS, HTML, CSS).

var plugins = require('gulp-load-plugins')();
var paths = {
    fonts: {
        src: 'web/app/themes/wp_theme/src/fonts/*.ttf',
        dest: 'web/app/themes/wp_theme/fonts/'
    },
    styles: {
        src: 'web/app/themes/wp_theme/src/sass/theme-style.scss',
        allsrc: 'web/app/themes/wp_theme/src/sass/**/*.scss',
        dest: 'web/app/themes/wp_theme/.'
    },
    scripts: {
        src: 'web/app/themes/wp_theme/src/js/*.js',
        dest: 'web/app/themes/wp_theme/.'
    },
    images: {
        src: 'web/app/themes/wp_theme/src/images/*.{png,jpg,jpeg,gif,svg}',
        dest: 'web/app/themes/wp_theme/images/'
    },
    spritesimages: {
        src: 'web/app/themes/wp_theme/src/images/sprites/*.svg',
        dest: 'web/app/themes/wp_theme/images/'
    },
    favicon: {
        src: 'web/app/themes/wp_theme/src/favicon/favicon.png',
        dest: 'web/app/themes/wp_theme/.',
        json: 'web/app/themes/wp_theme/src/favicon/favicons.json'
    }
};

gulp.task("init", [
    "generate-favicon", // Génère le favicon contenu dans le dossier src/favicon ; format .png
    "fontsmin", // Permet de convertir vos polices TTF en format woff et woff2 automatiquement
    "connect" // Lance le site comypilé avec tous les éléments
]);

gulp.task("watch", ["watch"]);
gulp.task("build", ["build"]);
gulp.task("default", ["connect"]);

// Tâche qui permet de compiler le sass en un seul fichier css
gulp.task("compile-sass", function() {
    return gulp.src(paths.styles.src)
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass({outputStyle: "compressed"}).on("error", plugins.sass.logError))
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
    plugins.cache.clearAll();
});

// Tâche qui permet de minimifier le css
gulp.task('minify-css', function() {
    return gulp.src('web/app/themes/wp_theme/theme-style.css')
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
        plugins.cache.clearAll();
});

// Tâche qui permet de concatener tous les fichiers JS en un seul et de le minimifier
gulp.task("concat-js", function () {
    var siteData = JSON.parse(fs.readFileSync("site.json", "utf8"));
    var jsFiles = [paths.scripts.src];
    if (siteData.jsFiles) {
        jsFiles = siteData.jsFiles;
    }
    return gulp.src(jsFiles)
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.concat("./script.min.js"))
        .pipe(plugins.uglify())
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(browserSync.stream());
        plugins.cache.clearAll();
});

// Tâche qui permet d'optimiser les images du projet
gulp.task('imagemin', function(){
    gulp.src(paths.images.src)
        .pipe(plugins.image({
            pngquant: true,
            optipng: false,
            zopflipng: true,
            jpegRecompress: false,
            mozjpeg: true,
            guetzli: false,
            gifsicle: true,
            svgo: true,
            concurrent: 10,
            quiet: true // defaults to false
        }))
        .pipe(gulp.dest(paths.images.dest));
});

// Génère un sprite SVG sans CSS pour les utiliser en SVG
gulp.task('sprite-svg', function() {
    gulp.task('sprite-svg', function() {
        return gulp.src(paths.spritesimages.src)
            .pipe(plugins.svgmin({
                plugins: [{
                    cleanupAttrs: true }, {
                    removeDoctype: true }, {
                    removeXMLProcInst: true }, {
                    removeEditorsNSData: false }, {
                    removeViewBox: false }, {
                    removeComments: true }, {
                    removeMetadata: true }, {
                    removeTitle: true }, {
                    removeDesc: true }, {
                    cleanupEnableBackground	: true }, {
                    removeUselessStrokeAndFill: true }, {
                    removeUnusedNS: true }, {
                    collapseGroups: true }, {
                    removeDimensions: true }, {
                    convertShapeToPath: true }, {
                    removeAttributesBySelector: 'path' }, {
                    removeAttrs: true }, {
                    removeEditorsNSData: true
                }]
            }))
            .pipe(plugins.svgstore())
            .pipe(plugins.rename({basename: 'sprites'}))
            .pipe(gulp.dest(paths.spritesimages.dest));
    });
});

// Tâche qui permet de convertir les polices en .woff
// Tâche qui permet de convertir les polices en .woff
gulp.task('ttf2woff', function(){
    return gulp.src(paths.fonts.src)
        .pipe(plugins.ttf2woff())
        .pipe(gulp.dest(paths.fonts.dest));
});

// Tâche qui permet de convertir les polices en .woff
gulp.task('ttf2woff2', function(){
    return gulp.src(paths.fonts.src)
        .pipe(plugins.ttf2woff2())
        .pipe(gulp.dest(paths.fonts.dest));
});

// Tâche qui permet de convertir les polices
gulp.task("fontsmin", ["ttf2woff", "ttf2woff2"]);

// Tâcbe qui permet de générer le favicon
gulp.task("generate-favicon", function(done) {
    plugins.realFavicon.generateFavicon({
        masterPicture: paths.favicon.src,
        dest: paths.favicon.dest,
        design: {
            ios: {
                pictureAspect: 'noChange',
                assets: {
                    ios6AndPriorIcons: false,
                    ios7AndLaterIcons: false,
                    precomposedIcons: false,
                    declareOnlyDefaultIcon: true
                }
            },
            desktopBrowser: {},
            androidChrome: {
                pictureAspect: 'shadow',
                themeColor: '#ffffff',
                manifest: {
                    name: 'nomDuProjetIci',
                    display: 'standalone',
                    orientation: 'notSet',
                    onConflict: 'override',
                    declared: true
                },
                assets: {
                    legacyIcon: false,
                    lowResolutionIcons: false
                }
            },
        },
        settings: {
            scalingAlgorithm: 'Mitchell',
            errorOnImageTooSmall: false,
            readmeFile: false,
            htmlCodeFile: false,
            usePathAsIs: false
        },
        markupFile: paths.favicon.json
    }, function() {
        done();
    });
});

// Tâche qui permet d'ouvrir le projet en local et d'activer le watch
gulp.task('connect', ['compile-sass', 'minify-css', 'imagemin', 'sprite-svg', 'concat-js'], function() {
    browserSync.init({
        proxy: "http://starterwprd.lndo.site",
    });

    /* Avec le starter kit, vous pouvez également visualiser vos modifications sur un site distant sans avoir encore uploadé vos fichiers
        * Pour cela, il suffit de=la fonction ci-dessous (browserSync.init();). Sur le même modèle que ci-dessous, il suffit de dire dans le rewriteRules quel fichier vous voulez
        * "remplacer" par votre fichier en local. Ici par exemple, on veut changer le css distant par notre css local. */
    /* Décommenter la ligne ci-dessous si pour utiliser cette fonction

    browserSync.init({
        proxy: "http://starter-wprd.test.hebergement-gm.fr/", // Remplacer par l'url du site distant sur lequel vous travaillez
        files: ["web/app/themes/wp_theme/theme-style.css", "web/app/themes/wp_theme/script.min.js"], // Ici vous mettez le dossier des fichiers qui vont "remplacer" les sources distantes
        serveStatic: ['web/app/themes/wp_theme/.'],
        injectChanges: true,
        reloadOnRestart: false,
        rewriteRules: [
            {
                match: new RegExp('web/app/themes/wp_theme/theme-style.css'), // Ici vous mettez le chemin du fichier à remplacer en lecture par celui en local
                fn: function() {
                    return 'web/app/themes/wp_theme/theme-style.css'; // ici vous mettez le chemin du fichier en local
                }
            },
            {
                match: new RegExp('web/app/themes/wp_theme/script.min.js'), // Ici vous mettez le chemin du fichier à remplacer en lecture par celui en local
                fn: function() {
                    return 'web/app/themes/wp_theme/script.min.js'; // ici vous mettez le chemin du fichier en local
                }
            }
        ]
    });
*/

    gulp.watch(paths.styles.src, ["compile-sass", "minify-css"]);
    gulp.watch(paths.styles.allsrc, ["compile-sass", "minify-css"]);
    gulp.watch(paths.scripts.src, ["concat-js"]);
    gulp.watch(paths.images.src, ["imagemin"]);
    gulp.watch(paths.spritesimages.src, ["sprite-svg"]);
    gulp.watch("web/app/themes/wp_theme/images/*.*").on('change', browserSync.reload);
});

// Tâche qui permet de générer le projet en local et d'activer le watch sur les fichiers
gulp.task('watch', ['compile-sass', 'minify-css', 'imagemin', 'sprite-svg', 'concat-js'], function() {
    gulp.watch(paths.styles.src, ["compile-sass", "minify-css"]);
    gulp.watch(paths.styles.allsrc, ["compile-sass", "minify-css"]);
    gulp.watch(paths.scripts.src, ["concat-js"]);
    gulp.watch(paths.images.src, ["imagemin"]);
    gulp.watch(paths.spritesimages.src, ["sprite-svg"]);
});

// Tâche qui permet de builder le projet complet
gulp.task('build', ['generate-favicon', 'fontsmin', 'compile-sass', 'minify-css', 'imagemin', 'sprite-svg', 'concat-js']);

// Tâche qui permet de compiler pour le déploiement
gulp.task('deploy', ['compile-sass', 'minify-css', 'imagemin', 'sprite-svg', 'fontsmin','concat-js']);



