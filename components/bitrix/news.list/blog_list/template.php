<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $sBeginMark
 * @var string $sEndMark
 */

$this->setFrameMode(true);

if(CModule::IncludeModule('orion.infinitescroll') && !$arParams["BLOCK"] && $arResult['NAV_RESULT']->NavPageCount > 1 ) {
        COrionInfiniteScroll::SetOptions(
            array(
                'btn_more_results' => array('label' => 'Загрузить ещё', 'class' => 'btn blog-list-btn'),
                'float_bar_show' => 0,
                'on_scroll' => 'setPageInUrl',
                'on_ajax_data4insert' => 'beforeLoadList',
            ),
            $arResult['NAV_RESULT']->NavNum
        );
        $sBeginMark = COrionInfiniteScroll::GetBeginMark($arResult['NAV_RESULT']->NavNum);
        $sEndMark = COrionInfiniteScroll::GetEndMark($arResult['NAV_RESULT']->NavNum);
}
?>
<section class="blog-list blog-section<?php if($arResult['NAV_RESULT']->PAGEN > 1 || $arParams['WITH_TAG'] == 'Y'):?> blog-list__mt0<?php endif;?>">
    <div class="container">
        <?=$sBeginMark;?>
        <div class="blog-list-row">
            <?php foreach ($arResult['ITEMS'] as $key => $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="blog-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL'];?>">
                        <div class="blog-item-wrap">
                            <picture>
                                <source media="(max-width: 768px)" srcset="<?=$arItem['PICTURE_LIST_MOBILE']['src'];?>">
                                <source media="(min-width: 769px)" srcset="<?=$arItem['PICTURE_LIST_MAIN']['src'];?>">
                                <img src="<?=$arItem['PICTURE_LIST_MAIN']['src'];?>">
                            </picture>
                            <i class="icon-blog-spinner"></i>
                        </div>
                        <div class="blog-item-info">
                            <h3 class="blog-item-title"><?=$arItem['NAME'];?></h3>
                            <p class="blog-item-desc"><?=$arItem["PROPERTIES"]["SUBTITLE"]["~VALUE"];?></p>
                            <ul class="blog-item-list list">
                                <li class="blog-item-data list-item"><?=strtolower(FormatDate("d.m.Y", MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")));?></li>
                                <li title="Количество просмотров" class="blog-item-data list-item"><i class="icon-blog-views"></i><?=$arResult['SHOW_COUNTER'][$arItem['ID']] ?: 0;?></li>
                                <li title="Количество комментариев" class="blog-item-data list-item"><i class="icon-blog-comments"></i><?=$arItem["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] ?: 0;?></li>
                            </ul>
                        </div>
                    </a>
                </div>
            <?php endforeach;?>
        </div>
        <?=$sEndMark;?>
        <?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arParams["TYPE"] != "BLOCK" && $arParams["AJAX_LOAD"] != "Y"):?>
            <?=$arResult["NAV_STRING"]?>
        <?endif;?>
    </div>
</section>

