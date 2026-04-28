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
?>
<section class="working section animate-block">
    <div class="working__container">
        <div class="working__inner working__inner--two">
            <h2 class="working__title text-50 fade-up" data-watch data-watch-once>Другие работы</h2>
            <div class="working__slider swiper js-slider-working fade-up" data-watch data-watch-once>
                <div class="working__swiper swiper-wrapper">
                    <?foreach($arResult['ITEMS'] as $dctItem): $dctSection = $arResult['REFS']['SECTIONS'][$dctItem['IBLOCK_SECTION_ID']];?>
                    <div class="working__card card-working swiper-slide">
                        <?include(__DIR__.'/../gallery/template.item.php');?>
                    </div>
                    <?endforeach?>
                </div>
                <div class="working__navigation">
                    <button type="button" class="working__arrow working__arrow--prev swiper-arrow" style='--icon:url("../img/icons/prev.svg")'></button>
                    <div class="working__pagination"></div>
                    <button type="button" class="working__arrow working__arrow--next swiper-arrow" style='--icon:url("../img/icons/next.svg")'></button>
                </div>
            </div>
        </div>
    </div>
</section>