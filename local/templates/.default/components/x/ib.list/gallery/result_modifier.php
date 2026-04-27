<?
$lstSectionsIds = [];
foreach ($arResult['ITEMS'] as $i=>$dctItem) {
    \Bxx\Helpers\IBlocks\Elements\Modifiers::illustrator($arResult['ITEMS'][$i],['GALLERY'=>['PHOTOS'],'MAIN'=>'PICTURE']);

    $lstSectionsIds[] = $dctItem['IBLOCK_SECTION_ID'];
}


if (!count($lstSectionsIds) && $arResult['FILTER']['SECTION_CODE']) {
    \Bxx\Helpers\HTTP::process404();
}

//https://dev.1c-bitrix.ru/api_help/iblock/classes/ciblocksection/getlist.php
$rdbSection = \CIBlockSection::GetList(
        $dctOrder  = ['SORT' => 'ASC'],
        $dctFilter = [
            'IBLOCK_ID'    => $arResult['FILTER']['IBLOCK_ID'],
            'ID'          => $lstSectionsIds,
        ],
        false,
        $lstSelect = ['ID', 'NAME', 'SECTION_PAGE_URL'],
        false
    );
while($dctSection = $rdbSection->getNext()) {
    $refSections[$dctSection['ID']] = $dctSection;
}

$arResult['REFS']['SECTIONS'] = $refSections;

if ($arResult['FILTER']['SECTION_CODE']) {
    $arResult['SECTION'] = $refSections[$lstSectionsIds[0]];
}


