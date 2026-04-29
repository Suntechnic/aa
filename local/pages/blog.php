<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Блог');
$APPLICATION->SetPageProperty('title', 'Блог');

$bxApp = \Bitrix\Main\Application::getInstance();
$request = $bxApp->getContext()->getRequest();

$dctFilter = [
        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('blog'),
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y',
    ];

$Page = $request->get('PAGEN_1') ?: 1;
?>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'blog',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 12,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => $dctFilter,
                'SELECT' => [
                        'NAME',
                        'DETAIL_PAGE_URL',
                        'DATE_ACTIVE_FROM','ACTIVE_FROM_X','ACTIVE_FROM','TIMESTAMP_X',
                        'PREVIEW_TEXT',
                        'PROPERTY_TAGS', 
                        'PREVIEW_PICTURE',  
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