/* ======================  SCRIPTS ====================== */
/************  JQUERY EST DISPONIBLE ICI *****************/

    $('document').ready(setup);
    $(window).on('load', documentReady);

    function setup() {
        initTarteAuCitron();
        initSlickSlider();
        initBlockMedia();
    }

    function documentReady() {

    }

    function initTarteAuCitron() {
        tarteaucitron.init({
            "hashtag": "#tarteaucitron", /* Ouverture automatique du panel avec le hashtag */
            "highPrivacy": false, /* désactiver le consentement implicite (en naviguant) ? */
            "orientation": "bottom", /* le bandeau doit être en haut (top) ou en bas (bottom) ? */
            "adblocker": false, /* Afficher un message si un adblocker est détecté */
            "showAlertSmall": false, /* afficher le petit bandeau en bas à droite ? */
            "cookieslist": true, /* Afficher la liste des cookies installés ? */
            "removeCredit": true, /* supprimer le lien vers la source ? */
            "useExternalCss": true
        });

        (tarteaucitron.job = tarteaucitron.job || []).push('youtube');
    }

    // Fonction pour initialiser les sliders avec Slick
    function initSlickSlider() {
        $('.blockslider-slides').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 800,
            fade: false,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: true,
            adaptiveHeight: true,
            slidesToShow: 1,
            cssEase: 'ease-in-out'
        });
    }

    // Fonction qui permet de lire une vidéo
    function initBlockMedia() {
        $('.blocktextimg-media.has-video, .blockmedia-media.has-video').click(function() {
            if(!$(this).hasClass('showVideo')) $(this).addClass('showVideo');
        });
    }

