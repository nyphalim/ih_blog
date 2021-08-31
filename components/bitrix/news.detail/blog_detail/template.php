<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $sBeginMark
 * @var string $sEndMark
 * @var string $templateFolder
 * @var string $componentPath
 */

$this->setFrameMode(true);

$filterBackground = $arResult['PROPERTIES']['COLOR']['VALUE'] ?: '000000';
$filterOpacity = $arResult['PROPERTIES']['TRANSPARENCY']['VALUE'] ?: '0.5';
$section = $arResult['SECTION']['PATH'][0];
$scriberName = $arResult['SCRIBERS'][0]['NAME'] . ' '. $arResult['SCRIBERS'][0]['LAST_NAME'];
$activeDate = $arResult["DATE_CREATE"];
$commentsCount = $arResult["PROPERTIES"]["FORUM_MESSAGE_CNT"]["VALUE"] ?: 0;
?>
<main>
    <section class="blog-detail-cover" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"];?>);">
        <div class="blog-detail-cover-filter" style="background-color: #<?=$filterBackground;?>; opacity: <?=$filterOpacity;?>;"></div>
        <div class="blog-detail-cover-wrap">
            <div class="container">
                <a href="<?=$section['SECTION_PAGE_URL'];?>" class="blog-detail-cover-breadcrumb"><i class="icon-blog-left-long-arrow"></i><?=$section['NAME'];?></a>
                <ul class="blog-detail-cover-data list">
                    <li class="list-item"><?=FormatDate("d.m.Y", MakeTimeStamp($activeDate, "DD.MM.YYYY HH:MI:SS"));?></li>
                    <li class="list-item"><i class="icon-blog-views"></i><?=$arResult["SHOW_COUNTER"];?></li>
                    <li class="list-item"><i class="icon-blog-comments"></i><?=$commentsCount;?></li>
                </ul>
                <h1 class="blog-detail-cover-title"><?=$arResult["NAME"];?></h1>
                <p class="blog-detail-cover-subtitle"><?=$arResult["PROPERTIES"]["SUBTITLE"]["~VALUE"];?></p>
            </div>
        </div>
    </section>
    <section class="blog-detail-container">
        <div class="container">
            <article class="blog-detail-content">
                <p><?=$arResult["PREVIEW_TEXT"];?></p>
                <?php if($arResult["SCRIBERS"]):?>
                    <section class="blog-detail-author">
                        <?foreach($arResult["SCRIBERS"] as $arScriber):?>
                            <div class="blog-detail-author-item">
                                <div><img src="<?=$arScriber['PICTURE']['src'];?>" alt="Автор материала: <?=$arScriber['NAME'];?> <?=$arScriber['LAST_NAME'];?>"></div>
                                <div>
                                    <div class="blog-detail-author-name"><?=$arScriber['NAME'];?> <?=$arScriber['LAST_NAME'];?></div>
                                    <span><?=$arScriber['PERSONAL_PROFESSION'];?></span>
                                </div>
                            </div>
                        <?endforeach;?>
                    </section>
                <?php endif;?>

                <?=$arResult["DETAIL_TEXT"];?>

                <section class="blog-detail-info">
                    <?php if($arResult['SCRIBERS']):?>
                        <p>Редактор: <b><?=$scriberName?></b></p>
                    <?endif;?>
                    <ul class="list">
                        <li class="list-item"><?=$activeDate;?></li>
                        <li class="list-item"><i class="icon-blog-views"></i><?=$arResult["SHOW_COUNTER"];?></li>
                        <li class="list-item"><i class="icon-blog-comments"></i><?=$commentsCount;?></li>
                    </ul>
                    <?if($arResult["TAGS"]):?>
                        <?$arrTags = explode(', ', $arResult["TAGS"]);?>
                        <p>Тэги:
                            <?foreach ($arrTags as $tag):?>
                                <a href="/blog/?tag=<?=$tag;?>">#<?=$tag;?></a>
                            <?endforeach;?>
                        </p>
                    <?endif;?>
                </section>
                <aside class="blog-detail-socials">
                    <span>Поделиться</span>
                    <i class="icon-blog-left-long-arrow"></i>
                    <a href="#" onclick="Share.vkontakte('https://info-hit.ru<?=$arResult["DETAIL_PAGE_URL"]?>','<?=$arResult["NAME"]?>','https://info-hit.ru<?=$arResult["DETAIL_PICTURE"]["SRC"];?>','<?=$arResult["IBLOCK_ID"];?>','<?=$arResult["ID"];?>','LIKE_VK'); return false;"><img src="<?=$templateFolder;?>/img/vk.svg" alt=""></a>
                    <a href="#" onclick="Share.facebook('https://info-hit.ru<?=$arResult["DETAIL_PAGE_URL"]?>','<?=$arResult["IBLOCK_ID"];?>','<?=$arResult["ID"];?>','LIKE_FB'); return false;"><img src="<?=$templateFolder;?>/img/fb.svg" alt=""></a>
                    <a href="#" onclick="Share.twitter('https://info-hit.ru<?=$arResult["DETAIL_PAGE_URL"]?>','<?=$arResult["NAME"]?>','<?=$arResult["IBLOCK_ID"];?>','<?=$arResult["ID"];?>', 'LIKE_TW'); return false;"><img src="<?=$templateFolder;?>/img/tw.svg" alt=""></a>
                </aside>
                <section class="blog-detail-comments">
                    <h4>Комментариев к материалу: <?=$commentsCount;?></h4>
                    <?php if($arResult["PROPERTIES"]["COMMENTS_SUBTITLE"]["~VALUE"]):?>
                        <div class="blog-detail-comment-wrap">
                            <img src="<?=$arResult['SCRIBERS'][0]['PICTURE']['src']?>" alt="Автор материала"/>
                            <div class="blog-detail-comment-info">
                                <b><?=$scriberName?></b><span><?=$activeDate;?></span>
                                <p class="blog-detail-comment-content"><?=$arResult["PROPERTIES"]["COMMENTS_SUBTITLE"]["~VALUE"];?></p>
                            </div>
                        </div>
                    <?php endif;?>
                    <?CAskaronInclude::IncludeFile('blog_detail_comments.php', array(
                        'DETAIL_PAGE_URL' => $arResult['DETAIL_PAGE_URL'],
                    ));?>
                </section>
            </article>
        </div>
    </section>
    <section class="blog-detail-new">
        <div class="container">
            <h2>Свежее в блоге</h2>
            <?CAskaronInclude::IncludeFile("blog_detail_more_posts.php", array(
                "ELEMENT_ID" => $arResult["ID"],
                "TEMPLATE" => "blog_list_tile",
            ));?>
        </div>
    </section>
