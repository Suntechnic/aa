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
<section class="work section animate-block">
    <div class='work__container'>
        <div class="work__inner">
            <h2 class="work__title text-50 fade-up" data-watch data-watch-once>Мои работы</h2>
            <div class="work__row fade-up" data-watch data-watch-once>
                <?foreach($arResult['ITEMS'] as $dctItem):?>
                <a href="<?=$dctItem['SECTION_PAGE_URL']?>" class="work__card card-work">
                    <div class="card-work__top">
                        <?if($dctItem['PICTURE']):?>
                        <div class="card-work__img">
                            <picture>
                                <source media="(max-width: 992px)" srcset="<?=$dctItem['PICTURE']['SRC_M']?>, <?=$dctItem['PICTURE']['SRC']?> 2x">
                                <img src="<?=$dctItem['PICTURE']['SRC']?>" srcset="<?=$dctItem['PICTURE']['SRC']?> 2x" alt="">
                            </picture>
                        </div>
                        <?endif?>
                    </div>
                    <div class="card-work__title text-18"><?=$dctItem['NAME']?></div>
                </a>
                <?endforeach?>
            </div>
        </div>
    </div>
</section>
