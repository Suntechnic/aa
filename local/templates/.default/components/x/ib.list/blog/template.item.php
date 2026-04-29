
<a href="<?=$dctItem['DETAIL_PAGE_URL']?>" class="tabs__card card-exhibition">
    <div class="card-exhibition__img">
        <picture>
            <img src="<?=$dctItem['PREVIEW_PICTURE']['SRC']?>" alt="">
        </picture>
    </div>
    <time datetime="<?=$dctItem['X_DATE']->format('Y-m-dTH:i')?>" class="card-exhibition__time text-14"><?=$dctItem['X_DATE_FORMATED']?></time>
    <div class="card-exhibition__title text-22"><?=$dctItem['NAME']?></div>
    <address class="card-exhibition__address text-16">
        <?=$dctItem['PREVIEW_TEXT']?>
    </address>
    <div class="card-exhibition__tag text-16">
        <?foreach($dctItem['PROPERTY_TAGS_VALUE'] as $dctItemTag):?>
            #<?=$dctItemTag?>
        <?endforeach;?>
    </div>
</a>
