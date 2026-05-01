<?
/**
 * @var array $arResult
 * @var string $signedParamsMutation
 */
?>
<?foreach($arResult['ITEMS'] as $dctItem): $dctSection = $arResult['REFS']['SECTIONS'][$dctItem['IBLOCK_SECTION_ID']];?>
<div class="catalog__column card-working">
    <?include('template.item.php');?>
</div>
<?endforeach?>
<?if($signedParamsMutation):?>
<span hidden data-signed-params-mutation="<?=$signedParamsMutation?>"></span>
<?endif?>