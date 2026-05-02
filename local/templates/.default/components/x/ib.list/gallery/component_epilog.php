<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 * @var CMain $APPLICATION
 */


$dctSeo = $arResult['SECTION']['SEO'];

if ($dctSeo['SECTION_META_TITLE']) {
    $APPLICATION->SetPageProperty('title', $dctSeo['SECTION_META_TITLE'], ['COMPONENT_NAME' => $component->getName()]);
} else {
    $APPLICATION->SetPageProperty('title', $arResult['SECTION']['NAME'], ['COMPONENT_NAME' => $component->getName()]);
}

if ($dctSeo['SECTION_META_DESCRIPTION']) {
    $APPLICATION->SetPageProperty('description', $dctSeo['SECTION_META_DESCRIPTION'], ['COMPONENT_NAME' => $component->getName()]);
} else {
    $APPLICATION->SetPageProperty('description', $arResult['SECTION']['NAME'], ['COMPONENT_NAME' => $component->getName()]);
}
