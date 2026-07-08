<?php
namespace App\Gallery;

class Sections
{
    public static function getPrivateSectionsId (?string $ExcludeSectionCode=null): array
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        // получим ID разделов у которых установлена галочка UF_PRIVATE
        $arFilter = [
                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('gallery'),
                'ACTIVE' => 'Y',
                'UF_PRIVATE' => 1
            ];
        if ($ExcludeSectionCode) $arFilter['!CODE'] = $ExcludeSectionCode;

        $arSelect = ['ID'];
        $arSections = \CIBlockSection::GetList([], $arFilter, false, $arSelect);
        $arSectionsId = [];
        while ($arSection = $arSections->GetNext()) {
            $arSectionsId[] = $arSection['ID'];
        }

        return $arSectionsId;
    }
}