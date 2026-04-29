<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?include(\Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default/header.php');

/**
 * @var CMain $APPLICATION
 */

$bxApp = \Bitrix\Main\Application::getInstance();
$router = $bxApp->getRouter();

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
                <a href="<?=$router->route('gallery');?>" class="menu__gallery text-16">Галерея работа</a>
            </div>
            <ul class="menu__pages" data-da=".menu__bottom, 992, 0">
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Обо мне</a>
                </li>
                <li class="menu__page">
                    <a href="<?=$router->route('works');?>" class="menu__page-link text-16">Мои работы</a>
                </li>
                <li class="menu__page">
                    <a href="<?=$router->route('blog');?>" class="menu__page-link text-16">Блог</a>
                </li>
                <li class="menu__page">
                    <a href="javascript:void(0)" class="menu__page-link text-16">Контакты</a>
                </li>
            </ul>
            <a href="javascript:void(0)" class="menu__callback" style='--icon:url(&quot;img/icons/02.svg&quot;)'></a>

        </div>
        <div class="menu__bottom">
            <?$APPLICATION->IncludeComponent(
                    'x:ib.sections',
                    'menu',
                    Array(
                            'AJAX_MODE' => 'N',
                            'ELEMENTS_COUNT' => 12,
                            'SORT' => ['SORT'=>'ASC'],
                            
                            'FILTER' => [
                                    'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
                                    'ACTIVE' => 'Y',
                                    'ACTIVE_DATE' => 'Y',
                                ],
                            'SELECT' => [
                                    'ID',
                                    'NAME',
                                    'CODE',
                                    'IBLOCK_ID',
                                    'SECTION_PAGE_URL',
                            ],
                            
                            'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                            'CACHE_TIME' => 3600,
                            'CACHE_FILTER' => 'Y',
                            'CACHE_GROUPS' => 'Y',
                        )
                );?>
        </div>
    </div>
</header>
<main class="<?$APPLICATION->ShowProperty('main_class')?>">
