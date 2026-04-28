<!-- <div class="card-working__slider swiper js-slider-card">
    <div class="card-working__swiper swiper-wrapper">
        <?foreach($dctItem['PROPERTY_PHOTOS_FILES'] as $dctPhotoFile):?>
        <a href="<?=$dctPhotoFile['SRC']?>" class="card-working__slide swiper-slide">
            <div class="card-working__img">
                <picture>
                    <img src="<?=$dctPhotoFile['SRC']?>" alt="">
                </picture>
            </div>
        </a>
        <?endforeach;?>
    </div>
    <div class="card-working__pagination"></div>
</div>
<div class="card-working__content">
    <a href="<?=$dctSection['SECTION_PAGE_URL']?>" class="card-working__category text-14"><?=$dctSection['NAME']?></a>
    <a href="<?=$dctItem['DETAIL_PAGE_URL']?>" class="card-working__title text-18"><?=$dctItem['NAME']?></a>
</div> -->
<?foreach($dctItem['PROPERTY_TAGS'] as $dctItemTag):?>
                        <?=$dctItemTag?>
                    <?endforeach;?>
<div data-tabs-body class="tabs__content fade-up" data-watch data-watch-once>
    <div class="tabs__body">
        <div class="tabs__cards">
            <a href="javascript:void(0)" class="tabs__card card-exhibition">
                <div class="card-exhibition__img">
                    <picture>
                        <img src="<?=$dctItem['PREVIEW_PICTURE']['SRC']?>" alt="">
                    </picture>
                </div>
                <time datetime="2016-11-18T09:54" class="card-exhibition__time text-14"><?=$dctItem['DATE_ACTIVE_FROM']?></time>
                <div class="card-exhibition__title text-22"><?=$dctItem['NAME']?></div>
                <address class="card-exhibition__address text-16">
                    <?=$dctItem['PREVIEW_TEXT']?>
                </address>
                <div class="card-exhibition__tag text-16">
                    
                </div>
            </a>
        </div>
    </div>
</div>