<?php
$ss = \Bxx\Stringstorage::getInstance();

$Title = $ss->getStringVal('title');
$Description = $ss->getStringVal('description');
$dctPageProperties = [
        'title' => $Title,
        'description' => $Description,
        'main_class' => 'page page--header',
    ];

foreach ($dctPageProperties as $prop=>$val) {
    if (!$APPLICATION->GetPageProperty($prop)) $APPLICATION->SetPageProperty($prop,$val);
}