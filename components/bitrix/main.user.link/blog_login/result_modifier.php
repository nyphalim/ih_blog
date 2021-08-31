<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (
    isset($arResult["User"])
    && is_array($arResult["User"])
    && isset($arResult["User"]["PERSONAL_PHOTO"])
)
{
    $arResult["PERSONAL_PHOTO"] = CFile::ResizeImageGet(
        $arResult["User"]["PERSONAL_PHOTO"],
        array("width" => 38, "height" => 38 ),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
}

unset($_GET["MUL_MODE"]);
?>