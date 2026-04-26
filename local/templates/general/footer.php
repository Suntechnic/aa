<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$ss = \Bxx\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));
?>
</main>
<footer class="footer">
    <div class="footer__container">
        <div class="footer__inner">
            <div class="footer__info">
                <a href="javascript:void(0)" class="footer__logo">
                    <img src="/local/assets/dist/img/footer/01.svg" alt="">
                </a>
                <div class="footer__items">
                    <div class="footer__item text-14">© <?=date('Y')?> Галерея работ Андрея Аввакумова. Все права защищены.</div>
                    <a href="javascript:void(0)" class="footer__item text-14">Политика конфиденциальности</a>
                </div>
            </div>
            <div class="footer__content">
                <div class="footer__row">
                    <a href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>" class="footer__column text-14"><?=$phone->getRawNumber();?></a>
                    <a href="mailto:<?=$ss->getStringVal('email')?>" class="footer__column text-14"><?=$ss->getStringVal('email')?></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?include(\Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default/footer.php');?>