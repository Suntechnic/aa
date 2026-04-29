<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle('Обо мне');
$APPLICATION->SetPageProperty('title', 'Обо мне');
$APPLICATION->SetPageProperty('main_class', 'page page--header');
?>

<section class="about section animate-block">
    <div class="about__container">
        <div class="about__inner">
            <h2 class="about__title text-50 fade-up" data-watch data-watch-once>Обо мне</h2>
            <div class="about__img fade-up" data-watch data-watch-once>
                <picture>
                    <img src="/local/assets/dist/img/about/01.webp" srcset="/local/assets/dist/img/about/01@2x.webp 2x" alt="Обо мне">
                </picture>
            </div>
            <div class="about__info fade-up" data-watch data-watch-once>
                <div class="about__text text-22">
                    Родился в Москве в 1967 году.
                    <br>
                    Живу по сей день :)
                </div>
            </div>
        </div>
    </div>
</section>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
