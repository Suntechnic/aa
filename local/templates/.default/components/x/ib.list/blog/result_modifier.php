<?
$lstSectionsIds = [];
foreach ($arResult['ITEMS'] as &$dctItem) {
    \Bxx\Helpers\IBlocks\Elements\Modifiers::illustrator($dctItem,['GALLERY'=>['PHOTOS'],'MAIN'=>'PICTURE']);
    \Bxx\Helpers\IBlocks\Elements\Modifiers::dater($dctItem);
}

