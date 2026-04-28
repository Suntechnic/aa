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
<section class="catalog section animate-block">
    <div class="catalog__container">
        <div class="catalog__inner">
            <?if($arResult['SECTION'] && $arResult['SECTION']['NAME']):?>
            <h2 class="catalog__title text-50 fade-up" data-watch data-watch-once><?=$arResult['SECTION']['NAME']?></h2>
            <?else:?>
            <h2 class="catalog__title text-50 fade-up" data-watch data-watch-once>Каталог</h2>
            <?endif?>
            <div class="catalog__row fade-up" data-watch data-watch-once>
                <?foreach($arResult['ITEMS'] as $dctItem): $dctSection = $arResult['REFS']['SECTIONS'][$dctItem['IBLOCK_SECTION_ID']];?>
                <div class="catalog__column card-working">
                    <?include('template.item.php');?>
                </div>
                <?endforeach?>
            </div>
            <div class="catalog__bottom fade-up" data-watch data-watch-once>
                <?/*?>
                <a href="javascript:void(0)" class="catalog__btn btn btn--icon text-16" style='--icon:url(&quot;img/icons/01.svg&quot;)'>Показать ещё</a>
                <?/**/?>
                <div class="catalog__pagination pagination">
                    <ul class="pagination__list">
                        <li>
                            <a href="javascript:void(0)" class="pagination__item text-16 active">1</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="pagination__item text-16">2</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="pagination__item text-16">3</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="pagination__item text-16">4</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="pagination__item pagination__item--glasses text-16">...</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="pagination__item text-16">8</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>