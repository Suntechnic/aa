<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Галерея');
$APPLICATION->SetPageProperty('title', 'Галерея');

$bxApp = \Bitrix\Main\Application::getInstance();
$request = $bxApp->getContext()->getRequest();
$SectionCode = $request->get('SectionCode');

$dctFilter = [
        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y',
    ];
if($SectionCode) {
    $dctFilter['SECTION_CODE'] = $SectionCode;
}

$Page = $request->get('PAGEN_1') ?: 1;
?>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'gallery',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 4,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => $dctFilter,
                'SELECT' => [
                        'NAME',
                        'DETAIL_PAGE_URL',
                        'IBLOCK_SECTION_ID',
                        'PROPERTY_PHOTOS'
                    ],
                
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                'CACHE_TIME' => 3600,
                'CACHE_FILTER' => 'Y',
                'CACHE_GROUPS' => 'Y',
                
                
                'PAGER' => [
                        'TITLE' => '',
                        'TEMPLATE' => '',
                        'SHOW_ALWAYS' => 'N',
                        'SHOW_ALL' => 'N',
                        'PAGE' => $Page,
                    ],
                
                
                'AJAX_OPTION_SHADOW' => 'Y',
                'AJAX_OPTION_JUMP' => 'N',
                'AJAX_OPTION_STYLE' => 'Y',
                'AJAX_OPTION_HISTORY' => 'N',
                'AJAX_OPTION_ADDITIONAL' => ''
            )
    );?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>