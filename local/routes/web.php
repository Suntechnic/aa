<?php
use Bitrix\Main\Routing\RoutingConfigurator;
use Bitrix\Main\Routing\Controllers\PublicPageController;
return function (RoutingConfigurator $routes)
{
    $routes->name('works')
            ->get('/works/', new PublicPageController('/local/pages/gallery-sections.php'));
    // галерея
    $routes->name('gallery')
            ->get('/gallery/', new PublicPageController('/local/pages/gallery.php'));
    // секция галереи и элемент галереи
    $routes->prefix('gallery')->group(function (RoutingConfigurator $routes) {
            $routes->name('gallery-section')
                    ->get('{SectionCode}/', new PublicPageController('/local/pages/gallery.php'));
            $routes->name('gallery-element')
                    ->get('{SectionCode}/{ElementCode}/', new PublicPageController('/local/pages/gallery-element.php'));
        });
};