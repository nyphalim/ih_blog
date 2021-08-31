<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application,
    Bitrix\Main\Page\Asset;

/**
 * @var object $USER
 * @var object $APPLICATION
 */

$is_admin = $USER->IsAdmin();
$is_authorised = $USER->IsAuthorized();
$request = Application::getInstance()->getContext()->getRequest();
$menuStyle = \InfoHit\Functions::getRealPagePath() == '/blog/detail.php' ? 'transparent' : '';

?>

<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @font-face {
            font-family: 'Formular';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/Formular.eot');
            src: local('Formular'), local('Formular-Regular'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/Formular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/Formular.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/Formular.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/Formular.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'FormularBold';
            font-display: swap;
            font-style: normal;
            font-weight: bold;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBold/Formular-Bold.eot'); /* IE9 Compat Modes */
            src: local('Formular-Bold'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBold/Formular-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBold/Formular-Bold.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBold/Formular-Bold.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBold/Formular-Bold.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'FormularBlack';
            font-display: swap;
            font-style: normal;
            font-weight: 900;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBlack/Formular-Black.eot'); /* IE9 Compat Modes */
            src: local('Formular-Black'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBlack/Formular-Black.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBlack/Formular-Black.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBlack/Formular-Black.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Formular/FormularBlack/Formular-Black.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'LavaPro';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaPro-Regular.eot'); /* IE9 Compat Modes */
            src: local('LavaPro'), local('LavaPro-Regular'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaPro-Regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaPro-Regular.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaPro-Regular.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaPro-Regular.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'LavaProItalic';
            font-display: swap;
            font-style: italic;
            font-weight: 400;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProItalic/LavaPro-RegularItalic.eot'); /* IE9 Compat Modes */
            src: local('Lava Pro Regular Italic'), local('Lava-Pro-Regular-Italic'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProItalic/LavaPro-RegularItalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProItalic/LavaPro-RegularItalic.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProItalic/LavaPro-RegularItalic.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProItalic/LavaPro-RegularItalic.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'LavaProBold';
            font-display: swap;
            font-style: normal;
            font-weight: 800;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProBold/LavaPro-Bold.eot'); /* IE9 Compat Modes */
            src: local('LavaPro-Bold'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProBold/LavaPro-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProBold/LavaPro-Bold.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProBold/LavaPro-Bold.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProBold/LavaPro-Bold.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'LavaProHeavy';
            font-display: swap;
            font-style: normal;
            font-weight: 800;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProHeavy/LavaPro-Heavy.eot'); /* IE9 Compat Modes */
            src: local('LavaPro-Heavy'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProHeavy/LavaPro-Heavy.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProHeavy/LavaPro-Heavy.woff2') format('woff2'), /* Super Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProHeavy/LavaPro-Heavy.woff') format('woff'), /* Modern Browsers */
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/LavaPro/LavaProHeavy/LavaPro-Heavy.ttf') format('truetype'); /* Safari, Android, iOS */
        }
        @font-face {
            font-family: 'icomoon-blog';
            src:  url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon-blog/icomoon.eot?bswf9v');
            src:  url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon-blog/icomoon.eot?bswf9v#iefix') format('embedded-opentype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon-blog/icomoon.ttf?bswf9v') format('truetype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon-blog/icomoon.woff?bswf9v') format('woff'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon-blog/icomoon.svg?bswf9v#icomoon') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }
        @font-face {
            font-family: 'icomoon';
            src:  url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon/icomoon.eot?bswf9v');
            src:  url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon/icomoon.eot?bswf9v#iefix') format('embedded-opentype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon/icomoon.ttf?bswf9v') format('truetype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon/icomoon.woff?bswf9v') format('woff'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/icomoon/icomoon.svg?bswf9v#icomoon') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }
        @font-face {
            font-family:'FontAwesome';
            font-display: block;
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.eot?v=4.7.0');
            src: url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.eot?#iefix&v=4.7.0') format('embedded-opentype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.woff2?v=4.7.0') format('woff2'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.woff?v=4.7.0') format('woff'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.ttf?v=4.7.0') format('truetype'),
            url('<?=SITE_TEMPLATE_PATH;?>/fonts/Awesome/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular') format('svg');
            font-weight:normal;
            font-style:normal
        }
    </style>

    <title><?php $APPLICATION->ShowTitle();?><?php if(isset($request["PAGEN_1"]) && is_numeric($request["PAGEN_1"])) { echo ' — страница №' . $request["PAGEN_1"];} ?></title>

    <?php
    $APPLICATION->ShowHead();

    // CSS
    Asset::getInstance()->addCss("/local/js/fancybox/jquery.fancybox.min.css");
    Asset::getInstance()->addCss("/local/js/swiper/swiper-bundle.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/main.css");

    // ICON FONTS
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-icomoon.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-icomoon-blog.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-awesome.min.css");

    // JS
    Asset::getInstance()->addJs("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
    Asset::getInstance()->addJs("/local/js/fancybox/jquery.fancybox.min.js");
    Asset::getInstance()->addJs("/local/js/swiper/swiper-bundle.min.js");
    Asset::getInstance()->addJs("/local/js/swiper/swiper.js");
    Asset::getInstance()->addJs("/local/js/ih/lazyload.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app.min.js");

    // SVG ICONS FROM JS
    Asset::getInstance()->addJs('/include/svg/script.js');
    ?>

    <?php if(!$is_admin): ?>
        <!-- Google Tag Manager -->
        <script data-skip-moving=true>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-MBCMDHS');</script>
        <!-- End Google Tag Manager -->
    <?php endif;?>

    <?php // Варианты Favicon  ?>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
    <link rel="icon" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" sizes="96x96" href="/favicon-96x96.png">
    <link rel="android-touch-icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon_svg.ico" type="image/svg">
</head>

<body>
    <?php if (\InfoHit\Conf::ENABLE_CORRECT_DOMEN_REDIRECT && !\InfoHit\Functions::checkDevelopmentServer()): ?>
        <script data-skip-moving="true" data-ih="true">
            var $url = 'in' + 'fo-h' + 'it.ru';
            if ($url !== location.host) {location.href = 'https://' + $url + '?from=pdr';}
            else {document.querySelector('script[data-ih="true"]').remove();}
        </script>
    <?php endif; ?>

    <?php if(!$is_admin): ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MBCMDHS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php endif; ?>

    <?php $APPLICATION->ShowPanel();?>

    <header class="header<?php if($is_authorised): ?> entered<?php endif;?><?php if($menuStyle) { echo ' '. $menuStyle; }?>">
        <div class="header-menu-wrap">
            <a href="/" class="header-logo"><img src="<?=SITE_TEMPLATE_PATH;?>/img/header-logo.svg" alt=""><span style="background-image: url('<?=SITE_TEMPLATE_PATH;?>/img/logo-mobile.svg')"></span></a>
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "blog_menu",
                Array(
                    "ROOT_MENU_TYPE" => "main",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => "",
                    "CLASS_MENU" => "header-menu",
                    "CLASS_ITEM" => "header-menu-item"
                )
            );?>
            <button class="btn header-search-icon" id="header-search">
                <i class="icon-blog-magnifiying-glass"></i>
                <i class="icon-blog-exit"></i>
            </button>

            <?php $APPLICATION->IncludeComponent("bitrix:main.user.link", "blog_login", Array("ID" => $USER->GetID(),), false, array("HIDE_ICONS" => "Y"));?>

            <button class="btn header-mobile-menu-btn" id="open-mobile-menu"><i class="icon-blog-mobile-menu"></i></button>
        </div>

        <?php $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR."include/search_form.php",
                "TEMPLATE" => "blog-search-form",
                "INPUT_ID" => "blog-search",
                "CONTAINER_ID" => "blog-title-search",
            ), false,
            array(
                "ACTIVE_COMPONENT" => "Y",
                "HIDE_ICONS" => "Y"
            )
        );?>

        <section class="mobile-menu" style="display: none">
            <div class="mobile-menu-header">
                <img class="mobile-menu-header-logo" src="<?=SITE_TEMPLATE_PATH;?>/img/logo-yellow.svg" alt="Логотип ИнфоХит" />
                <button class="btn close-btn" id="close-mobile-menu"><i class="icon-blog-exit"></i></button>
            </div>

            <?php $APPLICATION->ShowViewContent('mobile-user-menu');?>

            <?php $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "blog_list_menu",
                Array(
                    "ROOT_MENU_TYPE" => "main",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => "",
                    "CLASS_MENU" => "mobile-menu-list",
                    "CLASS_ITEM" => "mobile-menu-list-item"
                )
            );?>
            <a href="/about/" class="mobile-menu-bottom-list">О проекте</a>
            <a href="/about/cooperation/" class="mobile-menu-bottom-list">Сотрудничество</a>
        </section>
    </header>
    <div class="overlay" style="display: none"></div>