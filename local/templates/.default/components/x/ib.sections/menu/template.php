<nav class="menu__body js-nav" data-da=".menu__pages, 992, 2">
    <ul class="menu__list">
        <?foreach($arResult['ITEMS'] as $dctItem):?>
        <li class="menu__item">
            <a href="<?=$dctItem['SECTION_PAGE_URL']?>" class="menu__link text-16">
                <?=$dctItem['NAME']?>
            </a>
        </li>
        <?endforeach;?>
    </ul>
</nav>