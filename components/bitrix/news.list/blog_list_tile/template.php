<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 */

?>

<div class="bottom-slider swiper-container">
    <div class="swiper-wrapper">
        <?foreach ($arResult['ITEMS'] as $key => $arItem):?>
            <?php
                $filterBackground = $arItem['PROPERTIES']['COLOR']['VALUE'] ?: '000000';
                $filterOpacity = $arItem['PROPERTIES']['TRANSPARENCY']['VALUE'] ?: '0.5';
                $themeId = $arItem['PROPERTIES']['SECTION_COURSE']['VALUE'];

                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="swiper-slide" style="background-image: url('<?=$arItem['PICTURE_LIST']['SRC'];?>')" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="filter" style="background-color: #<?=$filterBackground;?>; opacity: <?=$filterOpacity;?>;"></div>
                <h5 class="swiper-slide-title"><?=$arItem["NAME"];?></h5>
                <p><?=$arItem["PROPERTIES"]["SUBTITLE"]["~VALUE"];?></p>
                <div class="swiper-slide-bottom">
                    <ul class="list">
                        <li class="list-item"><?=FormatDate("d.m.Y", MakeTimeStamp($arItem["TIMESTAMP_X"], "DD.MM.YYYY HH:MI:SS"));?></li>
                        <li class="list-item"><i class="icon-blog-views"></i><?=$arResult['SHOW_COUNTER'][$arItem['ID']] ?: 0 ;?></li>
                        <li class="list-item"><i class="icon-blog-comments"></i><?=$arItem["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] ?: 0;?></li>
                    </ul>
                    <span><?=$arResult['THEMES'][$arItem['IBLOCK_SECTION_ID']]['NAME'];?></span>
                </div>
            </a>
        <?endforeach;?>
    </div>
    <i class="icon-blog-left-long-arrow swiper-button-prev"></i>
    <i class="icon-blog-left-long-arrow swiper-button-next"></i>
</div>