<?
require(__DIR__.'/../gallery/result_modifier.php');
$arResult['ITEM'] = $arResult['ITEMS'][0];
unset($arResult['ITEMS']);


// файлы
$arResult['ITEM']['FILES'] = [];
$arResult['ITEM']['IMAGES'] = [];
foreach($arResult['ITEM']['PROPERTY_FILES_VALUE'] as $fileId) {
    $arFile = \CFile::GetFileArray($fileId); 
    if (!$arFile) continue;
    

    $isImage = $arFile["CONTENT_TYPE"] && str_starts_with($arFile["CONTENT_TYPE"], "image/");
    if ($isImage) {
        $arResult['ITEM']['IMAGES'][] = $arFile;
    } else {
        $arResult['ITEM']['FILES'][] = $arFile;
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SEO
$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult['ITEM']['IBLOCK_ID'], $arResult['ITEM']['ID']);
$arResult['ITEM']['SEO'] = $ipropSectionValues->getValues();
$this->__component->setResultCacheKeys(['ITEM']);

if ($arResult['ITEM']['IBLOCK_SECTION_ID']) {
    if (isset($arResult['SECTION'])) $arResult['SECTION'] = [];
    $arResult['SECTION']['PATH'] = \App\Gallery\Sections::getPath($arResult['ITEM']['IBLOCK_SECTION_ID']);
    $this->__component->setResultCacheKeys(['SECTION']);
}