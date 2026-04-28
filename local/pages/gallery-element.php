<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Галерея');
$APPLICATION->SetPageProperty('title', 'Галерея');

$bxApp = \Bitrix\Main\Application::getInstance();
$request = $bxApp->getContext()->getRequest();
$SectionCode = $request->get('SectionCode');
$ElementCode = $request->get('ElementCode');

$dctFilter = [
        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y',
        'SECTION_CODE' => $SectionCode,
        'CODE' => $ElementCode
    ];

$lstSelect = [
        'NAME',
        'DETAIL_PAGE_URL',
        'DETAIL_TEXT',
        'IBLOCK_SECTION_ID'
    ];
$lstProps = \Bitrix\Iblock\PropertyTable::getList([
        'select' => [
                'ID',
                'CODE',
                'NAME'
            ],
        'order' => [
                'SORT' => 'ASC',
                'NAME' => 'ASC'
            ],
        'filter' => [
                'IBLOCK_ID' => $dctFilter['IBLOCK_ID'],
            ],
        'cache' => ['ttl' => 86399]
    ])->fetchAll();
$lstSelect = array_merge($lstSelect, array_map(function($dctProp){
        return 'PROPERTY_'.$dctProp['CODE'];
    }, $lstProps));
?>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'gallery.element',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 1,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => $dctFilter,
                'SELECT' => $lstSelect,
                
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                'CACHE_TIME' => 3600,
                'CACHE_FILTER' => 'Y',
                'CACHE_GROUPS' => 'Y',
                
                
                'PAGER' => [
                        'TITLE' => '',
                        'TEMPLATE' => '',
                        'SHOW_ALWAYS' => 'N',
                        'SHOW_ALL' => 'N',
                        'PAGE' => 1,
                    ],
                
                
                'AJAX_OPTION_SHADOW' => 'Y',
                'AJAX_OPTION_JUMP' => 'N',
                'AJAX_OPTION_STYLE' => 'Y',
                'AJAX_OPTION_HISTORY' => 'N',
                'AJAX_OPTION_ADDITIONAL' => '',

                'TEMPLATE' => [
                        'PROPERTIES' => $lstProps
                    ]
            )
    );?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>