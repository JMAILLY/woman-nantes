<?php get_header(); ?>

<section class="content">
    <h2>Désolé, cette page n'existe pas...</h2>
    <p>Si vous recherchez une page spécifique, vous pouvez utiliser le moteur de recherche sémantique ci-dessous. Sinon, utilisez le menu du site pour naviguer à travers les pages de ce dernier. </p>
    <p>Vous pouvez également retourner sur la <a href="<?php echo home_url(); ?>">page d'accueil</a></h2>, retrouver nos <a href="<?php echo home_url(); ?>/actualites">dernière actualités</a>, ou <a href="<?php echo home_url(); ?>/contact">nous contacter</a> pour toute demande.</p>
    <p>
        <div id="search">
            <form class="searchbox" method="get" action="<?php echo home_url(); ?>">
                <input name="s" type="text" placeholder="Tapez vos mots clés..." autocomplete="off">
                <button type="submit" class="btn btn-search">Rechercher</button>
            </form>
        </div>
    </p>
</section>

<?php get_footer(); ?>