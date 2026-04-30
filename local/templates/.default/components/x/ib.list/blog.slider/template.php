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
$lstItems = $arResult['ITEMS'];
\Kint::dump($lstItems);
?>
<section class="exhibition section animate-block">
    <div class="exhibition__container">
        <div class="exhibition__inner">
            <h2 class="exhibition__title text-50 fade-up" data-watch data-watch-once><?=$arParams['TEMPLATE_VARS']['TITLE']?></h2>
            <div class="exhibition__slider swiper js-slider-exhibition fade-up" data-watch data-watch-once>
                <div class="exhibition__swiper swiper-wrapper">
                    <?foreach($arResult['ITEMS'] as $dctItem):?>
                    <?include(__DIR__.'/../blog/template.item.php');?>
                    <?endforeach?>
                </div>
                <div class="exhibition__pagination"></div>
            </div>
        </div>
    </div>
</section>