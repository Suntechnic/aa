<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Мастера");
$APPLICATION->SetPageProperty('title', 'Мастера');

$bxApp = \Bitrix\Main\Application::getInstance();
$request = $bxApp->getContext()->getRequest();
$MasterCode = $request->get('MasterCode');

$dctFilter = [
        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y',
    ];
if($MasterCode) {
    // получим ID мастера по символьному коду
    $dctMaster = \Bitrix\Iblock\ElementTable::getList([
            'filter' => [
                    'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('masters'),
                    'CODE' => $MasterCode,
                ],
            'select' => ['ID','NAME','DETAIL_TEXT', 'DETAIL_PICTURE'],
        ])->fetch();
    $MasterID = $dctMaster['ID'];

    $dctFilter['PROPERTY_MASTER'] = $MasterID;
} else {
    $dctFilter['!PROPERTY_MASTER'] = [0,false];
}
$Page = $request->get('PAGEN_1') ?: 1;
?>

<?if($MasterCode && $dctMaster):?>
<section class="block section animate-block fade-up" data-watch data-watch-once>
    <div class="block__container">
        <div class="block__inner">
            <h2><?=$dctItem['NAME']?></h2>


            <h1 class="block__title text-50"><?=$dctMaster['NAME']?></h1>
            <?if($dctMaster['DETAIL_PICTURE']):?>
            <div class="block__img">
                <picture>
                    <img src="<?=\CFile::GetPath($dctMaster['DETAIL_PICTURE'])?>" alt="<?=$dctItem['NAME']?>">
                </picture>
            </div>
            <?endif?>
            <?if($dctMaster['DETAIL_TEXT']):?>
            <div class="block__description description-block">
                <?=$dctMaster['DETAIL_TEXT']?>
            </div>
            <?endif?>
        </div>
    </div>
</section>
<?endif?>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'gallery',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 32,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => $dctFilter,  
                'SELECT' => [
                        'NAME',
                        'DETAIL_PAGE_URL',
                        'IBLOCK_SECTION_ID',
                        'PROPERTY_PHOTOS',
                        'PROPERTY_MASTER',
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