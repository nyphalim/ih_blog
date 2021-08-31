<?php
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$sectionId = $request->get('sectionId');
$countElement = $request->get('count');
$elementTemplate = $request->get('elementTemplate');
$GLOBALS['coursesFilter'] = [
    "ACTIVE" => "Y",
    "!PROPERTY_NOSALE_VALUE" => "Y",
    "!PROPERTY_HIDDEN_VALUE" => "Y",
    "!SECTION_CODE" => "nodetail",
    "SECTION_ID" => $sectionId,
    "INCLUDE_SUBSECTIONS" => "Y"
];

$APPLICATION->IncludeComponent("bitrix:catalog.section", 'courses_list_tile', [
    "IBLOCK_TYPE" => "catalogs",
    "IBLOCK_ID" => "4",
    "SECTION_ID" => "",
    "SECTION_CODE" => "",
    "SECTION_USER_FIELDS" => [
        0 => "",
        1 => "ICONS",
        2 => "",
    ],
    "ELEMENT_SORT_FIELD" => "PROPERTY_CLICK_COST",
    "ELEMENT_SORT_ORDER" => "desc",
    "ELEMENT_SORT_FIELD2" => "shows",
    "ELEMENT_SORT_ORDER2" => "desc",
    "FILTER_NAME" => "coursesFilter",
    "INCLUDE_SUBSECTIONS" => "Y",
    "SHOW_ALL_WO_SECTION" => "Y",
    "HIDE_NOT_AVAILABLE" => "N",
    "PAGE_ELEMENT_COUNT" => $countElement ?: '3',
    "LINE_ELEMENT_COUNT" => "4",
    "PROPERTY_CODE" => [
        0 => "author",
        1 => "icon_video",
        2 => "icon_audio",
        3 => "icon_book",
        4 => "TRUE_LINK",
        5 => "ICONS",
        6 => "NOSALE",
        7 => "rightholder",
    ],
    "OFFERS_LIMIT" => "0",
    "SECTION_URL" => "",
    "DETAIL_URL" => "",
    "BASKET_URL" => "/personal/basket.php",
    "ACTION_VARIABLE" => "action",
    "PRODUCT_ID_VARIABLE" => "id",
    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
    "PRODUCT_PROPS_VARIABLE" => "prop",
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_JUMP" => "Y",
    "AJAX_OPTION_STYLE" => "Y",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600000",
    "CACHE_GROUPS" => "Y",
    "META_KEYWORDS" => "-",
    "META_DESCRIPTION" => "-",
    "BROWSER_TITLE" => "",
    "ADD_SECTIONS_CHAIN" => "N",
    "DISPLAY_COMPARE" => "N",
    "SET_TITLE" => "N",
    "SET_STATUS_404" => "N",
    "CACHE_FILTER" => "Y",
    "PRICE_CODE" => [
        0 => "price",
    ],
    "USE_PRICE_COUNT" => "N",
    "SHOW_PRICE_COUNT" => "1",
    "PRICE_VAT_INCLUDE" => "Y",
    "PRODUCT_PROPERTIES" => [
    ],
    "USE_PRODUCT_QUANTITY" => "N",
    "CONVERT_CURRENCY" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Тренинги",
    "PAGER_SHOW_ALWAYS" => "Y",
    "PAGER_TEMPLATE" => "",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "AJAX_OPTION_ADDITIONAL" => "",
    "COMPATIBLE_MODE" => "Y",
    "BLOCK" => "Y",
    "AJAX_LOAD" => "Y",
    "CSS_LOAD" => "Y",
    "CLASS_ITEM" => "smart-col"
],
    false
);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');