</main>

<?php if ($arResult['PROPERTIES']['SECTION_COURSE']['VALUE']):?>

    <?php
    // Подгрузим стили для вывода курсов
    $this->addExternalCss("/local/templates/.default/components/bitrix/catalog.section/courses_list_tile/style.css");?>

    <script>
        let moreCoursesAjax = new AjaxLazyLoad([
            <?
            $i = 1;
            while($i <= $arResult['COUNT_BLOCK_COURSES']):?>
            {
                selector: '.js-blog-courses-<?=$i;?>',
                ajaxUrl: '<?= "{$templateFolder}/include/blog_section_courses.php" ?>',
                ajaxData: {
                    sectionId: <?= $arResult['PROPERTIES']['SECTION_COURSE']['VALUE'] ?>,
                    elementsCount: 3,
                    componentTemplate: 'courses_list_tile',
                    PAGEN_1: <?=$i;?>,
                },
                afterAppend: () => {
                    /* global lazyLoadInstance */
                    if (typeof lazyLoadInstance.update !== "undefined") lazyLoadInstance.update();
                    /* global compareAjaxUpdate */
                    if (typeof compareAjaxUpdate !== "undefined") compareAjaxUpdate();
                },
                standardAnimation: true
            },
            <?$i++; endwhile;?>
        ]);
    </script>
<?php endif;?>