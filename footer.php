<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var object $USER
 * @var object $APPLICATION
 */

?>
    <footer class="footer blog-section">
        <div class="container">
            <img src="<?=SITE_TEMPLATE_PATH;?>/img/footer-logo.svg" alt="Логотип" class="footer-logo">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "blog_menu",
                Array(
                    "ROOT_MENU_TYPE" => "bottom",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => "",
                    "CLASS_MENU" => "footer-menu",
                    "CLASS_ITEM" => "footer-menu-item"
                )
            );?>
            <p class="footer-copyright">Любое использование или копирование материалов сайта, элементов дизайна и оформления допускается лишь с разрешения правообладателя и только со ссылкой на источник: info-hit.ru<br /><span>© ООО «ИнфоХит», 2012 — <?=date("Y");?></span></p>
        </div>
    </footer>

    <?php

    $APPLICATION->ShowViewContent('login-window');

    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        ["AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/metrika.php"],
        false,
        ["HIDE_ICONS" => "Y"]
    );

    $APPLICATION->IncludeComponent(
        'ih:check.user_fields',
        'no-email-popup',
        ['FORM_FIELDS' => ['EMAIL', 'NAME']]
    );
    ?>
</body>
</html>