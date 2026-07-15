<?
/**
 * @var array $arResult
 * @var array $arParams
 * @var array $olNavChain
 */
?>
<ul class="breadcrumb__list" itemscope="" itemtype="http://schema.org/BreadcrumbList">
    <?foreach($olNavChain as $ChainI=>$dctChainItem):?>
    <li class="breadcrumb__item text-16" id="bx_breadcrumb_0" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">

        <?if(isset($dctChainItem['URL'])):?><a href="<?= $dctChainItem['URL'] ?>" title="<?= $dctChainItem['NAME'] ?>" itemprop="item"><?endif?>
            <span itemprop="name"><?= $dctChainItem['NAME'] ?></span>
        <?if(isset($dctChainItem['URL'])):?></a><?endif?>
        <meta itemprop="position" content="<?=($ChainI+1)?>">
    </li>
    <?endforeach;?>
</ul>