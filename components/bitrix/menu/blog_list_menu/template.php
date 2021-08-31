<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 */

$this->setFrameMode(true);
if (empty($arResult)) return;
?>

<ul class="<?=$arParams['CLASS_MENU'];?>">
	<?foreach($arResult as $itemIdex => $arItem):?>
        <li class="<?=$arParams['CLASS_ITEM'];?><?php if($arItem["SELECTED"]):?> active<?php endif;?>">
            <a href="<?=$arItem["LINK"]?>" <?php if($arItem['PARAMS']['BLANK']=='Y'):?>target="_blank"<?php endif;?>>
                <?=$arItem["TEXT"]?>
            </a>
        </li>
	<?endforeach;?>
</ul>