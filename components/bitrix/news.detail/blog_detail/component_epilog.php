<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addString('<link rel="amphtml" href="https://info-hit.ru/blog/' . $_REQUEST["ELEMENT_CODE"] . '/amp/" />');

\CJSCore::Init(['ajax-lazy-load', 'dl-animate', 'ih_compare_ajax']);