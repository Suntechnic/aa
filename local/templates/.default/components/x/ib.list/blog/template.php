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
								<button type="button" class="tabs__title text-16 _tab-active">Все статьи</button>
								<button type="button" class="tabs__title text-16">Выставки</button>
								<button type="button" class="tabs__title text-16">Новости</button>
								<button type="button" class="tabs__title text-16">Технологии</button>
							</nav>
							<div data-tabs-body class="tabs__content fade-up" data-watch data-watch-once>
								<div class="tabs__body">
									<div class="tabs__cards">
										<a href="javascript:void(0)" class="tabs__card card-exhibition">
											<div class="card-exhibition__img">
												<picture>
													<img src="./img/exhibition/01.webp" srcset="./img/exhibition/01@2x.webp 2x" alt="">
												</picture>
											</div>
											<time datetime="2016-11-18T09:54" class="card-exhibition__time text-14">23-25 января 2026 г</time>
											<div class="card-exhibition__title text-22">"Симфония самоцветов"</div>
											<address class="card-exhibition__address text-16">
												Амбер Плаза, Краснопролетарская ул. 36
												<br>
												место  Ж 1
											</address>
											<div class="card-exhibition__tag text-16">
												#выставки
											</div>
										</a>
                                    </div>
								</div>
							</div>
						</div>
						<div class="blog__bottom fade-up" data-watch data-watch-once>
							<a href="javascript:void(0)" class="blog__btn btn btn--icon text-16" style='--icon:url(&quot;img/icons/01.svg&quot;)'>Показать ещё</a>
							<div class="blog__pagination pagination">
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
                <?=$arResult['NAV_STRING']?>
            </div>
        </div>
    </div>
</section>