<?php

namespace App;
class Slider
{
    /**
     * вращает сортировку банеров каждую неделю
     */
    public static function rotationSort(): string
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $rdbElements = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['ID', 'SORT', 'TIMESTAMP_X'],
                'filter' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('slider'),
                        'ACTIVE' => 'Y',
                        'IBLOCK_SECTION_ID' => \Bxx\Helpers\IBlocks\Sections::getIdByCode('mainpage'),
                    ],
                'order' => ['SORT' => 'ASC'],
            ]);

        $NowWeek = date('W');
        
        $olElemets = [];
        // получим банеры в текущем порядке
        $LastModifiedDate = null; // последняя модификация набор этих банеров
        while ($dctElement = $rdbElements->fetch()) {
            if ($LastModifiedDate === null) {
                $LastModifiedDate = $dctElement['TIMESTAMP_X'];
            } else {
                if ($LastModifiedDate < $dctElement['TIMESTAMP_X']) {
                    $LastModifiedDate = $dctElement['TIMESTAMP_X'];
                }
            }
            $olElemets[] = $dctElement;
        }

        $LastModifiedWeek = date('W', strtotime($LastModifiedDate));
        if ($LastModifiedWeek != $NowWeek) {
            // если банеры не менялись на этой неделе, то вращаем сортировку
            // для этого достаточно передвинуть текущий первый элемент в конец списка
            // сменив ему сортировку на последнюю + 10
            $FirstElement = array_shift($olElemets); //
            (new \CIBlockElement())->Update($FirstElement['ID'], ['SORT' => $olElemets[count($olElemets) - 1]['SORT'] + 10]);
        }

        return __METHOD__.'()';
    }
}<?php

namespace App;
class Slider
{
    /**
     * вращает сортировку банеров каждую неделю
     */
    public static function rotationSort(): string
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $rdbElements = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['ID', 'SORT', 'TIMESTAMP_X'],
                'filter' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('slider'),
                        'ACTIVE' => 'Y',
                        'IBLOCK_SECTION_ID' => \Bxx\Helpers\IBlocks\Sections::getIdByCode('mainpage'),
                    ],
                'order' => ['SORT' => 'ASC'],
            ]);

        $NowWeek = date('W');
        
        $olElemets = [];
        // получим банеры в текущем порядке
        $LastModifiedDate = null; // последняя модификация набор этих банеров
        while ($dctElement = $rdbElements->fetch()) {
            if ($LastModifiedDate === null) {
                $LastModifiedDate = $dctElement['TIMESTAMP_X'];
            } else {
                if ($LastModifiedDate < $dctElement['TIMESTAMP_X']) {
                    $LastModifiedDate = $dctElement['TIMESTAMP_X'];
                }
            }
            $olElemets[] = $dctElement;
        }

        $LastModifiedWeek = date('W', strtotime($LastModifiedDate));
        if ($LastModifiedWeek != $NowWeek) {
            // если банеры не менялись на этой неделе, то вращаем сортировку
            // для этого достаточно передвинуть текущий первый элемент в конец списка
            // сменив ему сортировку на последнюю + 10
            $FirstElement = array_shift($olElemets); //
            (new \CIBlockElement())->Update($FirstElement['ID'], ['SORT' => $olElemets[count($olElemets) - 1]['SORT'] + 10]);
        }

        return __METHOD__.'();';
    }
}