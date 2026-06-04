<?
/**
 * @var array $arResult
 * @var array $arParams
 */
?>
<div class="catalog__container">
    <nav class="menu__body">
        <ul class="menu__list">
            <?foreach($arResult['ITEMS'] as $dctItem):?>
            <li class="menu__item <?if($arParams['TEMPLATE_VARS']['SECTION_CODE'] == $dctItem['CODE']):?>_item-active<?endif;?>">
                <a href="<?=$dctItem['SECTION_PAGE_URL']?>" class="menu__link text-16" >
                    <?=$dctItem['NAME']?>
                </a>
            </li>
            <?endforeach;?>
        </ul>
    </nav>
</div>
