<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?include(\Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default/header.php');

//$APPLICATION->ShowPanel();
?>
<header class="header">
    <div class="header__menu menu">
        <div class="menu__top">
            <button type="button" class="menu__icon icon-menu" aria-label='Меню'>
                <span></span>
            </button>
            <div class="menu__info">
                <a href="/" class="menu__logo">
                    <img src="/local/assets/dist/img/header/01.svg" alt="">
                </a>
                <a href="/gallery/" class="menu__gallery text-16">Галерея работа</a>
            </div>
            <ul class="menu__pages" data-da=".menu__bottom, 992, 0">
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Обо мне</a>
                </li>
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Мои работы</a>
                </li>
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Блог</a>
                </li>
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Контакты</a>
                </li>
            </ul>
            <a href="javascript:void(0)" class="menu__callback" style='--icon:url(&quot;img/icons/02.svg&quot;)'></a>

        </div>
        <div class="menu__bottom">
            <nav class="menu__body js-nav" data-da=".menu__pages, 992, 2">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Кольца и браслеты</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Ножи</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Запонки и пуговицы</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Броши и подвески</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Декоративные композиции</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Пряжки</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Серьги</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Темляки и бусины</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Фигурки</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Разное</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Фигурки</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Темляки и бусины</a>
                    </li>
                    <li class="menu__item">
                        <a href="javascript:void(0)" class="menu__link text-16">Серьги</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<main class="page">