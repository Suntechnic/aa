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

<?if($arResult['ITEMS']):?>
<section class="intro section animate-block">
    <div class="intro__slider swiper js-slider-intro">
        <div class="intro__swiper swiper-wrapper">
            <?foreach($arResult['ITEMS'] as $dctItem):?>
            <div class="intro__slide swiper-slide">
                <div class="intro__slide-img fade-scale" data-watch data-watch-once style="background-image:url('<?=$dctItem['DETAIL_PICTURE']['SRC']?>');">
                    <picture>
                        <img src="<?=$dctItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$dctItem['NAME']?>">
                    </picture>
                </div>
            </div>
            <?endforeach?>
        </div>
        <div class="intro__arrows swiper-arrows">
            <button type="button" class="intro__arrow intro__arrow--prev swiper-arrow" style='--icon:url(../img/icons/prev.svg)'></button>
            <button type="button" class="intro__arrow intro__arrow--next swiper-arrow" style='--icon:url(../img/icons/next.svg)'></button>
        </div>
    </div>
</section>
<?endif?>
