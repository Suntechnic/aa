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

$lstCharsTabContent = [];
if ($dctItem['PROPERTY_MASTER_VALUE']) $lstCharsTabContent[] = [
        'NAME' => 'Мастер',
        'VALUE' => '<a href="'.$arResult['REFS']['MASTERS'][$dctItem['PROPERTY_MASTER_VALUE']]['DETAIL_PAGE_URL'].'">'.$arResult['REFS']['MASTERS'][$dctItem['PROPERTY_MASTER_VALUE']]['NAME'].'</a>'
    ];
foreach($arParams['TEMPLATE']['PROPERTIES'] as $dctProp) {
    if (str_starts_with($dctProp['CODE'], 'CHAR_') && $Value = $dctItem['PROPERTY_'.$dctProp['CODE'].'_VALUE']) {
        $lstCharsTabContent[] = [
            'NAME' => $dctProp['NAME'],
            'VALUE' => is_array($Value) ? implode(', ', $Value) : $Value
        ];
    }
}
foreach($arParams['PROPERTY_CHARS_VALUE'] as $I=>$Value) { if($Value) {
    $dctChar = [];
    if($arParams['PROPERTY_CHARS_DESCRIPTION'][$I]) {
        $dctChar['NAME'] = $arParams['PROPERTY_CHARS_DESCRIPTION'][$I];
    }
    $dctChar['VALUE'] = $Value;
    $lstCharsTabContent[] = $dctChar;
}}


if($dctItem['PROPERTY_WEIGHT_VALUE']) $lstCharsTabContent[] = [
        'NAME' => 'Вес',
        'VALUE' => $dctItem['PROPERTY_WEIGHT_VALUE']
    ];

if($dctItem['PROPERTY_YEAR_VALUE']) $lstCharsTabContent[] = [
        'NAME' => 'Год',
        'VALUE' => $dctItem['PROPERTY_YEAR_VALUE']
    ];


$ExtraTabContent = $dctItem['PREVIEW_TEXT'] || $dctItem['FILES'] || $dctItem['IMAGES'];
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
                    <?if($dctItem['PROPERTY_NOTAVAILABLE_VALUE'] == 'Y'):?>
                    <span class="product__circle" title="Работа не доступна"></span>    
                    <?endif?>
                    <?=$dctItem['NAME']?>
                </h2>
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
                            <?if ($dctItem['DETAIL_TEXT']):?>
                            <button class="product__tab-btn active" data-tab="description">Описание</button>
                            <?endif;?>
                            <?if (!empty($lstCharsTabContent)):?>
                            <button class="product__tab-btn" data-tab="chars">Характеристики</button>
                            <?endif;?>
                            <?if ($ExtraTabContent):?>
                            <button class="product__tab-btn" data-tab="extra">Дополнительно</button>
                            <?endif;?>
                        </div>


                        <?if ($dctItem['DETAIL_TEXT']):?>
                        <!-- Описание -->
                        <div class="product__tab-content active" data-tab-content="description">
                            <div class="product__text text-16">
                                <?=$dctItem['DETAIL_TEXT']?>
                            </div>
                        </div>
                        <?endif;?>
                        <?if (!empty($lstCharsTabContent)):?>
                        <!-- Характеристики -->
                        <div class="product__tab-content" data-tab-content="chars">
                            <div class="product__items">
                                <?foreach($lstCharsTabContent as $dctProp):?>
                                <dl class="product__item">
                                    <?if(isset($dctProp['NAME'])):?>
                                    <dt class="product__category text-16"><?=$dctProp['NAME']?>:</dt>
                                    <?endif;?>
                                    <dd class="product__value text-16"><?=$dctProp['VALUE']?></dd>
                                </dl>
                                <?endforeach;?>
                            </div>
                        </div>
                        <?endif;?>
                        
                        <!-- Дополнительно если есть текст/файлы -->
                        <?if ($ExtraTabContent):?>
                        <div class="product__tab-content" data-tab-content="extra">
                            <div class="product__items">

                            
                                <?if ($dctItem['PREVIEW_TEXT']):?>
                                <div class="product__text text-16">
                                    <?=$dctItem['PREVIEW_TEXT']?>
                                </div>
                                <?endif;?>
                                
                                <?if (!empty($dctItem['FILES'])): foreach($dctItem['FILES'] as $arFile): ?>
                                    <?
                                    $Src = $arFile["SRC"];
                                    $Name = $arFile["ORIGINAL_NAME"] ?: $arFile["FILE_NAME"];
                                    ?>

                                    <dl class="product__item">
                                        <dd class="product__value text-16">
                                            <a href="<?=$Src?>" target="_blank" download>
                                                <?= htmlspecialcharsbx($Name) ?>
                                                (<?= CFile::FormatSize($arFile["FILE_SIZE"]) ?>)
                                            </a>
                                        </dd>
                                    </dl>
                                <?endforeach;endif;?>

                                <?if (!empty($dctItem['IMAGES'])):?>
                                <div class="block__gallery">
                                    <div class="block__slider swiper js-slider-block">
                                        <div class="block__swiper swiper-wrapper">
                                            <?foreach($dctItem['IMAGES'] as $dctPhoto): ?>
                                            <a href="<?=$dctPhoto['SRC']?>" data-fslightbox="gallery-extra" class="block__slide swiper-slide">
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
                                            <button type="button" class="block__arrow block__arrow--prev swiper-arrow" style='--icon:url(../img/icons/prev.svg)'></button>
                                            <button type="button" class="block__arrow block__arrow--next swiper-arrow" style='--icon:url(../img/icons/next.svg)'></button>
                                        </div>
                                    </div>
                                </div>
                                <?endif;?>
                            </div>
                        </div>
                        <?endif;?>
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
