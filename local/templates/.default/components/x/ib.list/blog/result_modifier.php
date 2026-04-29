<?
/**
 * @var array $arResult
 * @var array $arParams
 */
$lstSectionsIds = [];
foreach ($arResult['ITEMS'] as &$dctItem) {
    \Bxx\Helpers\IBlocks\Elements\Modifiers::illustrator($dctItem,['GALLERY'=>['PHOTOS'],'MAIN'=>'PICTURE']);
    \Bxx\Helpers\IBlocks\Elements\Modifiers::dater($dctItem);
}

$arResult['PROP_ENUM_REFS'] = \Bxx\Helpers\IBlocks\Properties::getEnumReference($arResult['FILTER']['IBLOCK_ID']);
