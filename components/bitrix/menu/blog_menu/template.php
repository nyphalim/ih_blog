<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @var array $arParams
 */

$this->setFrameMode(true);
if (empty($arResult)) return;
?>

<nav class="<?=$arParams['CLASS_MENU'];?>">
	<?foreach($arResult as $itemIdex => $arItem):?>
		<a href="<?=$arItem["LINK"]?>"
           class="<?=$arParams['CLASS_ITEM'];?><?php if($arItem["SELECTED"]):?> active<?php endif;?>"
           <?php if($arItem['PARAMS']['BLANK']=='Y'):?>target="_blank"<?php endif;?>>
            <?=$arItem["TEXT"]?>
        </a>
	<?endforeach;?>
</nav>