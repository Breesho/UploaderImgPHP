<?php
require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/photoswipe.css">
    <link rel="stylesheet" href="assets/default-skin/default-skin.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Galerie</title>
</head>

<body>

    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container-fluid">
            <h1 class="display-4">Galerie - AllPix</h1>
        </div>
    </div>

    <?php if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == 'superadmin') {
    ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Bonjour <?= $adminArray['usernameAdmin'] ?></p>
                    </div>
                    <div>
                        <!-- Galerie -->
                    </div>
                    <a class="btn btn-outline-dark" href="dashboard.php">Dashboard</a>
                </div>

            </div>
        <?php } else if ($_SESSION['username'] == 'superuser') { ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Bonjour <?= $userArray['usernameUser'] ?></p>
                    </div>
                    <div>
                        <!-- Galerie -->
                    </div>
                    <form method="post" action="deconnexion.php" id="form">
                        <button class="btn btn-outline-dark" id="delete" name="killSession">Déconnexion</button>
                    </form>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container-fluid">
            <div class="col-4 col-sm-12 text-center">
                <div>
                    <p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>
                </div>
                <a class="btn btn-outline-dark" href="index.php">Retour vers l'accueil</a>
            </div>
        </div>
    <?php } ?>
    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
     It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. 
        PhotoSwipe keeps only 3 of them in the DOM to save memory.
        Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>
    


    <script src="assets/js/photoswipe.js"></script>
    <script src="assets/js/photoswipe-ui-default.js"></script>
    <script>
        var pswpElement = document.querySelectorAll('.pswp')[0];

        // build items array
        var items = [{
            src: 'assets/img/<?= $affichImage ?>',
            w: 600,
            h: 400
        }];

        // define options (if needed)
        var options = {
            // optionName: 'option value'
            // for example:
            index: 0 // start at first slide
        };

        // Initializes and opens PhotoSwipe
        var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    </script>
</body>

</html>