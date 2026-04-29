<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$BASE_URL = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'=';
?>



<ul class="pagination__list">
    <?if ($arResult["nStartPage"]!=1):?>
    <li>
        <a href="<?=$BASE_URL?>1" class="pagination__item text-16 <?if($arResult["NavPageNomer"]==1):?>active<?endif?>">1</a>
    </li>

    <?if ($arResult["nStartPage"] > 3):?>
    <li>
        <a href="<?=$BASE_URL?><?=round($arResult["nStartPage"]/2)?>" class="pagination__item pagination__item--glasses text-16">...</a>
    </li>
    <?elseif ($arResult["nStartPage"] == 3):?>
    <li>
        <a href="<?=$BASE_URL?>2" class="pagination__item text-16 <?if($arResult["NavPageNomer"]==2):?>active<?endif?>">2</a>
    </li>
    <?endif?>
    <?endif?>




    <?$NavPage=$arResult["nStartPage"]; while($NavPage <= $arResult["nEndPage"]):?>
    <li>
        <a href="<?=$BASE_URL?><?=$NavPage?>" class="pagination__item text-16 <?if($arResult["NavPageNomer"]==$NavPage):?>active<?endif?>"><?=$NavPage?></a>
    </li>
    <?$NavPage++?>
    <?endwhile?>


    <?if ($arResult["nEndPage"]!=$arResult["NavPageCount"]):?>

        <?if ($arResult["nEndPage"] < $arResult["NavPageCount"]-2):?>
        <li>
            <a href="<?=$BASE_URL?><?=round(($arResult["nEndPage"]+$arResult["NavPageCount"])/2)?>" class="pagination__item pagination__item--glasses text-16">...</a>
        </li>
        <?elseif ($arResult["nEndPage"] == $arResult["NavPageCount"]-2):?>
        <li>
            <a href="<?=$BASE_URL?><?=($arResult["NavPageCount"]-1)?>" class="pagination__item text-16 <?if($arResult["NavPageNomer"]==($arResult["NavPageCount"]-1)):?>active<?endif?>"><?=($arResult["NavPageCount"]-1)?></a>
        </li>
        <?endif?>


        <li>
            <a href="<?=$BASE_URL?><?=$arResult['NavPageCount']?>" class="pagination__item text-16 <?if($arResult["NavPageNomer"]==$arResult['NavPageCount']):?>active<?endif?>"><?=$arResult['NavPageCount']?></a>
        </li>
    <?endif?>
</ul>

