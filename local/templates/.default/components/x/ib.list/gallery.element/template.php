<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$dctItem = $arResult['ITEM'];
$dctSection = $arResult['REFS']['SECTIONS'][$dctItem['IBLOCK_SECTION_ID']];
?>
<section class="product section animate-block">
    <div class='product__container'>
        <div class="product__body">
            <div class="product__top">
                <div class="product__breadcrumb breadcrumb fade-up" data-watch data-watch-once>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item text-16">
                            <a href="<?=$dctSection['SECTION_PAGE_URL']?>">
                                <?=$dctSection['NAME']?>
                            </a>
                        </li>
                        <li class="breadcrumb__item text-16 breadcrumb__item--active">
                            <span><?=$dctItem['NAME']?></span>
                        </li>
                    </ul>
                </div>
                <h2 class="product__title text-50 fade-up" data-watch data-watch-once>
                    <span class="product__circle" title="Недоступный для покупки"></span>    
                <?=$dctItem['NAME']?></h2>
            </div>
            <div class="product__inner">
                <div class="product__sliders fade-up" data-watch data-watch-once>
                    <div class="product__thumbs swiper js-slider-thumbs">
                        <div class="product__swiper swiper-wrapper">
                            <?foreach($dctItem['PROPERTY_PHOTOS_FILES'] as $dctPhotoFile):?>
                            <div class="product__gallery swiper-slide">
                                <div class="product__gallery-img">
                                    <picture>
                                        <img src="<?=$dctPhotoFile['SRC']?>" srcset="<?=$dctPhotoFile['SRC']?> 2x" alt="">
                                    </picture>
                                </div>
                            </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="product__slider swiper js-slider-product">
                        <div class="product__swiper swiper-wrapper">
                            <?foreach($dctItem['PROPERTY_PHOTOS_FILES'] as $dctPhotoFile):?>
                            <a href="<?=$dctPhotoFile['SRC']?>" data-fslightbox="gallery_<?=$dctItem['ID']?>"  class="product__slide swiper-slide">
                                <div class="product__slide-img">
                                    <picture>
                                        <img src="<?=$dctPhotoFile['SRC']?>" srcset="<?=$dctPhotoFile['SRC']?> 2x" alt="">
                                    </picture>
                                </div>
                            </a>
                            <?endforeach;?>
                        </div>
                    </div>

                </div>
                <div class="product__content fade-up" data-watch data-watch-once>
    <div class="product__tabs">
        <div class="product__tabs-nav">
            <button class="product__tab-btn active" data-tab="description">Описание</button>
            <button class="product__tab-btn" data-tab="chars">Характеристики</button>
            <button class="product__tab-btn" data-tab="extra">Дополнительно</button>
        </div>

        <!-- Описание -->
        <div class="product__tab-content active" data-tab-content="description">
            <?if ($dctItem['DETAIL_TEXT']):?>
            <div class="product__text text-16">
                <?=$dctItem['DETAIL_TEXT']?>
            </div>
            <?else:?>
            <p class="text-16">Описание отсутствует.</p>
            <?endif;?>
        </div>

        <!-- Характеристики -->
        <div class="product__tab-content" data-tab-content="chars">
            <div class="product__items">
                <?foreach($arParams['TEMPLATE']['PROPERTIES'] as $dctProp):
                if (str_starts_with($dctProp['CODE'], 'CHAR_') && $Value = $dctItem['PROPERTY_'.$dctProp['CODE'].'_VALUE']):?>
                <dl class="product__item">
                    <dt class="product__category text-16"><?=$dctProp['NAME']?>:</dt>
                    <?if (is_array($Value)):?>
                    <dd class="product__value text-16"><?=implode(', ', $Value)?></dd>
                    <?else:?>
                    <dd class="product__value text-16"><?=$Value?></dd>
                    <?endif;?>
                </dl>
                <?endif;endforeach;?>

                <?if($dctItem['PROPERTY_WEIGHT_VALUE']):?>
                <dl class="product__item">
                    <dt class="product__category text-16">Вес:</dt>
                    <dd class="product__value text-16"><?=$dctItem['PROPERTY_WEIGHT_VALUE']?></dd>
                </dl>
                <?endif;?>

                <?if($dctItem['PROPERTY_YEAR_VALUE']):?>
                <dl class="product__item">
                    <dt class="product__category text-16">Год:</dt>
                    <dd class="product__value text-16"><?=$dctItem['PROPERTY_YEAR_VALUE']?></dd>
                </dl>
                <?endif;?>
            </div>
        </div>

        <!-- Дополнительно -->
        <div class="product__tab-content" data-tab-content="extra">
            <div class="product__items">
                <?foreach($arParams['PROPERTY_CHARS_VALUE'] as $I=>$Value):if($Value):?>
                <dl class="product__item">
                    <?if($arParams['PROPERTY_CHARS_DESCRIPTION'][$I]):?>
                    <dt class="product__category text-16"><?=$arParams['PROPERTY_CHARS_DESCRIPTION'][$I]?>:</dt>
                    <?endif;?>
                    <dd class="product__value text-16"><?=$Value?></dd>
                </dl>
                <?endif;endforeach;?>

                <?
                $dctMaster = $arResult['REFS']['MASTERS'][$dctItem['PROPERTY_MASTER_VALUE']];
                if ($dctMaster):?>
                <dl class="product__item">
                    <dt class="product__category text-16">Мастер:</dt>
                    <dd class="product__value text-16">
                        <a href="<?=$dctMaster['DETAIL_PAGE_URL']?>"><?=$dctMaster['NAME']?></a>
                    </dd>
                </dl>
                <?endif;?>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.product__tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;
        const container = btn.closest('.product__tabs');

        container.querySelectorAll('.product__tab-btn').forEach(b => b.classList.remove('active'));
        container.querySelectorAll('.product__tab-content').forEach(c => c.classList.remove('active'));

        btn.classList.add('active');
        container.querySelector(`[data-tab-content="${tab}"]`).classList.add('active');
    });
});
</script>


<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'gallery.slider',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 8,
                'SORT' => ['RAND'=>'RAND'],
                
                'FILTER' => [
                        'IBLOCK_ID' => $arResult['FILTER']['IBLOCK_ID'],
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        '!ID' => $dctItem['ID'],
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
                        'TITLE' => 'Другие работы',
                ]
            )
    );?>
