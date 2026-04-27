<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Галерея');
$APPLICATION->SetPageProperty('title', 'Галерея');

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