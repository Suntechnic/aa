<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var XCIbList $component */
$this->setFrameMode(true);

$bxApp = \Bitrix\Main\Application::getInstance();
$router = $bxApp->getRouter();

$arParamsClined = $component->getParams();

$NavPageNomer = isset($arResult['NAV_RESULT']) ? $arResult['NAV_RESULT']->NavPageNomer : 1;
$NavPageCount = isset($arResult['NAV_RESULT']) ? $arResult['NAV_RESULT']->NavPageCount : 1;
$NextPageNomer = $NavPageNomer + 1;
if ($NextPageNomer > $NavPageCount) $NextPageNomer = 0;

if ($NextPageNomer) {
    // параметры для слудующей страницы
    $arParamsMutation = [];
    $arParamsMutation['PAGER']['PAGE'] = $NextPageNomer;
    $arParamsMutation['TEMPALTE']['ONLY_LIST'] = 'Y';
    $arParamsMutation['TEMPALTE']['AJAX'] = 'Y';
    $signedParamsMutation = $component->signVal($arParamsMutation);
} else {
    unset($arParamsMutation['PAGEN']);
}
?>
<?if($arParams['TEMPALTE']['ONLY_LIST'] == 'Y'):
    include('template.list.php');
else:?>
<section class="blog section animate-block"
        id="container_<?=$arParams['UID']?>"
        data-signed-params="<?=$component->signVal($arParamsClined)?>"
        data-signed-template="<?=$component->signVal($templateName)?>"
    >
    <div class='blog__container'>
        <div class="blog__inner">
            <h2 class="blog__title text-50 fade-up" data-watch data-watch-once>Блог</h2>
            <div data-tabs class="blog__tabs tabs">
                <nav data-tabs-titles class="tabs__navigation fade-up" data-watch data-watch-once>
                    <a href="<?=$router->route('blog');?>" class="tabs__title text-16 <?if(!$arResult['FILTER']['PROPERTY_TAGS']):?>_tab-active<?endif?>">Все статьи</a>
                    <?foreach($arResult['PROP_ENUM_REFS']['TAGS']['ITEMS'] as $dctTag):?>
                    <a href="<?=$router->route('blog',['tag'=>$dctTag['ID']]);?>" class="tabs__title text-16 <?if($arResult['FILTER']['PROPERTY_TAGS'] == $dctTag['ID']):?>_tab-active<?endif?>"><?=$dctTag['VALUE']?></a>
                    <?endforeach?>
                </nav>

                <div data-tabs-body class="tabs__content fade-up" data-watch data-watch-once>
                    <div class="tabs__body">
                        <div class="tabs__cards" data-list>
                            <?include('template.list.php');?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog__bottom fade-up" data-watch data-watch-once>
                <a
                        href="javascript:void(0)"
                        class="blog__btn btn btn--icon text-16"
                        onclick="BX.App.Components.<?=$arParamsClined['UID']?>.next()"
                        style='--icon:url(../img/icons/01.svg)'
                        data-more-btn
                    >Показать ещё</a>
                <div class="blog__pagination pagination">
                    <?=$arResult['NAV_STRING']?>
                </div>
            </div>
        </div>
    </div>
</section>
<?if ('Y' != $arParams['TEMPLATE']['AJAX']):?>
<script defer>
    window.addEventListener('load', ()=>{
        BX.ready(() => {
            BX.App = BX.App || {};
            BX.App.Components = BX.App.Components || {};
            BX.App.Components.<?=$arParamsClined['UID']?> = BX.App.Components.<?=$arParamsClined['UID']?> || {

                // id контейнера в котором работает скрипт
                idContainer: 'container_<?=$arParamsClined['UID']?>',

                container: false,
                // подгрузка следующей страницы
                next: function () {
                    var listContainer = document.querySelector('#'+BX.App.Components.<?=$arParamsClined['UID']?>.idContainer+' [data-list]');

                    // получим из списка последний маркер следующей страницы
                    var markers = listContainer.querySelectorAll('[data-signed-params-mutation]');
                    var lastMarker = markers.length ? markers[markers.length - 1] : null;
                    if (lastMarker) {
                        var signedParamsMutation = lastMarker.dataset.signedParamsMutation;
                        lastMarker.remove();
                        if (signedParamsMutation) {
                            BX.App.Components.<?=$arParamsClined['UID']?>.ajaxUpdate(
                                signedParamsMutation,
                                (response) => {
                                    listContainer.insertAdjacentHTML('beforeend', response);

                                    // попробуем получить следующий маркер, если его нет, значит страниц больше нет и кнопку можно удалить
                                    var markers = listContainer.querySelectorAll('[data-signed-params-mutation]');
                                    if (!markers.length) {
                                        document.querySelector('#'+BX.App.Components.<?=$arParamsClined['UID']?>.idContainer+' [data-more-btn]').remove();
                                    }

                                    BX.onCustomEvent('app.DOMUpdated', [
                                        {
                                            container: listContainer
                                        }
                                    ]);
                                }
                            );
                            return;
                        }
                    }

                    document.querySelector('#'+BX.App.Components.<?=$arParamsClined['UID']?>.idContainer+' [data-more-btn]').remove();
                },


                ajaxUpdate: function (signedParamsMutation, callback) {
                    var container = document.querySelector('#'+BX.App.Components.<?=$arParamsClined['UID']?>.idContainer);
                    var query = {
                        c: 'x:ib.list',
                        action: 'execute',
                        mode: 'class'
                    };

                    BX.ajax({
                        url: '/bitrix/services/main/ajax.php?' + BX.ajax.prepareData(query),
                        method: 'POST',
                        dataType: 'html',
                        data: {
                            signedParams: container.dataset.signedParams,
                            signedTemplate: container.dataset.signedTemplate,
                            signedParamsMutation: signedParamsMutation
                        },
                        onsuccess: function(response) {
                            callback(response);
                        },
                        onfailure: function(reason, status) {
                            console.error('Blog ajax failed', reason, status);
                        }
                    });
                }
            }
        });
    });
</script>
<?endif?>
<?endif?>
