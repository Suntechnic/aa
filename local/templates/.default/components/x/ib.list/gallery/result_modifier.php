<?
/**
 * @var array $arResult
 */

$lstSectionsIds = [];
foreach ($arResult['ITEMS'] as $i=>$dctItem) {
    \Bxx\Helpers\IBlocks\Elements\Modifiers::illustrator($arResult['ITEMS'][$i],['GALLERY'=>['PHOTOS'],'MAIN'=>'PICTURE']);

    // апсайз картинки для секции
     if ($arResult['ITEMS'][$i]['PROPERTY_PHOTOS_VALUE']) {
        foreach ($arResult['ITEMS'][$i]['PROPERTY_PHOTOS_VALUE'] as $iPhoto=>$PhotoId) {
            $arResult['ITEMS'][$i]['PROPERTY_PHOTOS_FILES_PREVIEW'][$iPhoto] = \CFile::resizeImageGet(
                    $PhotoId,
                    ['width' => 900, 'height' => 900],
                    BX_RESIZE_IMAGE_EXACT,
                    true
                );
            $arResult['ITEMS'][$i]['PROPERTY_PHOTOS_FILES_PREVIEW'][$iPhoto]['SRC'] = $arResult['ITEMS'][$i]['PROPERTY_PHOTOS_FILES_PREVIEW'][$iPhoto]['src'];
        } 
    }
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
$refSections = [];
while($dctSection = $rdbSection->getNext()) {
    $refSections[$dctSection['ID']] = $dctSection;
}

$arResult['REFS']['SECTIONS'] = $refSections;

if ($arResult['FILTER']['SECTION_CODE']) {
    $arResult['SECTION'] = $refSections[$lstSectionsIds[0]];
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SEO
if ($arResult['SECTION']['ID']) {
    $ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult['SECTION']['IBLOCK_ID'], $arResult['SECTION']['ID']);
    $arResult['SECTION']['SEO'] = $ipropSectionValues->getValues();
    $this->__component->setResultCacheKeys(['SECTION']);
}
