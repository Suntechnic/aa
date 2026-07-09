<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 * 
 */


$APPLICATION->SetTitle('Галерея');
$APPLICATION->SetPageProperty('title', 'Галерея');

$bxApp = \Bitrix\Main\Application::getInstance();
$router = $bxApp->getRouter();
$APPLICATION->AddChainItem('Галерея', $router->route('gallery'));
?>

<?$APPLICATION->IncludeComponent(
        'x:ib.sections',
        '',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 12,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        'SECTION_ID' => false,
                    ],
                'SELECT' => [
                        'ID',
                        'NAME',
                        'CODE',
                        'IBLOCK_ID',
                        'PICTURE',
                        'SECTION_PAGE_URL',
                ],
                
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                'CACHE_TIME' => 3600,
                'CACHE_FILTER' => 'Y',
                'CACHE_GROUPS' => 'Y',
            )
    );?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>