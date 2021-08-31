<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var object $USER
 * @var object $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

$this->setFrameMode(true);
$frame = $this->createFrame()->begin();

?>

    <?php if($arResult["User"]):?>
        <?php
            $USER_TYPE = $_COOKIE["user_type"];
            $user_name = $arResult["User"]["LAST_NAME"] ? $arResult["User"]["NAME"] . " " . $arResult["User"]["LAST_NAME"] : $arResult["User"]["NAME"];
            $lcUrl = $USER_TYPE ? "/account/{$USER_TYPE}/" : "/account/user/";
        ?>

        <div class="header-enter">
            <div class="header-user">
                <button class="btn header-user-menu-btn" id="user-menu">
                    <?if($arResult["PERSONAL_PHOTO"]["src"]):?>
                        <img src="<?=$arResult["PERSONAL_PHOTO"]["src"]?>" class="header-user-img" alt="<?=$user_name;?>"/>
                    <?endif;?>
                    <i class="icon-blog-arrow-down"></i>
                </button>
                <ul class="header-user-menu" style="display: none">
                    <li class="header-user-menu-item"><a href="<?=$lcUrl;?>">Личный кабинет</a></li>
                    <li class="header-user-menu-item"><a href="<?=$lcUrl.'settings/';?>">Настройки аккаунта</a></li>
                    <li class="header-user-menu-item header-user-exit"><a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array("logout"))?>"><i class="icon-blog-login"></i>Выйти</a></li>
                </ul>
            </div>
        </div>
    <?else:?>
        <?if (file_exists($_SERVER["DOCUMENT_ROOT"]."/include/elements/authorize_form_js/script.php"))
            require($_SERVER["DOCUMENT_ROOT"]."/include/elements/authorize_form_js/script.php");?>

        <div class="header-enter">
            <a href="#loginWindow" class="btn header-enter-btn ihit-popup-show js-login-button" data-popup="reg" data-step="auth">Войти</a>
        </div>

        <?$this->SetViewTarget('login-window');?>
            <div id="loginWindow" class="form-wrap" style="display:none;">
                <div class="ihit-reg-popup" data-href="/include/ajax-auth-768309823868324.php">
                    <div class="ihit-reg-popup-container">
                        <div class="window-loader"><i class="fa fa-spinner fa-spin"></i></div>
                    </div>
                </div>
            </div>
        <?$this->EndViewTarget();?>
    <?endif;?>


    <? // Сформируем меню для мобильных устройств ?>
    <?$this->SetViewTarget('mobile-user-menu');?>

        <div class="mobile-menu-user">
            <?php if($arResult["User"]):?>
                <a href="#" class="mobile-menu-user-info" id="mobile-user-btn">
                    <div class="mobile-menu-user-img">
                        <img src="<?=$arResult["PERSONAL_PHOTO"]["src"]?>" alt="<?=$user_name;?>" />
                        <span class="mobile-menu-user-name"><?=$user_name;?></span>
                    </div>
                    <i class="icon-blog-arrow-down"></i>
                </a>
                <ul class="mobile-menu-user-props" style="display: none">
                    <li class="mobile-menu-user-item"><a href="<?=$lcUrl;?>">Личный кабинет</a></li>
                    <li class="mobile-menu-user-item"><a href="<?=$lcUrl.'settings/';?>">Настройки аккаунта</a></li>
                    <li class="mobile-menu-user-item mobile-menu-user-exit"><a href="<?=$APPLICATION->GetCurPageParam("logout=yes", array("logout"))?>"><i class="icon-blog-login"></i>Выйти</a></li>
                </ul>
            <?php else:?>
                <a href="#loginWindow" class="mobile-menu-login ihit-popup-show js-login-button" data-popup="reg" data-step="auth"><i class="icon-blog-login"></i>Войти</a>
            <?php endif;?>
        </div>

    <?$this->EndViewTarget();?>

<?$frame->end();?>