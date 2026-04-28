<div class="card-working__slider swiper js-slider-card">
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
</div>
