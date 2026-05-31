<?
/**
 * @var array $dctItem
 * @var array $dctSection
 * @var array $dctMaster
 */
if (is_array($dctItem['PROPERTY_PHOTOS_FILES_PREVIEW'])) {
    if (count($dctItem['PROPERTY_PHOTOS_FILES_PREVIEW']) == 1) {
        $dctItem['PROPERTY_PHOTOS_FILES_PREVIEW'][] = $dctItem['PROPERTY_PHOTOS_FILES_PREVIEW'][0];
    }
    ?>
    <div class="card-working__slider swiper js-slider-card">
        <a href="<?=$dctItem['DETAIL_PAGE_URL']?>" class="card-working__swiper swiper-wrapper">
            <?foreach($dctItem['PROPERTY_PHOTOS_FILES_PREVIEW'] as $dctPhotoFile):?>
            <span data-href="<?=$dctPhotoFile['SRC']?>" class="card-working__slide swiper-slide">
                <div class="card-working__img">
                    <picture>
                        <img 
                                src="<?=$dctPhotoFile['SRC']?>" 
                                alt=""
                            >
                    </picture>
                </div>
            </span>
            <?endforeach;?>
        </a>
        <div class="card-working__pagination"></div>
    </div>
<?}?>
<div class="card-working__content">
    <?if(!isset($arResult['MASTER'])):?>
    <a href="<?=$dctMaster['DETAIL_PAGE_URL']?>" class="card-working__category text-14"><?=$dctMaster['NAME']?></a>
    <?endif;?>

    <?if(!isset($arResult['SECTION'])):?>
    <a href="<?=$dctSection['SECTION_PAGE_URL']?>" class="card-working__category text-14"><?=$dctSection['NAME']?></a>
    <?endif;?>
    
    <a href="<?=$dctItem['DETAIL_PAGE_URL']?>" class="card-working__title text-18"><?=$dctItem['NAME']?></a>
</div>
