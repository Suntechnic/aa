<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
/**
 * @var CMain $APPLICATION
 */

$APPLICATION->SetTitle("404 Not Found");?>

<section class="mistake section animate-block fade-up" data-watch data-watch-once>
    <div class='mistake__container'>
        <div class="mistake__inner">
            <div class="mistake__img">
                <picture>
                    <img src="/local/assets/dist/img/mistake/01.webp" srcset="/local/assets/dist/img/mistake/01@2x.webp 2x" alt="">
                </picture>
            </div>
            <div class="mistake__info">
                <div class="mistake__title text-40">
                    Страница не найдена!
                </div>
                <div class="mistake__text text-16">
                    Возможно, она была удалена или перемещена в другой раздел.
                    <br>
                    Вы можете вернуться на
                    <a href="/">главную страницу</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>