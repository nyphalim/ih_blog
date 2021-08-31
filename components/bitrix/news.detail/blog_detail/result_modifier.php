<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 * @var array $arResult
 */

// Получим кол-во просмотров
if ($res = \CIBlockElement::GetByID($arResult['ID'])->Fetch()) {
    $arResult["SHOW_COUNTER"] = intval($res['SHOW_COUNTER']);
}

// Образмериваем фоновую фотку
if (is_array($arResult['DETAIL_PICTURE']) && $arResult['DETAIL_PICTURE']['WIDTH'] > 1980) {
    $arFileTmp = \CFile::ResizeImageGet(
        $arResult['DETAIL_PICTURE'],
        array("width" => 1980, "height" => 10000),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    $arFileResize = [
        'WIDTH' => $arFileTmp["width"],
        'HEIGHT' => $arFileTmp["height"],
        'SRC' => $arFileTmp['src']
    ];
    $arResult['DETAIL_PICTURE'] = $arFileResize;
}

// Образмериваем дополнительные фотки, вставляем их в текст
if (is_array($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) && count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) > 0) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $arFile)
    {
        $arFileTmp = \CFile::ResizeImageGet(
            $arFile,
            array("width" => 720, "height" => 400),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arFileResize = [
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
            'SRC' => $arFileTmp['src']
        ];
        $arResult['MORE_PHOTO'][$key] = $arFileResize;

        $num = $key + 1;

        $desc = $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key] ? "<p>{$arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key]}</p>" : '';
        $arResult["DETAIL_TEXT"] = str_replace("#IMG".$num."#", "<div class='photo'><img alt='".$arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key]."' src='".$arFileResize['SRC']."' />".$desc."</div>", $arResult['DETAIL_TEXT']);
    }
}

