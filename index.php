<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "Галерея Serb&Young");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("Галерея Serb&Young");
$APPLICATION->SetPageProperty('main_class','page');

?><?$APPLICATION->IncludeComponent(
	"x:ib.list",
	"slider",
	Array(
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => 3600,
		"CACHE_TYPE" => APPLICATION_ENV=='dev'?'N':'A',
		"ELEMENTS_COUNT" => 1200,
		"FILTER" => ['IBLOCK_ID'=>\Bxx\Helpers\IBlocks::getIdByCode('slider'),'ACTIVE'=>'Y','ACTIVE_DATE'=>'Y','SECTION_ID'=>\Bxx\Helpers\IBlocks\Sections::getIdByCode('mainpage'),],
		"SELECT" => ['DETAIL_PICTURE','PROPERTY_URL','NAME','PREVIEW_TEXT','DETAIL_TEXT',],
		"SORT" => ['SORT'=>'ASC']
	)
);?> <section class="attention section animate-block fade-up" data-watch="" data-watch-once="">
<div class="attention__container">
	<div class="attention__content">
		<div class="attention__text text-22">
			Человек наиболее живёт в то время, когда он чего-нибудь ищет.     Ф.Д.
		</div>
	</div>
</div>
 </section>
<?$APPLICATION->IncludeComponent(
	"x:ib.list",
	"gallery.slider",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => 3600,
		"CACHE_TYPE" => APPLICATION_ENV=='dev'?'N':'A',
		"ELEMENTS_COUNT" => 8,
		"FILTER" => ['IBLOCK_ID'=>\Bxx\Helpers\IBlocks::getIdByCode('gallery'),'ACTIVE'=>'Y','ACTIVE_DATE'=>'Y','PROPERTY_NEW_VALUE'=>'Y',],
		"SELECT" => ['NAME','DETAIL_PAGE_URL','IBLOCK_SECTION_ID','PROPERTY_PHOTOS'],
		"SORT" => ['SORT'=>'ASC'],
		"TEMPLATE_VARS" => ['TITLE'=>'Новое',]
	)
);?>
<?$APPLICATION->IncludeComponent(
	"x:ib.list",
	"blog.slider",
	Array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => 3600,
		"CACHE_TYPE" => APPLICATION_ENV=='dev'?'N':'A',
		"ELEMENTS_COUNT" => 3,
		"FILTER" => ['IBLOCK_ID'=>\Bxx\Helpers\IBlocks::getIdByCode('blog'),'ACTIVE'=>'Y','ACTIVE_DATE'=>'Y','PROPERTY_TAGS_VALUE'=>'События',],
		"SELECT" => ['NAME','DATE_ACTIVE_FROM','ACTIVE_FROM_X','ACTIVE_FROM','TIMESTAMP_X','DETAIL_PAGE_URL','IBLOCK_SECTION_ID','PREVIEW_PICTURE','PROPERTY_TAGS','PROPERTY_DATE_STARTING','PROPERTY_DATE_ENDING'],
		"SORT" => ['ID'=>'DESC'],
		"TEMPLATE_VARS" => ['TITLE'=>'События',]
	)
);?><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>