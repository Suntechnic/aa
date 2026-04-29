<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Контакты');
$APPLICATION->SetPageProperty('title', 'Контакты');
$APPLICATION->SetPageProperty('main_class', 'page page--header');

$ss = \Bxx\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));
?>

<section class="contact section animate-block">
    <div class="contact__container">
        <div class="contact__inner">
            <h2 class="contact__title text-50 fade-up" data-watch data-watch-once>Контакты</h2>
            <div class="contact__info fade-up" data-watch data-watch-once>
                <a href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>" class="contact__link text-70"><?=$phone->getRawNumber();?></a>
                <a href="mailto:<?=htmlspecialchars($ss->getStringVal('email'))?>" class="contact__link text-22"><?=htmlspecialchars($ss->getStringVal('email'))?></a>
            </div>
            <div class="contact__content fade-up" data-watch data-watch-once>
                <div class="contact__content-title text-22">
                    Соцсети:
                </div>
                <div class="contact__content-items">
                    <?php if ($Telegram = $ss->getStringVal('telegram')): ?>
                    <div class="contact__content-item">
                        <a href="<?=htmlspecialchars($Telegram)?>" class="contact__content-link text-22" target="_blank" rel="noopener noreferrer">Телеграм</a>
                    </div>
                    <?php endif; ?>
                    <?php if ($Max = $ss->getStringVal('max')): ?>
                    <div class="contact__content-item">
                        <a href="<?=htmlspecialchars($Max)?>" class="contact__content-link text-22" target="_blank" rel="noopener noreferrer">Max</a>
                    </div>
                    <?php endif; ?>
                    <?php if ($Instagram = $ss->getStringVal('instagram')): ?>
                    <div class="contact__content-item">
                        <a href="<?=htmlspecialchars($Instagram)?>" class="contact__content-link text-22" target="_blank" rel="noopener noreferrer">Инстаграм</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