if (is_array($arResult['PROPERTIES']['MORE_PHOTO_2']['VALUE']) && count($arResult['PROPERTIES']['MORE_PHOTO_2']['VALUE']) > 0) {
    foreach ($arResult['PROPERTIES']['MORE_PHOTO_2']['VALUE'] as $key => $arFile)
    {
        $arFileTmp = \CFile::ResizeImageGet(
            $arFile,
            array("width" => 720, "height" => 1500),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arFileResize = [
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
            'SRC' => $arFileTmp['src']
        ];
        $arResult['MORE_PHOTO_2'][$key] = $arFileResize;

        $num = $key + 1;

        $desc = $arResult['PROPERTIES']['MORE_PHOTO_2']['DESCRIPTION'][$key] ? "<p>{$arResult['PROPERTIES']['MORE_PHOTO_2']['DESCRIPTION'][$key]}</p>" : '';
        $arResult["DETAIL_TEXT"] = str_replace("#PHOTO".$num."#", "<div class='photo'><img alt='".$arResult['PROPERTIES']['MORE_PHOTO_2']['DESCRIPTION'][$key]."' src='".$arFileResize['SRC']."' />".$desc."</div>", $arResult['DETAIL_TEXT']);
    }
}

// Образмериваем персоны, вставляем их в текст
if (is_array($arResult['PROPERTIES']['PERSONS']['VALUE']) && count($arResult['PROPERTIES']['PERSONS']['VALUE']) > 0)
{
    foreach ($arResult['PROPERTIES']['PERSONS']['VALUE'] as $key => $arFile)
    {
        $arFileTmp = \CFile::ResizeImageGet(
            $arFile,
            array("width" => 200, "height" => 200),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arFileResize = [
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
            'SRC' => $arFileTmp['src']
        ];
        $arResult['PERSONS'][$key] = $arFileResize;

        $num = $key + 1;

        $arResult["DETAIL_TEXT"] = str_replace("#PERSON".$num."#", "<div class='photo'><img alt='".$arResult['PROPERTIES']['PERSONS']['DESCRIPTION'][$key]."' src='".$arFileResize['SRC']."' /><span>".$arResult['PROPERTIES']['PERSONS']['DESCRIPTION'][$key]."</span></div>", $arResult['DETAIL_TEXT']);
    }
}

// Образмериваем фотки галереи, вставляем ее в текст
if (is_array($arResult['PROPERTIES']['GALLERY']['VALUE']) && count($arResult['PROPERTIES']['GALLERY']['VALUE']) > 0)
{
    $galleryStr = array();
    $galleryItemsLi = array();
    foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $key => $arFile)
    {
        $arFileTmp = \CFile::ResizeImageGet(
            $arFile,
            array("width" => 720, "height" => 400),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arFileResize['WIDTH'] = $arFileTmp["width"];
        $arFileResize['HEIGHT'] = $arFileTmp["height"];
        $arFileResize['SRC'] = $arFileTmp['src'];
        $arResult['GALLERY'][$key] = $arFileResize;

        $num = $key + 1;
        $class = ($key == 0) ? " active" : "";
        if($arResult['PROPERTIES']['GALLERY_TYPE']['VALUE_XML_ID'] == "1"){
            $galleryItems[] = "<div class='swiper-slide".$class."'><img alt='".$arResult['PROPERTIES']['GALLERY']['DESCRIPTION'][$key]."' src='".$arFileResize['SRC']."' /><p>".$arResult['PROPERTIES']['GALLERY']['DESCRIPTION'][$key]."</p></div>";
        }
        elseif($arResult['PROPERTIES']['GALLERY_TYPE']['VALUE_XML_ID'] == "2"){
            $galleryItems[] = "<div class='item col-sm-4 col-xs-6'><a href='".$arFileResize['SRC']."' rel='photo-gallery' class='fancybox' title='".$arResult['PROPERTIES']['GALLERY']['DESCRIPTION'][$key]."'><img alt='".$arResult['PROPERTIES']['GALLERY']['DESCRIPTION'][$key]."' src='".$arFileResize['SRC']."' /><span>".$arResult['PROPERTIES']['GALLERY']['DESCRIPTION'][$key]."</span></a></div>";
        }
    }
    if($arResult['PROPERTIES']['GALLERY_TYPE']['VALUE_XML_ID'] == "1"){
        $galleryItemsStr = implode('', $galleryItems);
        $galleryItemsCount = count($galleryItems);
        $galleryStr = "
        <div class='content-slider swiper-container'>
            <div class='swiper-wrapper'>{$galleryItemsStr}</div>
            <div class='slider-nav'>
                <i class='swiper-button-prev icon-blog-left-long-arrow'></i>
                <span class='swiper-pagination'>1 / {$galleryItemsCount}</span>
                <i class='swiper-button-next icon-blog-left-long-arrow'></i>
            </div>
        </div>
        ";
    }
    elseif($arResult['PROPERTIES']['GALLERY_TYPE']['VALUE_XML_ID'] == "2"){
        $galleryStr = "<div class='gallery-tile'><div class='row'>".implode("", $galleryItems)."</div></div>";
    }
    $arResult["DETAIL_TEXT"] = str_replace("#GALLERY#", $galleryStr, $arResult['DETAIL_TEXT']);
}

// Вставляем видео в текст
if (is_array($arResult['PROPERTIES']['YOUTUBE']['VALUE']))
{
    foreach ($arResult['PROPERTIES']['YOUTUBE']['VALUE'] as $key => $arVideo)
    {
        $num = $key + 1;

        $arResult["DETAIL_TEXT"] = str_replace("#VIDEO".$num."#", "<div class='video'><div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' width='640' height='360' src='https://www.youtube.com/embed/".$arVideo."?rel=0' frameborder='0' allowfullscreen></iframe></div><span>".$arResult['PROPERTIES']['YOUTUBE']['DESCRIPTION'][$key]."</span></div>", $arResult['DETAIL_TEXT']);
    }
}

// Достаем автора статьи
$arResult["SCRIBERS"] = [];
if (is_array($arResult["PROPERTIES"]["USER"]["VALUE"]))
{
    $rsUser = \CUser::GetList(
        ($by="ID"),
        ($order="desc"),
        array("ID" => implode(" | ", $arResult["PROPERTIES"]["USER"]["VALUE"])),
        array("FIELDS"=>array("NAME", "LAST_NAME", "ID", "PERSONAL_PHOTO", "PERSONAL_PROFESSION"))
    );
    while ($arUser = $rsUser->Fetch()) {
        $arResult["SCRIBERS"][] = array(
            "NAME" => $arUser["NAME"],
            "LAST_NAME" => $arUser["LAST_NAME"],
            "PERSONAL_PROFESSION" => $arUser["PERSONAL_PROFESSION"],
            "PICTURE" => \CFile::ResizeImageGet(
                $arUser["PERSONAL_PHOTO"],
                array("width" => 72, "height" => 72 ),
                BX_RESIZE_IMAGE_EXACT,
                true
            ),
        );
    }
}

//Достаем информацию об авторах
if(!empty($arResult["PROPERTIES"]["AUTHORS"]["VALUE"])) {
    $arSelectFields = "";
    $arFilter = "";
    $arSelectFields = Array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "NAME", "PREVIEW_TEXT", "CODE", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_SUBTITLE", "TIMESTAMP_X");
    $arFilter = Array(
        "IBLOCK_ID" => $arResult["PROPERTIES"]["AUTHORS"]["LINK_IBLOCK_ID"],
        "ACTIVE" => "Y",
        "ID" => $arResult["PROPERTIES"]["AUTHORS"]["VALUE"],
    );
    $res = \CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelectFields);
    while ($arItem = $res->GetNext()) {
        // Проверка для генерации фотки / Если дата обновления старше 20.09.2016 то выбирается превьюшка, иначе выбирается детальная фотка
        if (\MakeTimeStamp($arItem["TIMESTAMP_X"], "DD.MM.YYYY HH:MI:SS") > 1474364854 && $arItem["PREVIEW_PICTURE"]) {
            $preview = $arItem["PREVIEW_PICTURE"];
        } else {
            $preview = $arItem["DETAIL_PICTURE"];
        }
        $arResult["SCRIBERS"][] = array(
            "ID" => $arItem["ID"],
            "NAME" => $arItem["NAME"],
            "CODE" => $arItem["CODE"],
            "DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"],
            "PICTURE" => \CFile::ResizeImageGet(
                $preview,
                array("width" => 72, "height" => 72),
                BX_RESIZE_IMAGE_EXACT,
                true
            ),
            "PERSONAL_PROFESSION" => $arItem["PROPERTY_SUBTITLE_VALUE"],
        );

    }
}

// Вставляем курсы если указан SECTION_COURSE
if ($arResult['PROPERTIES']['SECTION_COURSE']['VALUE']) {
    $arResult["DETAIL_TEXT"] = preg_replace_callback('~#(COURSES_([^#])+?)#~',
        static function ($matches) {
            return '<div class="blog-detail-courses js-blog-courses-'.$matches[2].'">
                        <img src="/include/svg-blocks/course-block.svg" alt="Загрузка" />
                        <img src="/include/svg-blocks/course-block.svg" alt="Загрузка" />
                        <img src="/include/svg-blocks/course-block.svg" alt="Загрузка" />
                    </div>';
        },
        $arResult['DETAIL_TEXT'],
        -1,
        $arResult['COUNT_BLOCK_COURSES']
    );
}