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

\Kint::dump($arResult, $arParams);
?>


<section class="blog section animate-block">
    <div class='blog__container'>
        <div class="blog__inner">

            <h2 class="blog__title text-50 fade-up" data-watch data-watch-once>Блог</h2>
            <div data-tabs class="blog__tabs tabs">
                <nav data-tabs-titles class="tabs__navigation fade-up" data-watch data-watch-once>
                    <a href="/blog/" class="tabs__title text-16 _tab-active">Все статьи</a>
                    <a href="/blog/" class="tabs__title text-16">Выставки</a>
                    <a href="/blog/" class="tabs__title text-16">Новости</a>
                    <a href="/blog/" class="tabs__title text-16">Технологии</a>
                </nav>
                <div data-tabs-body class="tabs__content fade-up" data-watch data-watch-once>
                    <div class="tabs__body">
                        <div class="tabs__cards">
                            <?foreach($arResult['ITEMS'] as $dctItem): $dctSection = $arResult['REFS']['SECTIONS'][$dctItem['IBLOCK_SECTION_ID']];?>
                                <div class="catalog__column card-working">
                                    <?include('template.item.php');?>
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="blog__bottom fade-up" data-watch data-watch-once>
                <a href="javascript:void(0)" class="blog__btn btn btn--icon text-16" style='--icon:url(&quot;img/icons/01.svg&quot;)'>Показать ещё</a>
                <div class="blog__pagination pagination">
                    <?=$arResult['NAV_STRING']?>
                </div>
            </div>
        </div>
    </div>
</section>


