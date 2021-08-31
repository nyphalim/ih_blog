<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $sBeginMark
 * @var string $sEndMark
 */

$this->setFrameMode(true);
?>
<?php
if(!$arParams['LIST_PAGE_NUMBER'] || $arParams['LIST_PAGE_NUMBER'] == 1):
    foreach ($arResult['ITEMS'] as $key => $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <section class="blog-hero" style="background-image: url('<?=$arItem['PICTURE_LIST_MAIN']['src'];?>')">
            <div class="blog-hero-filter" style="background-color: #<?=$arItem["PROPERTIES"]["COLOR"]["VALUE"];?>"></div>
            <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="blog-hero-link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <h2 class='blog-hero-title'><?=$arItem['NAME'];?></h2>
                <p class="blog-hero-subtitle"><?=$arItem["PROPERTIES"]["SUBTITLE"]["~VALUE"];?></p>
                <div class="blog-hero-btn"><span class="blog-hero-line"></span><i class="icon-blog-left-long-arrow"></i><span class="blog-hero-line"></span></div>
                <ul class="blog-hero-list list">
                    <li class="blog-hero-item list-item"><?=FormatDate("d.m.Y", MakeTimeStamp($arItem["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS"));?></li>
                    <li title="Количество просмотров" class="blog-hero-item list-item"><i class="icon-blog-views"></i><?=$arResult['SHOW_COUNTER'][$arItem['ID']] ?: 0;?></li>
                    <li title="Количество комментариев" class="blog-hero-item list-item"><i class="icon-blog-comments"></i><?=$arItem["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] ?: 0;?></li>
                </ul>
            </a>
        </section>
        <?php
    endforeach;
endif;
?>

