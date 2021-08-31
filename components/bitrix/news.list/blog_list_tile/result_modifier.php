<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 */

if($arResult["ITEMS"]) {
    $sections = [];
    foreach ($arResult['ITEMS'] as $cell => &$arItem) {
        $imageFile = $arItem["PREVIEW_PICTURE"] ?: $arItem["DETAIL_PICTURE"];

        //Меняем размер фоток
        $arFileTmp = \CFile::ResizeImageGet(
            $imageFile,
            array('width' => 316, 'height' => 410),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arItem['PICTURE_LIST'] = [
            'SRC' => $arFileTmp['src'],
            'WIDTH' => $arFileTmp['width'],
            'HEIGHT' => $arFileTmp['height']
        ];

        //Получаем список направлений
        if ($arItem['IBLOCK_SECTION_ID']) {
            $sections[] = $arItem['IBLOCK_SECTION_ID'];
        }
    }

    $arSelectFields = ""; $arFilter = "";
    $arSelectFields =  ["ID", "IBLOCK_ID", "NAME"];
    $arFilter = [
        "IBLOCK_ID" => "33",
        "ACTIVE" => "Y",
        "ID" => array_unique($sections),
    ];
    //Записываем направления в массив
    $res = \CIBlockSection::GetList(["SORT" => "ASC"], $arFilter, false, $arSelectFields, false);
    while($arSect = $res->Fetch()){
        $arResult["THEMES"][$arSect["ID"]] = [
            "ID" => $arSect["ID"],
            "NAME" => $arSect["NAME"],
        ];
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