<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arParams
 * @var array $arResult
 */

foreach($arResult["ITEMS"] as $key => &$arItem) {
    $pictures = [
        'MAIN' => [
            'width' => 317,
            'height' => 221,
            'type' => BX_RESIZE_IMAGE_EXACT
        ],
        'MOBILE' => [
            'width' => 345,
            'height' => 194,
            'type' => BX_RESIZE_IMAGE_EXACT
        ]
    ];

    $imageFile = $arItem["PREVIEW_PICTURE"] ?: $arItem["DETAIL_PICTURE"];
    foreach ($pictures as $name_pic => $pic) {
        $arItem["PICTURE_LIST_{$name_pic}"] = \CFile::ResizeImageGet(
            $imageFile,
            array("width" => $pic['width'], "height" => $pic['height']),
            $pic['type'],
            true
        );
    }
}

//Количество просмотров
if($arResult["ELEMENTS"]) {
    $resCounter = \CIBlockElement::GetList(array(), array("ID" => $arResult["ELEMENTS"]) , false, false, array("ID", "SHOW_COUNTER"));
    while($arRes = $resCounter->Fetch())
    {
        $arResult["SHOW_COUNTER"][$arRes["ID"]] = intval($arRes["SHOW_COUNTER"]);
    }
}

?>