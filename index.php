<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Главная');
$APPLICATION->SetPageProperty('main_class','page');

?> 
<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'slider',
        Array(
                'ELEMENTS_COUNT' => 1200,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => [
                                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('slider'),
                                'ACTIVE' => 'Y',
                                'ACTIVE_DATE' => 'Y',
                                'SECTION_ID' => \Bxx\Helpers\IBlocks\Sections::getIdByCode('mainpage'),
                            ],

                'SELECT' => [
                        'DETAIL_PICTURE',
                        'PROPERTY_URL',
                    ],
                
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                'CACHE_TIME' => 3600,
                'CACHE_FILTER' => 'Y',
                'CACHE_GROUPS' => 'Y',
            )
    );?>

<section class="attention section animate-block fade-up" data-watch data-watch-once>
    <div class='attention__container'>
        <div class="attention__content">
            <div class="attention__text text-22">
                На этом сайте представлены работы, сделанные мной в разное время. Сайт не является магазином —
                <br>
                это галерея моих работ. Некоторые работы, выполненные в технике художественного литья, я могу повторить. Некоторые выполнены в единственном экземпляре. Но все они предназначены для радости
                и украшения нашей прекрасной жизни.
            </div>
        </div>
    </div>
</section>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'gallery.slider',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 8,
                'SORT' => ['SORT'=>'ASC'],
                
                'FILTER' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        'PROPERTY_NEW_VALUE' => 'Y',
                    ],
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
                
                'AJAX_OPTION_SHADOW' => 'Y',
                'AJAX_OPTION_JUMP' => 'N',
                'AJAX_OPTION_STYLE' => 'Y',
                'AJAX_OPTION_HISTORY' => 'N',
                'AJAX_OPTION_ADDITIONAL' => '',

                'TEMPLATE_VARS' => [
                        'TITLE' => 'Новые работы',
                ]
            )
    );?>

<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'blog.slider',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 3,
                'SORT' => ['ID'=>'DESC'],
                
                'FILTER' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('blog'),
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        'PROPERTY_TAGS_VALUE' => 'выставки',
                    ],
                'SELECT' => [
                        'NAME',
                        'DATE_ACTIVE_FROM','ACTIVE_FROM_X','ACTIVE_FROM','TIMESTAMP_X',
                        'DETAIL_PAGE_URL',
                        'IBLOCK_SECTION_ID',
                        'PREVIEW_PICTURE',
                        'PROPERTY_TAGS'
                    ],
                
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                'CACHE_TIME' => 3600,
                'CACHE_FILTER' => 'Y',
                'CACHE_GROUPS' => 'Y',
                
                
                'AJAX_OPTION_SHADOW' => 'Y',
                'AJAX_OPTION_JUMP' => 'N',
                'AJAX_OPTION_STYLE' => 'Y',
                'AJAX_OPTION_HISTORY' => 'N',
                'AJAX_OPTION_ADDITIONAL' => '',

                'TEMPLATE_VARS' => [
                        'TITLE' => 'Ближайшие выставки',
                ]
            )
    );?>



<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>