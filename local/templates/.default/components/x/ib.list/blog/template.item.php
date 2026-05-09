<?
/**
 * @var array $dctItem
 */
?>

<div class="card-exhibition__img">
    <picture>
        <img src="<?=$dctItem['PREVIEW_PICTURE']['SRC']?>" alt="">
    </picture>
</div>

<?if (!empty($dctItem['PROPERTY_DATE_STARTING_VALUE'])): 

$datetime = new \Bitrix\Main\Type\DateTime($dctItem['PROPERTY_DATE_STARTING_VALUE']);
$culture = \Bitrix\Main\Application::getInstance()->getContext()->getCulture();
$LongDateFormat = $culture->getLongDateFormat();?>

<div class="card-exhibition__time text-14"><?=FormatDate($LongDateFormat, $datetime->getTimestamp());?>
    <?if (!empty($dctItem['PROPERTY_DATE_ENDING_VALUE'])): 
    $datetime = new \Bitrix\Main\Type\DateTime($dctItem['PROPERTY_DATE_ENDING_VALUE']);
    ?>
    — <?=FormatDate($LongDateFormat, $datetime->getTimestamp());?>
    <?endif;?>
</div>
<?endif;?>

<div class="card-exhibition__title text-22"><?=$dctItem['NAME']?></div>
<address class="card-exhibition__address text-16">
    <?=$dctItem['PREVIEW_TEXT']?>
</address>

<?foreach($dctItem['PROPERTY_TAGS_VALUE'] as $dctItemTag):?>
<div class="card-exhibition__tag text-16">
    #<?=$dctItemTag?>
</div>
<?endforeach;?>

