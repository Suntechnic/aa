<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** 
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent $component
 * @var CMain $APPLICATION
 * @var CUser $USER
 */
$this->setFrameMode(true);

$dctItem = $arResult['ITEM'];
$bxApp = \Bitrix\Main\Application::getInstance();
$router = $bxApp->getRouter();
?>

<section class="block section animate-block fade-up" data-watch data-watch-once>
    <div class="block__container">
        <div class="block__inner">
            <div class="block__breadcrumb breadcrumb">
                <ul class="breadcrumb__list">
                    <li class="breadcrumb__item text-16">
                        <a href="<?=$router->route('blog');?>">
                            Блог
                        </a>
                    </li>
                    <li class="breadcrumb__item text-16 breadcrumb__item--active">
                        <span><?=$dctItem['NAME']?></span>
                    </li>
                </ul>
            </div>
            <h2 class="block__title text-50"><?=$dctItem['NAME']?></h2>
            <time datetime="2016-11-18T09:54" class="block__time text-16"><?=$dctItem['X_DATE_FORMATED']?></time>
            <?if($dctItem['DETAIL_PICTURE']):?>
                <div class="block__img">
                    <picture>
                        <img src="<?=$dctItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$dctItem['NAME']?>">
                    </picture>
                </div>
            <?endif;?>
            <?if($dctItem['DETAIL_TEXT']):?>
                <div class="block__description description-block">
                    <?=$dctItem['DETAIL_TEXT']?>
                </div>
            <?endif;?>
            <?if ($dctItem['PROPERTY_PHOTOS_FILES']):?>
            <div class="block__gallery">
                <div class="block__slider swiper js-slider-block">
                    <div class="block__swiper swiper-wrapper">
                        <?foreach($dctItem['PROPERTY_PHOTOS_FILES'] as $dctPhoto):?>
                        <a href="<?=$dctPhoto['SRC']?>" data-fslightbox="gallery" class="block__slide swiper-slide">
                            <div class="block__slide-img">
                                <picture>
                                    <img src="<?=$dctPhoto['SRC']?>" alt="<?=$dctItem['NAME']?>">
                                </picture>
                            </div>
                        </a>
                        <?endforeach;?>
                    </div>

                    <div class="block__pagination"></div>
                    <div class="block__arrows swiper-arrows">
                        <button type="button" class="block__arrow block__arrow--prev swiper-arrow" style='--icon:url(&quot;img/icons/prev.svg&quot;)'></button>
                        <button type="button" class="block__arrow block__arrow--next swiper-arrow" style='--icon:url(&quot;img/icons/next.svg&quot;)'></button>
                    </div>
                </div>
            </div>
            <?endif;?>
        </div>
    </div>
</section>


<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'blog.slider',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 3,
                'SORT' => ['RAND'=>'RAND'],
                
                'FILTER' => [
                        'IBLOCK_ID' => $arResult['FILTER']['IBLOCK_ID'],
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        '!ID' => $dctItem['ID'],
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
                        'TITLE' => 'Другие статьи',
                ]
            )
    );?>
